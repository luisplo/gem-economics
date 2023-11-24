<?php

namespace Database\Seeders;

use App\Enum\Role as EnumRole;
use App\Models\Role;
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
                'id' => EnumRole::PARENT,
                'name' => 'Parent',
                'description' => 'This role allows total access.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => EnumRole::GUARDIAN,
                'name' => 'Guardian',
                'description' => 'This role is limited to completing activities, completing rewards and adding penalties.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => EnumRole::AUDITOR,
                'name' => 'Auditor',
                'description' => 'This role is limited to displaying all information without any modification.',
                'created_at' => $today,
                'updated_at' => $today,
            ],
        ];

        Role::insert($roles);
    }
}
