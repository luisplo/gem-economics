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
                'id' => '1',
                'name' => 'Dia',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => '2',
                'name' => 'Semana',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => '3',
                'name' => 'Mes',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'id' => '4',
                'name' => 'Año',
                'created_at' => $today,
                'updated_at' => $today,
            ],
        ];

        Interval::insert($intervals);
    }
}
