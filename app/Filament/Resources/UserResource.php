<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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


                        TextInput::make('name')
                            ->maxLength(150)
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        Select::make('division')
                        ->relationship(name: 'division', titleAttribute: 'divisionName')
                        ->required()->label('Asset Device')->required()->columnSpan(2),

                        Select::make('position')
                        ->relationship(name: 'position', titleAttribute: 'positionName')
                        ->required()->label('Asset Device')->required()->columnSpan(2),

                        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
