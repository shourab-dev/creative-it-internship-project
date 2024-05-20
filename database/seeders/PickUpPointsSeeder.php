<?php

namespace Database\Seeders;

use App\Models\PickUp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PickUpPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresss = [
            [
                'point_name' => "Agrabad Point"
            ],
            [
                'point_name' => "Jamal khan Point"
            ],
            [
                'point_name' => "Chawkbazer Point"
            ],
            [
                'point_name' => "Kotuwali Point"
            ],
        ];

        foreach ($addresss as $address) {

            PickUp::create($address);
        }
    }
}
