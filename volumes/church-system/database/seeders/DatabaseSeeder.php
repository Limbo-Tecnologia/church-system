<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Apostolo']);
        Role::create(['name' => 'Pastor-Presidente']);
        Role::create(['name' => 'Pastor']);
        Role::create(['name' => 'Tesoureiro']);
        Role::create(['name' => 'Secretario']);
        Role::create(['name' => 'Bispo']);
        Role::create(['name' => 'Diacono']);
        Role::create(['name' => 'Evangelista']);
        Role::create(['name' => 'Membro']);

        $admin->assignRole('Admin');

    }
}
