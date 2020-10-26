<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function index(){
        $data = [
            "categories" => Category::inRandomOrder()->get(),
            "articles"=>Article::orderBy('id','desc')->paginate(2)
        ];

        return view('front.index',$data);
    }

    /**
     *
     *  // ARTICLE SHOW    // NOT: MODEL CONTROLLER YAZDIĞIMIZDA SHOW KISMI SADECE ID İSTEDİĞİNDEN SLUG U NORMAL PARAMETRE ALDIM
        // NOT: ROUTE MODEL BINDING SLUG ALIRKEN 404 DÖNDÜRDÜĞÜ İÇİN BU ŞEKİLDE BİR YOL UYGULADIK
     */

    public function single($category,$slug){

        $blog = Article::where('slug',$slug)->first()  ?? abort(404,'Değer Yok');
        $blog->increment('hit');

        $data = [
                                                            // KAYIT YOKSA EKSANA HATA BASTIRACAK (404)
            "blog"=>$blog ?? abort(404,'Kayıt Bulunamadı'),
            "categories"=>Category::inRandomOrder()->get()
        ];

        return view('front.post',$data);
    }

    public function category($slug){
        $category = Category::whereSlug($slug)->first() ?? abort(404,'Böyle Bir Kategori Bulunamadı');
        $data = [
            "category"=>$category->name, // KATEGORİ İSMİ (TİTLE İÇİN)
            "articles"=>$category->articles()->paginate(2), // KATEGORİYE AİT YAZILAR
            "categories"=>Category::all()  // KATEGORİ MENÜSÜ
        ];

        return view('front.category',$data);
    }
}
