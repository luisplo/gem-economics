<?php

namespace Database\Seeders;

use App\Enum\Role;
use App\Enum\User as EnumUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $user = User::create([
            'id' => EnumUser::ADMIN,
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => Role::PARENT,
        ]);
        $this->call(IntervalSeeder::class);
    }
}
