<?php

namespace App\Filament\User\Widgets;

use App\Filament\User\Resources\TransactionResource;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class BalanceOverview extends BaseWidget
{
    protected function getStats(): array
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        return [
            Stat::make('Saldo tersisa', Number::currency($user->balance, 'IDR', 'id')),
            Stat::make(
                'Jumlah pengeluaran',
                Number::currency(
                    TransactionResource::getEloquentQuery()
                        ->where('sender_user_id', $user->id)
                        ->sum('amount'),
                    'IDR',
                    'id'
                )
            ),
            Stat::make(
                'Transaksi dilakukan',
                TransactionResource::getEloquentQuery()
                    ->where('sender_user_id', $user->id)
                    ->get()
                    ->count()
            ),
        ];
    }
}
