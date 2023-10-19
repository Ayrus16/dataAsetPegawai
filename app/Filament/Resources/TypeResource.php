<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Type;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TypeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TypeResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class TypeResource extends Resource
{
    protected static ?string $model = Type::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';


    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationLabel = 'Device Type';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('deviceType')
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))->required(),
                    Hidden::make('slug')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('deviceType')
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTypes::route('/'),
        ];
    }    
}
