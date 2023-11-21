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
                'id' => '6e73ac19-9fbb-4c05-a8c3-6bfc5442dde7',
                'name' => 'Padre',
                'description' => 'Este rol permite acceso total.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => 'c4b23de4-c5e4-443f-a839-e84b44889b17',
                'name' => 'Tutor',
                'description' => 'Este rol se limita a dar por terminadas actividades, dar recompensas y penalidades.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => '93e9cb5b-7615-4e1a-af95-9226714b4ee0',
                'name' => 'Supervisor',
                'description' => 'Este rol se limita a visualizar toda la informacion sin modificación alguna.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
        ];

        Role::insert($roles);
    }
}
