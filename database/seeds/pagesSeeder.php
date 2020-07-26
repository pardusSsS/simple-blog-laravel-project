<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkimizda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table('pages')->insert([
               'title'=>$page,
               'slug'=>str_slug($page),
                'image'=> 'https://miro.medium.com/max/8000/1*JrHDbEdqGsVfnBYtxOitcw.jpeg',
                'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo nihil placeat ratione? 
                            Blanditiis deleniti, dolorem modi mollitia reiciendis tenetur totam? Aliquid neque odio 
                            pariatur quod, repellendus saepe suscipit velit? Velit.Lorem ipsum dolor sit amet, consectetur 
                            adipisicing elit. Nemo nihil placeat ratione? Blanditiis deleniti, dolorem modi mollitia 
                            reiciendis tenetur totam? Aliquid neque odio pariatur quod, repellendus saepe suscipit velit? Velit.',
                'order'=>$count,
                'created_at'=>new Datetime(),
                'updated_at'=>new Datetime(),
            ]);
        }
    }
}
