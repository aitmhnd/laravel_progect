<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class postSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    \App\Models\post::factory(5)->create();
       
    }
}
