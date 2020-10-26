<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ["Hakkımızda", "Kariyer", "Vizyonumuz", "Misyonumuz"];

        $count = 1;
        foreach ($pages as $page) {
            DB::table('pages')->insert(array(
                "title" => $page,
                "slug" => Str::slug($page),
                "image" => "https://www.mediaclick.com.tr/uploads/2020/05/lorem-ipsum.png",
                "order" => $count,
                "content" => "Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum",
                "created_at" => now(),
                "updated_at" => now()
            ));
            $count++;
        }

    }
}
