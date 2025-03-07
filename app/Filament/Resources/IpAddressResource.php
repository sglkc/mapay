<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IpAddressResource\Pages;
use App\Filament\Resources\IpAddressResource\RelationManagers;
use App\Models\IpAddress;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IpAddressResource extends Resource
{
    protected static ?string $model = IpAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('ip_address')
                    ->ipv4()
                    ->required()
                    ->afterStateHydrated(function (Set $set, Request $request) {
                        $set('ip_address', $request->ip());
                    })
                    ->hintAction(
                        Action::make('fetchApi')
                            ->label('Cari')
                            ->icon('heroicon-m-clipboard')
                            ->color(Color::Amber)
                            ->action(function (Set $set, string $state) {
                                if (!$state) return;

                                $json = Http::get("http://ip-api.com/json/$state?fields=729");

                                if (!$json->json('lat')) {
                                    $set('ip_address', 'Invalid IP');
                                    return;
                                }

                                $set('latitude', $json['lat']);
                                $set('longitude', $json['lon']);
                                $set('country', $json['country']);
                                $set('region', $json['regionName']);
                                $set('city', $json['city']);
                                $set('isp', $json['isp']);
                            })
                    ),

                TextInput::make('latitude')
                    ->afterStateUpdated(function (string $state, Set $set, Get $get) {
                        $location = $get('location');
                        $location['lat'] = $state;
                        $set('location', $location);
                    })
                    ->required(),

                TextInput::make('longitude')
                    ->afterStateUpdated(function (string $state, Set $set, Get $get) {
                        $location = $get('location');
                        $location['lng'] = $state;
                        $set('location', $location);
                    })
                    ->required(),

                TextInput::make('country')
                    ->required(),

                TextInput::make('region')
                    ->required(),

                TextInput::make('city')
                    ->required(),

                TextInput::make('isp')
                    ->label('ISP'),

                Map::make('location')
                    ->dehydrated(false)
                    ->afterStateHydrated(function (?IpAddress $record, Set $set) {
                        $set('location', [
                            'lat' => $record?->latitude,
                            'lng' => $record?->longitude,
                        ]);
                    })
                    ->zoom(14)
                    ->minZoom(12)
                    ->maxZoom(17)
                    ->draggable(false)
                    ->clickable(false)
                    ->liveLocation(false)
                    /* ->showZoomControl(false) */
                    /* ->showMyLocationButton(false) */
                    ->showFullscreenControl(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ip_address'),
                TextColumn::make('country'),
                TextColumn::make('region'),
                TextColumn::make('city'),
                TextColumn::make('isp')->label('ISP'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIpAddresses::route('/'),
        ];
    }
}
