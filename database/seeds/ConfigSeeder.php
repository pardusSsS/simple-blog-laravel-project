<?php
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'title'=>'Gelisim',
            'created_at'=>new Datetime(),
            'updated_at'=>new Datetime(),
        ]);
    }
}
