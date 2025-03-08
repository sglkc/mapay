<?php

namespace App\Filament\User\Resources\TransactionResource\Pages;

use App\Filament\User\Resources\TransactionResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected static bool $canCreateAnother = false;

    protected function handleRecordCreation(array $data): Model
    {
        /** @var User */
        $user = Auth::user();

        $user->balance -= $data['amount'];
        $user->save();

        return static::getModel()::create($data);
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Transfer')
            ->submit('create')
            ->keyBindings(['mod+s']);
    }
}
