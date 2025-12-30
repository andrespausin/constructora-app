<?php

namespace App\Filament\Admin\Resources\UsuarioResource\Pages;

use App\Filament\Admin\Resources\UsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsuarios extends ListRecords
{
    protected static string $resource = UsuarioResource::class;

    protected static ?string $breadcrumb = 'Listado de usuarios';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Crear usuario'),
        ];
    }
}
