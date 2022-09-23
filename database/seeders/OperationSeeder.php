<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operations = [
            ['type' => 'addition', 'cost' => 1],
            ['type' => 'subtraction', 'cost' => 2],
            ['type' => 'multiplication','cost' => 3],
            ['type' => 'division', 'cost' => 4],
            ['type' => 'square_root', 'cost' => 5],
            ['type' => 'random_string', 'cost' => 6],
        ];

        DB::table('operations')->insert($operations);
    }
}
