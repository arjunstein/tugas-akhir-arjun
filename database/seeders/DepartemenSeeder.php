<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departemens')->insert([
            'nama_departemen' => 'sales and marketing',
        ]);

        DB::table('departemens')->insert([
            'nama_departemen' => 'human resources departemen',
        ]);

        DB::table('departemens')->insert([
            'nama_departemen' => 'purchasing',
        ]);

        DB::table('departemens')->insert([
            'nama_departemen' => 'production',
        ]);

        DB::table('departemens')->insert([
            'nama_departemen' => 'quality assurance',
        ]);

        DB::table('departemens')->insert([
            'nama_departemen' => 'accounting',
        ]);

        DB::table('departemens')->insert([
            'nama_departemen' => 'warehouse',
        ]);

        DB::table('departemens')->insert([
            'nama_departemen' => 'information technology',
        ]);
    }
}
