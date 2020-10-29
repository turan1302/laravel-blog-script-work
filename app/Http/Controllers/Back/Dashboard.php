<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){

        $data = [
            "article_count"=>Article::count(),
            "article_hit"=>Article::orderBy("id","desc")->first()->hit,
            "category_count"=>Category::count(),
            "page_count"=>Page::count()
        ];

        return view('back.index',$data);
    }
}
