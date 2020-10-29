<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('back.config.index', compact('config'));
    }

    public function update(Request $request, Config $config)
    {
        $data = $this->validateData();

        if ($request->file('logo')) {
            if (File::exists($config->logo))
                File::delete(public_path($config->logo));

            $file = $request->file('logo');
            $file_name = Str::slug($request->title) . "-logo." . $file->getClientOriginalExtension();
            $file->move('logoImage', $file_name);
            $data['logo'] = "logoImage/" . $file_name;
        }

        if ($request->file('favicon')) {
            if (File::exists($config->favicon))
                File::delete(public_path($config->favicon));

            $file = $request->file('favicon');
            $file_name = Str::slug($request->title) . "-favicon." . $file->getClientOriginalExtension();
            $file->move('logoFavicon', $file_name);
            $data['favicon'] = "logoFavicon/" . $file_name;
        }

        if ($config->update($data)){
            toastr()->success("Site Ayarları Başarıyla Güncellendi","Başarılı");
            return redirect()->back();
        }else{
            toastr()->error("Site Ayarları Güncellenirken Hata Oluştu","Hata");
            return redirect()->back();
        }

    }

    public function validateData()
    {
        return \request()->validate(array(
            "title" => "required",
            "active" => "required",
            "logo" => "mimes:jpeg,jpg,png",
            "favicon" => "mimes:jpeg,jpg,png",
            "facebook" => "max:255",
            "twitter" => "max:255",
            "github" => "max:255",
            "linkedin" => "max:255",
            "youtube" => "max:255",
            "instagram" => "max:255"
        ), array(
            "title.required" => "Başlık Alanı Boş Bırakılamaz",

            "active.required" => "Aktiflik Alanı Boş Bırakılamaz",

            "logo.mimes" => "JPEG,JPG,PNG Haricinde Fotoğraf Yüklenemez",
            "favicon.mimes" => "JPEG,JPG,PNG Haricinde Fotoğraf Yüklenemez",

            "facebook.max" => "255 Karakterden Büyük Link Olamaz",
            "twitter.max" => "255 Karakterden Büyük Link Olamaz",
            "github.max" => "255 Karakterden Büyük Link Olamaz",
            "linkedin.max" => "255 Karakterden Büyük Link Olamaz",
            "youtube.max" => "255 Karakterden Büyük Link Olamaz",
            "instagram.max" => "255 Karakterden Büyük Link Olamaz"
        ));
    }
}
