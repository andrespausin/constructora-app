<?php

namespace App\Filament\Admin\Resources\UsuarioResource\Pages;

use App\Filament\Admin\Resources\UsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Database\QueryException;
use Filament\Notifications\Notification;

class CreateUsuario extends CreateRecord
{
    protected static string $resource = UsuarioResource::class;

    protected static ?string $title = 'Crear usuario';

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model 
    {
        try {
            return static::getModel()::create($data);
        } catch (QueryException $e) {
            if($e->getCode() === '23000') {
                Notification::make()
                    ->title('Error al crear usuario')
                    ->body('El DNI/NIE ya existe en el sistema')
                    ->danger()
                    ->send();

                 throw \Filament\Support\Exceptions\ValidationException::withMessages([
                'dni_nie' => 'Este DNI/NIE ya está registrado.',
            ]);
            }

            throw $e;
        }
    }
}
