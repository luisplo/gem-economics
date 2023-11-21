<?php

namespace Database\Seeders;

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
                'id' => 'c2caff2c-9f75-4aea-ba3b-5f68117513cb',
                'name' => 'Dia',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => '50f6d6c6-4493-4c65-b8ac-eb21fea38ce2',
                'name' => 'Semana',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => '026f9235-a9ba-4d9f-ba7e-0990b2da3b0f',
                'name' => 'Mes',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => '7ee41058-527f-4cdb-b98e-448fd42fc9ea',
                'name' => 'Año',
                'created_at' => $today,
                'updated_at' => $today,
            ],
        ];

        Interval::insert($intervals);
    }
}
