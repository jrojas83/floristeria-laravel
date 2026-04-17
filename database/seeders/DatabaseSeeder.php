<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ROLES
        $roleCliente = Role::firstOrCreate(['name' => 'cliente']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superadmin']);

        // SUPERADMIN
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin User',
                'password' => Hash::make('123456')
            ]
        );
        $superAdmin->assignRole($roleSuperAdmin);

        // ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('123456')
            ]
        );
        $admin->assignRole($roleAdmin);

        // CLIENTE
        $cliente = User::firstOrCreate(
            ['email' => 'cliente@example.com'],
            [
                'name' => 'Cliente User',
                'password' => Hash::make('123456')
            ]
        );
        $cliente->assignRole($roleCliente);

        // LLAMAR PRODUCTOS
        $this->call([
        EstadoProductoSeeder::class,
        CategoriaSeeder::class,
        ProductoSeeder::class,
        ]);
    }
}