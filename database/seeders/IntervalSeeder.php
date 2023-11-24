<?php

namespace Database\Seeders;

use App\Enum\Interval as EnumInterval;
use App\Enum\User;
use App\Models\Interval;
use Illuminate\Database\Seeder;

class IntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = today();

        $intervals = [
            [
                'id' => EnumInterval::DAY,
                'name' => 'Day',
                'user_id' => User::ADMIN,
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => EnumInterval::WEEK,
                'name' => 'Week',
                'user_id' => User::ADMIN,
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => EnumInterval::MONTH,
                'name' => 'Month',
                'user_id' => User::ADMIN,
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => EnumInterval::YEAR,
                'name' => 'Year',
                'user_id' => User::ADMIN,
                'created_at' => $today,
                'updated_at' => $today,
            ],
        ];

        Interval::insert($intervals);
    }
}
