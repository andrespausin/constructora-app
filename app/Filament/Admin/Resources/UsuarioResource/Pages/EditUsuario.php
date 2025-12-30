<?php

namespace App\Filament\Admin\Resources\UsuarioResource\Pages;

use App\Filament\Admin\Resources\UsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsuario extends EditRecord
{
    protected static string $resource = UsuarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
