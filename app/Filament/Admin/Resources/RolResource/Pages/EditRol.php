<?php

namespace App\Filament\Admin\Resources\RolResource\Pages;

use App\Filament\Admin\Resources\RolResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRol extends EditRecord
{
    protected static string $resource = RolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
