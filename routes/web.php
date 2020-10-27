<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/',function (){
//    return view('home');
//});



// ADMIN PANELİ
Route::group(['prefix'=>'panel','namespace'=>"Back",'as'=>'admin.'],function (){
    // ANA SAYFA
    Route::get('','Dashboard@index')->name('index')->middleware('auth');

    // LOGİN İŞLEMİ
    Route::group(['prefix'=>'login','middleware'=>'isLogin'],function (){
        Route::get('','Login@index')->name('login');
        Route::post('','Login@login')->name('login.post');
    });

    // ÇIKIŞ İŞLEMİ
    Route::group(['prefix'=>"logout"],function (){
        Route::get('','Login@logout')->name('logout')->middleware('auth');
    });

});


// ÖN PANEL KISMI
Route::group(['prefix'=>'/','namespace'=>"Front",'as'=>'front.'],function (){
    Route::get('','Homepage@index')->name('index');

    /*************************************************************************************************************
     *  ÖNEMLİ NOT: KAATEGORİYE AİT POSTLAR ROUTE SİNİ ÜSTE ALMAMIZIN SEBEBİ ÇAKIŞMA DURUMUNU ENGELLENEMKTİR :)
     *
     *  EĞER ALMAMIŞ OLSAYDIK ÖNCE SİNGLE A GİDİP KONTROL YAPACAKTI DOĞRU OLSA BİLE ENGELLEYECEKTİ !!!
     ************************************************************************************************************/

    Route::get('/kategori/{category}','Homepage@category')->name('category'); //KATEGORİYE AİT POSTLARI GETİRİR
    Route::get('sayfa/{page}','Homepage@page')->name('page'); // SAYFALAR (MISYON,VIZYON KISIMLARI)
    Route::get('{category}/{slug}','Homepage@single')->name('single');  // POST SAYFASINA GİDER

    Route::get('iletisim','Homepage@contact')->name('contact'); // İLETİŞİM SAYFASINA GİDER
    Route::post('iletisim','Homepage@contactPost')->name('contactPost'); // İLETİŞİM POST METHODUNA GİDER

});





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
