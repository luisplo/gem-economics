<?php

namespace Database\Seeders;

use App\Models\Interval;
use Illuminate\Database\Seeder;

class IntervalSeed extends Seeder
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
                'name' => 'Dia',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'name' => 'Semana',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'name' => 'Mes',
                'created_at' => $today,
                'updated_at' => $today,
            ],
            [
                'name' => 'Año',
                'created_at' => $today,
                'updated_at' => $today,
            ],
        ];

        Interval::insert($intervals);
    }
}
