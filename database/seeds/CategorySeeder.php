<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = array(
            "Genel","Hayat","Teknoloji","Yazılım"
        );

        foreach($category as $item){
            DB::table('categories')->insert(array(
                "name"=>$item,
                "slug"=>Str::slug($item)
            ));
        }

    }
}
