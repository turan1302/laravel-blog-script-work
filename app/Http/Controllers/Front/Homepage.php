<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function __construct()
    {
        /** PAGES VE CATEGORİES ÇOĞU SAYFADA OLDUĞU İÇİN SÜREKLİ KOD TEKRARINDAN KAÇINARAK UFAK BİR KOD YAZALIM */

        view()->share("pages",Page::orderBy('order','asc')->get());  /** PAGES DEĞİŞKENİNİ GÖNDERDİK */
        view()->share("categories",Category::inRandomOrder()->get()); /** CATEGORİES DEĞİŞKENİNİ GÖNDERDİK */
    }

    public function index()
    {
        $data = [
            "articles" => Article::orderBy('id', 'desc')->paginate(2),
        ];

        return view('front.index', $data);
    }

    /**
     *
     *  // ARTICLE SHOW    // NOT: MODEL CONTROLLER YAZDIĞIMIZDA SHOW KISMI SADECE ID İSTEDİĞİNDEN SLUG U NORMAL PARAMETRE ALDIM
     * // NOT: ROUTE MODEL BINDING SLUG ALIRKEN 404 DÖNDÜRDÜĞÜ İÇİN BU ŞEKİLDE BİR YOL UYGULADIK
     */

    /** POST İÇERİĞİ */
    public function single($category, $slug)
    {
        $blog = Article::where('slug', $slug)->first() ?? abort(403, 'Böyle Bir Kategori Bulunamadı');
        $blog->increment('hit');

        $data = [
            // KAYIT YOKSA EKSANA HATA BASTIRACAK (404)
            "blog" => $blog ?? abort(404, 'Kayıt Bulunamadı'),
        ];

        return view('front.post', $data);
    }

    /** KATEGORİYE AİT POSTLAR */
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Böyle Bir Kategori Bulunamadı');
        $data = [
            "category" => $category->name, // KATEGORİ İSMİ (TİTLE İÇİN)
            "articles" => $category->articles()->paginate(2), // KATEGORİYE AİT YAZILAR
        ];

        return view('front.category', $data);
    }

    /** MENULER */
    public function page($page){
        $page = Page::whereSlug($page)->first() ?? abort(403,"Böyle Bir Sayfa Bulunamadı");
        $data = [
            "page"=>$page
        ];
        return view('front.page',$data);

    }
}
