<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Homepage extends Controller
{
    /** PAGES VE CATEGORİES ÇOĞU SAYFADA OLDUĞU İÇİN SÜREKLİ KOD TEKRARINDAN KAÇINARAK UFAK BİR KOD YAZALIM */
    public function __construct()
    {
        /** PAGES VE CATEGORİES ÇOĞU SAYFADA OLDUĞU İÇİN SÜREKLİ KOD TEKRARINDAN KAÇINARAK UFAK BİR KOD YAZALIM */

        view()->share("pages",Page::where("status",1)->orderBy('order','asc')->get());  /** PAGES DEĞİŞKENİNİ TÜM SAYFALARA GÖNDERDİK */
        view()->share("categories",Category::where("status",1)->inRandomOrder()->get()); /** CATEGORİES DEĞİŞKENİNİ TÜM SAYFALARA GÖNDERDİK */
    }

    public function index()
    {
        $data = [
            "articles" => Article::where('status','1')->orderBy('id', 'desc')->paginate(2),
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
            "blog" => $blog ?? abort(403, 'Kayıt Bulunamadı'),
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

    public function contact(){
        return view('front.contact');
    }

    public function contactPost(Request $request){

        $data=$this->validateData();
        $data['mesaj']=$request->message;   /** BURADA MESAJ DİYE İNDİS OLUŞTURMAMIZIN SEBEBİ LARAVEL İÇERİSİNDE ÇAKIŞMA DURUMUNDAN DOLAYIDIR */
        Contact::create($this->validateData());
        $email = "m.fatihbagcivan@hotmail.com";

        Mail::send('front.mail.mail',$data,function ($message) use ($email){
            $message->subject("Yeni Mesajınız Var");
            $message->to($email);
        });
        return redirect()->back()->with("contact","Mesajınız Başarıyla Gönderilmiştir. Size en kısa zamanda döneceğiz");
    }

    public function validateData(){
        return \request()->validate(array(
            "name"=>"required",
            "email"=>"required|email",
            "topic"=>"required",
            "message"=>"required|min:10"
        ),array(
            "name.required"=>"İsim Alanı Boş Bırakılamaz",
            "email.required"=>"E-Mail Alanı Boş Bırakılamaz",
            "email.email"=>"Lütfrn Geçerli Bir E-Mail Giriniz",
            "topic.required"=>"Konu Kısmı Boş Bırakılamaz",
            "message.required"=>"Mesaj Kısmı Boş Bırakılamaz",
            "message.min"=>"Mesajınız 10 Karakterden Küçük Olamaz"
        ));
    }
}
