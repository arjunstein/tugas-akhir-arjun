<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'nama_category' => 'Mesin Las',
        ]);

        DB::table('categories')->insert([
            'nama_category' => 'Mesin Gerinda 4in',
        ]);

        DB::table('categories')->insert([
            'nama_category' => 'Alat Kebersihan',
        ]);
    }
}
