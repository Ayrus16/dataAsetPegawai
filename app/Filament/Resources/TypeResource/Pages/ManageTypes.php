<?php

namespace App\Filament\Resources\TypeResource\Pages;

use App\Filament\Resources\TypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypes extends ManageRecords
{
    protected static string $resource = TypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle():string{
        return "Device Type";
    }
}
