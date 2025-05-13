<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\UserResource\Pages;
use App\Filament\User\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->required()
                    ->password()
                    ->minLength(8)
                    ->maxLength(255)
                    ->revealable()
                    ->dehydrated(fn ($state) => !empty($state)),

                Select::make('role')
                    ->label('Role')
                    ->required()
                    ->options(
                        Auth::user()->role === 'superadmin'
                            ? [
                                'admin' => 'Admin',
                            ]
                            : [
                                'user' => 'User',
                            ])
                    ->default('user'),

                // TextInput::make('balance')
                //     ->label('Saldo')
                //     ->required()
                //     ->numeric()
                //     ->minValue(0)
                //     ->default(0)
                //     ->maxValue(1000000000)
                //     ->step(1000)
                //     ->mask(fn (Mask $mask) => $mask
                //         ->numeric()
                //         ->decimalPlaces(2)
                //         ->thousandsSeparator('.')
                //         ->decimalSeparator(',')
                //         ->mapToDecimalSeparator('.')
                //         ->mapToThousandsSeparator('.')
                //     ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                /** @var \App\Models\User $user */
                $user = Auth::user();

                if ($user->role === 'admin') {
                    $query->where('admin_id', $user->id);
                }
            })
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Role')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('balance')
                    ->label('Saldo')
                    ->sortable()
                    ->searchable()
                    ->money('IDR', true)
                    ->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.'))
                    ->prefix('IDR '),

                TextColumn::make('admin_id')
                    ->label('Nama Administrator')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => User::find($state)?->name ?? '-'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
