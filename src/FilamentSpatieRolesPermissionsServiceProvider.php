<?php

namespace Clifea\FilamentSpatieRolesPermissions;

use Clifea\FilamentSpatieRolesPermissions\Resources\PermissionResource;
use Clifea\FilamentSpatieRolesPermissions\Resources\RoleResource;
use Filament\PluginServiceProvider;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentSpatieRolesPermissionsServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-spatie-roles-permissions';

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-spatie-roles-permissions')
            ->hasConfigFile()
            ->hasTranslations();
    }

    protected function getResources(): array
    {
        return [
            RoleResource::class,
            PermissionResource::class
        ];
    }
}
