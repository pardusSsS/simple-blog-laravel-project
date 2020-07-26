<?php

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
        $categories = ['Genel','Oyun','Ticari Yazılım','Robot Teknolojileri','Askeri Teknolojiler' ];
        foreach ($categories as $category){
            DB::table('categories')->insert([
               'name'=>$category,
                'slug'=>str_slug($category),
                'created_at'=> new Datetime(),
                'updated_at'=> new Datetime()





            ]);
        }
    }
}
