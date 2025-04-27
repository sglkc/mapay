<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TransactionResource\Pages;
use App\Filament\User\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use App\Models\User;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $modelLabel = 'Transaksi';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        /** @var User */
        $user = Auth::user();
        $userId = $user->id;
        $userBalance = $user->balance;
        $userBalanceFormat = Number::currency($user->balance, 'IDR', 'id');

        return $form
            ->columns(2)
            ->schema([
                Hidden::make('sender_user_id')
                    ->default($userId)
                    ->required(),

                TextInput::make('receiver_user_id')
                    ->label('Rekening Penerima')
                    ->placeholder('Masukkan rekening penerima')
                    ->numeric()
                    ->notIn([$userId])
                    ->exists(User::class, 'id')
                    ->live(debounce: 1000)
                    ->afterStateUpdated(function (Set $set, $state) {
                        if (blank($state)) return;

                        /** @var User */
                        $receiver = User::query()->find($state);

                        $set('receiver_name', $receiver->name ?? null);
                    })
                    ->validationMessages([
                        'not_in' => 'Tidak bisa transfer ke rekening sendiri',
                        'exists' => 'Rekening tidak ditemukan'
                    ])
                    ->required(),

                TextInput::make('receiver_name')
                    ->label('Nama Penerima')
                    ->afterStateHydrated(function (?Transaction $record, Set $set) {
                        if (!$record?->receiver_user_id) return;

                        /** @var User */
                        $receiver = User::query()->find($record->receiver_user_id);

                        $set('receiver_name', $receiver->name ?? null);
                    })
                    ->placeholder(fn (Get $get) => $get('receiver_user_id')
                        ? 'Rekening tidak ditemukan'
                        : 'Nama penerima akan ditampilkan di sini'
                    )
                    ->disabled()
                    ->required(),

                TextInput::make('amount')
                    ->label('Jumlah')
                    ->placeholder('Masukkan jumlah yang dikirim')
                    ->numeric()
                    ->prefix('Rp.')
                    ->minValue(10_000)
                    ->maxValue($userBalance)
                    ->mask(RawJs::make('$money($input, `,`, `.`, 2)'))
                    ->stripCharacters('.')
                    ->validationMessages([
                        'max' => "Saldo Anda ($userBalanceFormat) tidak mencukupi",
                        'min' => 'Minimal transfer adalah Rp. 10.000'
                    ])
                    ->autocomplete(false)
                    ->required(),

                TextInput::make('description')
                    ->label('Keterangan')
                    ->placeholder('Masukkan keterangan transaksi (opsional)')
                    ->maxLength('63')
                    ->autocomplete(false),

                Hidden::make('ip_address')
                    // ->label('IP Address')
                    // ->ipv4()
                    // ->required()
                    // ->readOnly()
                    ->afterStateHydrated(function (Request $request, Set $set) {
                        $set('ip_address', $request->ip());
                    }),

                Hidden::make('latitude')->required(),

                Hidden::make('longitude')->required(),

                Map::make('location')
                    ->columnSpanFull()
                    ->afterStateUpdated(function (?array $state, Set $set) {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    })
                    ->afterStateHydrated(function (?Transaction $record, Set $set) {
                        $set('longitude', [
                            'lat' => $record?->latitude,
                            'lng' => $record?->longitude,
                        ]);
                    })
                    ->dehydrated(false)
                    ->draggable(false)
                    ->zoom(18)
                    ->minZoom(15)
                    ->maxZoom(18)
                    ->liveLocation()
                    ->showMyLocationButton(false)
                    ->showFullscreenControl(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        /** @var User */
        $user = Auth::user();
        $userId = $user->id;

        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(function (Builder $query) use ($user) {
                if ($user->role === 'superadmin') return;

                if ($user->role === 'admin') {
                    $query->whereHas('sender', function ($senderQuery) use ($user) {
                        $senderQuery->where('admin_id', $user->id);
                    });

                    return;
                }

                $query
                    ->where('sender_user_id', $user->id)
                    ->orWhere('receiver_user_id', $user->id);
            })
            ->columns([
                IconColumn::make('receiver_user_id')
                    ->label('Jenis')
                    ->width('5%')
                    ->icon(fn (string $state) =>
                        $state == $userId
                            ? 'heroicon-o-plus'
                            : 'heroicon-o-minus'
                    )
                    ->color(fn (string $state) =>
                        $state == $userId
                            ? 'success'
                            : 'danger'
                    ),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->suffix(' WIB')
                    ->dateTime('d F Y, H:i:s')
                    ->timezone('Asia/Jakarta')
                    ->width('20%'),

                TextColumn::make('rekening')
                    ->width('15%')
                    ->getStateUsing(fn (Transaction $record) =>
                        $record->sender_user_id != $userId ?: $record->receiver_user_id
                    ),

                TextColumn::make('nama')
                    ->width('20%')
                    ->limit(32)
                    ->getStateUsing(fn (Transaction $record) =>
                        $record->sender_user_id == $userId
                            ? $record->receiver->name
                            : $record->sender->name
                    ),

                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->color(fn (Transaction $record) =>
                        $record->receiver_user_id == $userId
                            ? 'success'
                            : 'danger'
                    )
                    ->width('10%'),

                TextColumn::make('description')
                    ->label('Keterangan')
                    ->default('-'),
            ])
            ->filters([
                //
            ])
            ->actions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
        ];
    }
}
