<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Filament\Commands\MakeUserCommand;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $makeUserCommand = new MakeUserCommand();
        $reflector = new \ReflectionObject($makeUserCommand);
        $getUserModel = $reflector->getMethod('getUserModel');

        $getUserModel->setAccessible(true);

        $superadmin = $getUserModel->invoke($makeUserCommand)::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'balance' => 10000000
        ]);

        $admin = $getUserModel->invoke($makeUserCommand)::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'admin_id' => $superadmin->id,
            'balance' => 100000
        ]);

        $getUserModel->invoke($makeUserCommand)::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'admin_id' => $admin->id,
            'balance' => 100000
        ]);

        $getUserModel->invoke($makeUserCommand)::create([
            'name' => 'merchant',
            'email' => 'merchant@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'merchant'
        ]);
    }
}
