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
//    return view('front.index');
//});


// ÖN PANEL KISMI
Route::group(['prefix'=>'/','namespace'=>"Front",'as'=>'front.'],function (){
    Route::get('','Homepage@index')->name('index');

    /**
     *  ÖNEMLİ NOT: KAATEGORİYE AİT POSTLAR ROUTE SİNİ ÜSTE ALMAMIZIN SEBEBİ ÇAKIŞMA DURUMUNU ENGELLENEMKTİR :)
     *
     */

    Route::get('/kategori/{category}','Homepage@category')->name('category'); //KATEGORİYE AİT POSTLARI GETİRİR
    Route::get('{category}/{slug}','Homepage@single')->name('single');  // POST SAYFASINA GİDER
});
