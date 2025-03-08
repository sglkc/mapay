<?php

namespace App\Filament\User\Widgets;

use App\Filament\User\Resources\TransactionResource;
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
        return $table
            ->query(fn () => TransactionResource::getEloquentQuery()
                ->where('sender_user_id', Auth::user()->getAuthIdentifier())
                ->limit(5)
            )
            ->defaultSort('created_at', 'desc')
            ->paginated(false)
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->suffix(' WIB')
                    ->dateTime('d/m/Y, H:i:s')
                    ->timezone('Asia/Jakarta'),

                TextColumn::make('receiver_user_id')
                    ->label('Rekening Penerima'),

                TextColumn::make('receiver.name')
                    ->label('Nama Penerima'),

                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR'),

                TextColumn::make('description')
                    ->label('Keterangan'),
            ]);
    }
}
