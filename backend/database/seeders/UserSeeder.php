<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();

        $users = [
            [
                'name' => 'Administrador',
                'email' => 'admin@rintegra.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole?->id,
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@rintegra.com',
                'password' => Hash::make('password'),
                'role_id' => $editorRole?->id,
            ]
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
