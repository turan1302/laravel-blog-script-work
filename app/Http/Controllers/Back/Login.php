<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class Login extends Controller
{
    public function index()
    {
        return view('back.login_layout.login');
    }

    public function login(Request $request)
    {
        $this->validateData();

        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            toastr()->success("Tekrar Hoşgeldin ".\auth()->user()->name,"Giriş Başarılı");
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with("warning","E-Mail Adresiniz ve/veya Şifreniz Yanlış");
        }

    }

    public function logout(){
        Auth::logout(); // çıkış yap dedik
        toastr()->success("Çıkış Başarıyla Yapıldı","Başarılı");
        return redirect()->route('admin.login'); // yönlendirdik
    }

    public function validateData()
    {
        return \request()->validate(array(
            "email" => "required|email",
            "password" => "required|min:8|max:32",
        ), array(
            "email.required" => "E-Mail Alanı Boş Bırakılamaz",
            "email.email" => "Lütfen Geçerli Bir E-Mail Giriniz",

            "password.required" => "Şifre Alanı Boş Bırakılamaz",
            "password.min" => "Şifre 8 Karakterden Küçük Olamaz",
            "password.max" => "Şifre 32 Karakterden Büyük Olamaz"
        ));
    }
}
