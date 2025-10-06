<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrador del sistema con acceso completo',
                'permissions' => [
                    'users.view',
                    'users.create',
                    'users.edit',
                    'users.delete',
                    'pages.view',
                    'pages.create',
                    'pages.edit',
                    'pages.delete',
                    'config.view',
                    'config.edit',
                    'media.view',
                    'media.create',
                    'media.edit',
                    'media.delete',
                    'crm.view',
                    'crm.create',
                    'crm.edit',
                    'crm.delete',
                    'analytics.view',
                    'notes.view',
                    'notes.create',
                    'notes.edit',
                    'notes.delete',
                    'backups.view',
                    'backups.create',
                    'seo.view',
                    'seo.edit'
                ],
                'system_role' => true
            ],
            [
                'name' => 'editor',
                'description' => 'Editor con acceso limitado a páginas, configuración global y medios',
                'permissions' => [
                    'pages.view',
                    'pages.create',
                    'pages.edit',
                    'pages.delete',
                    'config.view',
                    'config.edit',
                    'media.view',
                    'media.create',
                    'media.edit',
                    'media.delete'
                ],
                'system_role' => true
            ]
        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );
        }
    }
}
