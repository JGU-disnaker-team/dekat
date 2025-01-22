<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $Admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $Mitra = Role::create(['name' => 'mitra', 'guard_name' => 'web']);
        $Konsumen = Role::create(['name' => 'konsumen', 'guard_name' => 'web']);
    }
}