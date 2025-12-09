<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Réinitialiser le cache des permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Créer les rôles et assigner les permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'view users',
            'view roles',
            'view projects',
            'create projects',
            'edit projects',
        ]);

        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $employeeRole->givePermissionTo([
            'view projects',
        ]);

        // Créer l'utilisateur admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@kotava.com'],
            [
                'name' => 'Admin Kotava',
                'password' => bcrypt('password123'), // À changer en production !
            ]
        );
        $admin->assignRole('admin');

        // Créer un manager
        $manager = User::firstOrCreate(
            ['email' => 'manager@kotava.com'],
            [
                'name' => 'Manager Kotava',
                'password' => bcrypt('password123'),
            ]
        );
        $manager->assignRole('manager');

        // Créer un employé
        $employee = User::firstOrCreate(
            ['email' => 'employee@kotava.com'],
            [
                'name' => 'Employé Kotava',
                'password' => bcrypt('password123'),
            ]
        );
        $employee->assignRole('employee');

        $this->command->info('✅ Permissions et rôles créés avec succès !');
        $this->command->info('👤 Admin : admin@kotava.com / password123');
        $this->command->info('👤 Manager : manager@kotava.com / password123');
        $this->command->info('👤 Employé : employee@kotava.com / password123');
    }
}
