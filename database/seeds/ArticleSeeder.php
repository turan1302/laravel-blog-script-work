<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = \Faker\Factory::create();

        for ($i=0; $i<=5; $i++){
            DB::table('articles')->insert(array(
                "category_id"=>rand(1,3),
                "title"=>$fake->title,
                "image"=>$fake->imageUrl(300, 300, 'cats', true),
                "slug"=>$fake->slug,
                "text"=>$fake->text,

            ));
        }
    }
}
