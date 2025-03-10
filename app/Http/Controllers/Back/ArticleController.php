<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id','desc')->get();
        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData();

        if ($request->file('image')) {
            $file = $request->file('image');
            $file_name = Str::slug($data['title']) . "." . $file->getClientOriginalExtension();
            $file->move('articleImages', $file_name);  // MOVE DEDİM PUBLİC İ.İNDE DOSYA OLUŞTURUP OORADAN ERĞ
            $data['image'] = "articleImages/" . $file_name;
        }

        if (Article::create($data)) {
            toastr()->success("Makale Başarıyla Oluşturuldu","Başarılı");
            return redirect()->back();
        }else{
            toastr()->error("Makale Oluşturulurken Hata Oluştu","Hata");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('back.articles.edit',compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $data = $this->validateData();

        if ($request->file('image')){

            if (File::exists($article->image))
                File::delete(public_path($article->image));

            $file = $request->file('image');
            $file_name = Str::slug($data['title']) . "." . $file->getClientOriginalExtension();
            $file->move('articleImages', $file_name);  // MOVE DEDİM PUBLİC İ.İNDE DOSYA OLUŞTURUP OORADAN ERĞ
            $data['image'] = "articleImages/" . $file_name;
        }


        $article->update($data);
        toastr()->success("Makale Güncelleme İşlemi Başarılı","Başarılı");
        return redirect()->back();

    }

    public function switch(Request $request,Article $article){
        $data = ($request->data=="true") ? 1 : 0;
        $article->update(array(
            "status"=>$data
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
    }

    public function hardDelete($id){
        $article = Article::onlyTrashed()->find($id);

        if (File::exists($article->image))
            File::delete(public_path($article->image));

        $article->forceDelete();
    }

    public function trashed(){
        $articles = Article::onlyTrashed()->orderBy('created_at','desc')->get();  // silinenleri (softDelete) bu şekilde alıyoruz
        return view('back.articles.trashed', compact('articles'));
    }

    public function recover($id){
        Article::onlyTrashed()->find($id)->restore(); // SİLİNEN VERİYİ GERİ ALDIK
        toastr()->success('Makale Yazısı Geri Alındı','Başarılı');
        return redirect()->back();
    }

    public function validateData()
    {
        return \request()->validate(array(
            "image" => "mimes:jpeg,jpg,png",
            "title" => "required",
            "category_id" => "required",
            "text" => "required"
        ), array(
            "image.mimes" => "JPEG - JPG - PNG Harici Dosya Yüklenemez",

            "title.required" => "Makale Başlığı Alanı Boş Bırakılamaz",
            "category_id.required" => "Kategori Alanı Boş Bırakılamaz",
            "text.required" => "Makale Açıklaması Boş Bırakılamaz"
        ));
    }
}
