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

    // MAKALELER
    Route::group(['prefix'=>'article','middleware'=>'auth','as'=>'article.'],function (){
        Route::get('','ArticleController@index')->name('index');
        Route::post('','ArticleController@store')->name('store');
        Route::get('create','ArticleController@create')->name('create');
        Route::get('geri-donusum','ArticleController@trashed')->name('trashed');  // silinen makaleleri görecceğiz
        Route::get('geri-al/{id}','ArticleController@recover')->name('recover');
        Route::post('kalici-sil/{id}','ArticleController@hardDelete')->name('hardDelete'); // kalıcı olarak sil dedik
        Route::group(['prefix'=>'{article}'],function (){
            Route::get('edit','ArticleController@edit')->name('edit');
            Route::post('switch','ArticleController@switch')->name('switch');  // aktiflik pasiflik için bunu ayarladık
            Route::patch('','ArticleController@update')->name('update');
            Route::delete('','ArticleController@destroy')->name('delete');
        });

    });

    // KATEGORİLER
    Route::group(['prefix'=>'category','middleware'=>'auth','as'=>'category.'],function (){
        Route::get('','CategoryController@index')->name('index');
        Route::get('create','CategoryController@create')->name('create');
        Route::post('','CategoryController@store')->name('store');
        Route::group(['prefix'=>'{category}'],function (){
            Route::post('switch','CategoryController@switch')->name('switch');
            Route::patch('','CategoryController@update')->name('update');
            Route::delete('','CategoryController@destroy')->name('delete');
        });
    });

    // SAYFALAR
    Route::group(['prefix'=>'page','middleware'=>'auth','as'=>'page.'],function (){
        Route::get('','PageController@index')->name('index');
        Route::post('','PageController@store')->name('store');
        Route::get('create','PageController@create')->name('create');
        Route::get('geri-donusum','PageController@trashed')->name('trashed');
        Route::get('geri-al/{id}','PageController@recover')->name('recover');
        Route::post('sirala','PageController@rank')->name('rank');
        Route::post('kalici-sil/{id}','PageController@hardDelete')->name('hardDelete');
        Route::group(['prefix'=>'{page}'],function (){
            Route::patch('','PageController@update')->name('update');
            Route::get('edit','PageController@edit')->name('edit');
            Route::post('switch','PageController@switch')->name('switch');
            Route::delete('','PageController@destroy')->name('delete');
        });
    });

    // AYARLAR
    Route::group(['prefix'=>'settings','middleware'=>'auth','as'=>'settings.'],function (){
        Route::get('','ConfigController@index')->name('index');
        Route::post('{config}','ConfigController@update')->name('update');
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

