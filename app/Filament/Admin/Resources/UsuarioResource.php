<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UsuarioResource\Pages;
use App\Filament\Admin\Resources\UsuarioResource\RelationManagers;

use Illuminate\Validation\ValidationException;

use App\Models\Usuario;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

// Importacion de la regla de validacion DNI/NIE
use App\Rules\DniNieValidacion;
use App\Rules\NumeroSeguridadSocialValido;

class UsuarioResource extends Resource
{
    protected static ?string $model = Usuario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'usuarios';

    protected static ?string $navigationLabel = 'Usuarios';

    protected static ?string $pluralModelLabel = 'Usuarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Información Personal')
                    ->schema([
                        TextInput::make('dni_nie')
                            ->label('DNI/NIE')
                            ->required()
                            ->unique(
                                table: 'usuarios',
                                column: 'dni_nie',
                                ignoreRecord: true
                            )
                            ->live(onBlur: true)
                            ->rule(new DniNieValidacion())
                            ->validationMessages([
                                'unique' => 'El DNI/NIE ya está registrado en el sistema'
                            ]),
                        TextInput::make('nombre')
                            ->label('Nombre')
                            ->required(),
                        TextInput::make('apellido')
                            ->label('Apellido')
                            ->required(),
                        TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->placeholder('661466765')
                            ->live(onBlur: true)
                            ->rules([
                                'min:9', 
                                'max:13', 
                                'regex:/^\+?[0-9]{9,13}$/'
                            ])
                            ->dehydrateStateUsing(fn ($state) => str_replace(' ', '', $state))
                            ->validationMessages([
                                'regex' => 'El formato de número de teléfono es incorrecto'
                            ]),
                        DatePicker::make('fecha_nacimiento')
                            ->label('Fecha de Nacimiento'),
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'ALTA' => 'Alta',
                                'BAJA' => 'Baja'
                            ]),
                        TextInput::make('numero_seguridad_social')
                            ->label('Número de Seguridad Social')
                            ->unique(
                                table: 'usuarios',
                                column: 'numero_seguridad_social',
                                ignoreRecord: true
                            )
                            ->rule(new NumeroSeguridadSocialValido())
                            ->placeholder('281234567890')
                            ->live(onBlur:true)
                            ->dehydrateStateUsing(fn ($state) => preg_replace('/[\s-]/', '', $state))
                            ->helperText('Formato: 12 dígitos. Ej: 281234567890'),
                        Select::make('roles')
                            ->label('Rol del usuario')
                            ->relationship('roles', 'nombre')
                            ->options(function () {
                                return \App\Models\Rol::all()->pluck('nombre', 'id')->toArray();
                            })
                            
                    ])->columns(2),

                
                Section::make('Seguridad')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->live(onBlur: true),
                        TextInput::make('password')
                            ->password()
                            ->label('Contraseña')
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->revealable()
                    ])->columns(2)
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('dni_nie')
                ->label('DNI/NIE')
                ->searchable(),
                TextColumn::make('nombre')
                ->sortable(),
                TextColumn::make('apellido')
                ->sortable(),
                TextColumn::make('email'),
                TextColumn::make('telefono')
                ->label('Teléfono'),
                TextColumn::make('status')
                ->label('Estatus')
                ->sortable()
                ->searchable(),
                TextColumn::make('fecha_nacimiento')
                ->label('Fecha de Nacimiento')
                ->sortable()
                ->searchable(),
                TextColumn::make('numero_seguridad_social')
                ->label('Nº Seguridad Social'),
                TextColumn::make('roles.nombre')
                ->label('Roles')
                ->badge()
                ->separator(', ')
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
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuario::route('/create'),
            'edit' => Pages\EditUsuario::route('/{record}/edit'),
        ];
    }
}
