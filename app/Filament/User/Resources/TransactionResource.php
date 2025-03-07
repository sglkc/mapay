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
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $authId = Auth::user()->getAuthIdentifier();

        return $form
            ->columns(1)
            ->schema([
                Hidden::make('source_user_id')
                    ->default($authId)
                    ->required(),

                TextInput::make('target_user_id')
                    ->label('Receiver ID')
                    ->notIn([$authId])
                    ->exists(User::class, 'id')
                    ->required(),

                TextInput::make('spending')
                    ->minValue(0.01)
                    ->numeric()
                    ->required(),

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
        return $table
            ->modifyQueryUsing(
                fn (Builder $query) => $query
                    ->where('user_id', Auth::user()->getAuthIdentifier())
            )
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
