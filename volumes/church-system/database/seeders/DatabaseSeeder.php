<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Church;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

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
        $pastor = User::factory()->create([
            'name' => 'Ap. Marcos Santana',
            'email' => 'pastor@example.com',
            'password' => Hash::make('password'),
        ]);
        $church = Church::factory()->create([
            'name' => 'Igreja Apostólica Rhema Braga',
            'email' => 'midiasemeandorhema@gmail.com',
            'document_number' => '123456789',
            'phone' => '123456789',
            'address' => 'Rua da Fundação Calouste Gulbenkian, 145, Braga',
        ]);

        Church::factory()->count(10)->create();

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Apostolo']);
        
        $manageChurchPermission = Permission::create(['name' => 'manage churches']);
        $manageChurchPermission->assignRole('Apostolo');

        Role::create(['name' => 'Pastor-Presidente']);
        Role::create(['name' => 'Pastor']);
        Role::create(['name' => 'Tesoureiro']);
        Role::create(['name' => 'Secretario']);
        Role::create(['name' => 'Bispo']);
        Role::create(['name' => 'Diacono']);
        Role::create(['name' => 'Evangelista']);
        Role::create(['name' => 'Membro']);

        $admin->assignRole('Admin');
        $pastor->assignRole('Pastor-Presidente');
        $pastor->assignRole('Apostolo');


        $church->users()->attach($pastor, ['role' => 'Pastor-Presidente']);
    }
}
