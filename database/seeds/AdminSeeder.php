<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            "name"=>"Muhammed Fatih",
            "email"=>"m.fatihbagcivan@hotmail.com",
            "password"=>bcrypt(10203040)
        ));
    }
}
