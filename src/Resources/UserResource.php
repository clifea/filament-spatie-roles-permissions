<?php

namespace Clifea\FilamentSpatieRolesPermissions\Resources;

use Clifea\FilamentSpatieRolesPermissions\Resources\UserResource\Pages\CreateUser;
use Clifea\FilamentSpatieRolesPermissions\Resources\UserResource\Pages\EditUser;
use Clifea\FilamentSpatieRolesPermissions\Resources\UserResource\Pages\ListUser;
use Clifea\FilamentSpatieRolesPermissions\Resources\UserResource\Pages\ViewUser;
use Clifea\FilamentSpatieRolesPermissions\Resources\UserResource\RelationManager\PermissionRelationManager;
use Filament\Forms\Components\BelongsToManyMultiSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\User;

class UserResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $model = User::class;

    

    public static function getLabel(): string
    {
        return __('filament-spatie-roles-permissions::filament-spatie.section.user');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament-spatie-roles-permissions::filament-spatie.section.users_and_roles');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-spatie-roles-permissions::filament-spatie.section.users');
    }

    public static function getNavigationSort(): ?int
    {
    return 1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->required(),
                    BelongsToManyMultiSelect::make('roles')->relationship('roles', 'name'),
                    
                        
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role'),
                TextColumn::make('created_at')->sortable()->dateTime()->label('Date'),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //PermissionRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListUser::route('/'),
            'create' => CreateUser::route('/create'),
            'edit'   => EditUser::route('/{record}/edit'),
            'view'   => ViewUser::route('/{record}')
        ];
    }
}
