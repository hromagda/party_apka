<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Nejprve smažeme cache oprávnění
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definuj oprávnění
        $permissions = [
            'pridat_pisnicku',
            'oznacit_pisnicku_jako_zahranou',
            'pridat_vzkaz',
            'pridat_fotku',
            'mazat_vzkaz',
            'mazat_fotku',
            'spravovat_uzivatele',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Vytvoření rolí
        $hostRole = Role::firstOrCreate(['name' => 'host']);
        $djRole = Role::firstOrCreate(['name' => 'dj']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Přiřazení oprávnění k rolím
        $hostRole->syncPermissions(['pridat_pisnicku', 'pridat_vzkaz', 'pridat_fotku']);
        $djRole->syncPermissions(['pridat_pisnicku', 'pridat_vzkaz', 'pridat_fotku', 'oznacit_pisnicku_jako_zahranou']);
        $adminRole->syncPermissions(Permission::all());

        // Vytvoření uživatelů a přiřazení rolí
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('AdminHeslo'), // změň na bezpečné heslo
            ]
        );
        $admin->assignRole($adminRole);

        $dj = User::firstOrCreate(
            ['email' => 'dj@example.com'],
            [
                'name' => 'DJ',
                'password' => Hash::make('DjHeslo'),
            ]
        );
        $dj->assignRole($djRole);

        $host = User::firstOrCreate(
            ['email' => 'host@example.com'],
            [
                'name' => 'Host',
                'password' => Hash::make('UserHeslo'),
            ]
        );
        $host->assignRole($hostRole);
    }
}
