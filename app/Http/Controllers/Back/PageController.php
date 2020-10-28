<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy('order','asc')->get();
        return view('back.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validateData();

        if ($request->file('image')){
            $file = $request->file('image');
            $file_name = Str::slug($request->title).".".$file->getClientOriginalExtension();
            $file->move("pageImages",$file_name);
            $data['image']="pageImages/".$file_name;
        }

        if (Page::create($data)){
            toastr()->success("Sayfa Ekleme İşlemi Başarılı","Başarılı");
            return redirect()->back();
        }else{
            toastr()->error("Sayfa Ekleme İşlemi Başarısız","Hata");
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('back.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $data = $this->validateData();

        if ($request->file('image')){
            if (File::exists($page->image))
                File::delete(public_path($page->image));

            $file = $request->file('image');
            $file_name = Str::slug($request->title).".".$file->getClientOriginalExtension();
            $file->move('pageImages',$file_name);
            $data['image']="pageImages/".$file_name;
        }

        if ($page->update($data)){
            toastr()->success("Sayfa Başarıyla Güncellendi","Başarılı");
            return redirect()->back();
        }else{
            toastr()->error("Sayfa Güncellenirken Hata Oluştu","Hata");
            return redirect()->back();
        }


    }

    public function switch(Request $request,Page $page){
        $data = ($request->data=="true") ? 1 : 0;
        $page->update(array(
            "status"=>$data
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
    }

    public function trashed(){
        $pages=Page::onlyTrashed()->orderBy('id','desc')->get();
        return view('back.pages.trashed',compact('pages'));
    }

    public function recover($id){
        if (Page::onlyTrashed()->findOrFail($id)->restore()){
            toastr()->success("Sayfa Geri Alındı","Başarılı");
            return redirect()->back();
        }else{
            toastr()->error("Sayfa Geri Alınırken Hata Oluştu","Hata");
            return redirect()->back();
        }
    }

    public function hardDelete($id){
        $data = Page::onlyTrashed()->find($id);
        if (File::exists($data->image))
            File::delete(public_path($data->image));
        $data->forceDelete();
    }

    public function rank(Request $request){
        parse_str($request->data,$data);
        $rank = $data['sirala'];

        foreach ($rank as $key => $value){
            Page::where('id',$value)->update(array(
                "order"=>$key
            ));
        }
    }

    public function validateData(){
        return \request()->validate(array(
            "title"=>"required",
            "image"=>"mimes:jpeg,jpg,png",
            "content"=>"required"
        ),array(
            "title.required"=>"Sayfa Başlığı Alanı Boş Bırakılamaz",
            "image.mimes"=>"JPEG,JPG,PNG Harici Fotoğraf Yüklenemez",
            "content.required"=>"Sayfa Açıklaması Boş Bırakılamaz"
        ));
    }
}
