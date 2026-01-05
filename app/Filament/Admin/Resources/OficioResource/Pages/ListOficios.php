<?php

namespace App\Filament\Admin\Resources\OficioResource\Pages;

use App\Filament\Admin\Resources\OficioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOficios extends ListRecords
{
    protected static string $resource = OficioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
