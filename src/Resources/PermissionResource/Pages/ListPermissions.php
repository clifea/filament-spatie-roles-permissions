<?php

namespace Clifea\FilamentSpatieRolesPermissions\Resources\PermissionResource\Pages;


use Clifea\FilamentSpatieRolesPermissions\Resources\PermissionResource;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getTableBulkActions() :array {
        $roleModel = config('permission.models.role');

        return [
            BulkAction::make('Attach Role')
            ->action(function (Collection $records, array $data): void {
                // dd($data);
                foreach ($records as $record) {
                    $record->roles()->sync($data['role']);
                    $record->save();
                }
            })
            ->form([
                Select::make('role')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.role'))
                    ->options($roleModel::query()->pluck('name', 'id'))
                    ->required(),
            ])->deselectRecordsAfterCompletion()
        ];

    }
}
