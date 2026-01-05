<?php

namespace App\Filament\Admin\Resources\OficioResource\Pages;

use App\Filament\Admin\Resources\OficioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOficio extends EditRecord
{
    protected static string $resource = OficioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
