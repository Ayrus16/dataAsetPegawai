<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Device;
use Filament\Forms\Form;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DeviceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DeviceResource\RelationManagers;
use App\Models\Type;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;

class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->columns([
                    'sm' => 1,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                    ->schema([

                        Select::make('asset_id')
                        ->relationship(name: 'asset', titleAttribute: 'assetName')
                        ->required()->label('Asset Device')->required()->columnSpan(2),
                        Select::make('type_id')
                        ->relationship(name: 'type', titleAttribute: 'deviceType')
                        ->required()->label('Device Type')->required(),
                        TextInput::make('brand')->required(),
                        TextInput::make('deviceModel')->required(),
                        TextInput::make('serialNumber')->unique()->alphaNum(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire,  $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('deviceModel')->sortable()->searchable(),
                TextColumn::make('brand')->sortable()->searchable(),
                TextColumn::make('type.deviceType'),
                TextColumn::make('type.deviceType')
                ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Laptop' => 'blue',
                        'Smartphone' => 'green',
                        'Komputer/PC' => 'red',
                    }),
                TextColumn::make('asset.assetName')
                ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Kantor BPKAD' => 'yellow',
                        'Pribadi' => 'cyan',
                        'Kantor' => 'purple',
                    }),
            ])
            ->filters([
                SelectFilter::make('Device Type')
                    ->relationship('type', 'deviceType'),
                SelectFilter::make('Asset')
                    ->relationship('asset', 'assetName'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }    
}
