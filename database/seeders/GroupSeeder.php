<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos  = [
         ["grupo" => "A"],
         ["grupo" => "B"],
         ["grupo" => "C"],
        ];


        foreach ($grupos as $grupo) {
            \App\Models\Group::create($grupo);
        }

    }
}
