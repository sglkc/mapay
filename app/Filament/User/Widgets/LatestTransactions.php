<?php

namespace App\Filament\User\Widgets;

use App\Filament\User\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class LatestTransactions extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Transaksi terakhir';

    public function table(Table $table): Table
    {
        /** @var User */
        $user = Auth::user();
        $userId = $user->id;

        return $table
            ->query(fn () => TransactionResource::getEloquentQuery()
                ->where('sender_user_id', $userId)
                ->orwhere('receiver_user_id', $userId)
                ->limit(5)
            )
            ->defaultSort('created_at', 'desc')
            ->paginated(false)
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
            ]);
    }
}
