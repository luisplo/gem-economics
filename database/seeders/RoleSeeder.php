<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = today();

        $roles = [
            [
                'name' => 'Padre',
                'description' => 'Este rol permite acceso total.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'name' => 'Tutor',
                'description' => 'Este rol se limita a dar por terminadas actividades, dar recompensas y penalidades.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'name' => 'Supervisor',
                'description' => 'Este rol se limita a visualizar toda la informacion sin modificación alguna.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
        ];

        Role::insert($roles);
    }
}
