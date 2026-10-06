<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin System',
                'email' => 'admin@eproc.test',
                'role' => 'admin',
                'department' => 'IT & Systems',
            ],
            [
                'name' => 'User Internal',
                'email' => 'user@eproc.test',
                'role' => 'user_internal',
                'department' => 'Operasional',
            ],
            [
                'name' => 'Supervisor',
                'email' => 'supervisor@eproc.test',
                'role' => 'supervisor',
                'department' => 'Operasional',
            ],
            [
                'name' => 'Management',
                'email' => 'management@eproc.test',
                'role' => 'management',
                'department' => 'Direksi',
            ],
            [
                'name' => 'Procurement Staff',
                'email' => 'procurement@eproc.test',
                'role' => 'procurement',
                'department' => 'Procurement',
            ],
            [
                'name' => 'Vendor Supplier',
                'email' => 'vendor@eproc.test',
                'role' => 'vendor',
                'department' => 'External Vendor',
            ],
            [
                'name' => 'Pejabat Keuangan',
                'email' => 'finance.auth@eproc.test',
                'role' => 'pejabat_keuangan',
                'department' => 'Finance Authorization',
            ],
            [
                'name' => 'Petugas Gudang',
                'email' => 'warehouse@eproc.test',
                'role' => 'petugas_gudang',
                'department' => 'Logistik & Gudang',
            ],
            [
                'name' => 'Unit Keuangan',
                'email' => 'finance@eproc.test',
                'role' => 'unit_keuangan',
                'department' => 'Finance & Accounting',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                    'role' => $userData['role'],
                    'department' => $userData['department'],
                ]
            );
        }
    }
}