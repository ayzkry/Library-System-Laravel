<?php

use Illuminate\Support\Facades\Route;



Route::get('/', "AuthController@index")->name("login");
Route::post('/', "AuthController@login");
Route::get("/logout", "AuthController@logout")->name("logout");

Route::prefix("admin")->middleware("auth")->group(function (){
    Route::get('/', "AdminController@index")->name("admin");
    Route::get('/uyeform', "AdminController@uyeform")->name("uyeform");
    Route::post('/uyeform', "AdminController@uyeekle");
    Route::delete('/uyesil/{Uye_no}/{adres_no}', "AdminController@uyesil");
    Route::get("/uyeguncelle/{adresno}","UyeController@uyegetir");
    Route::put("/uyeguncelle/{adresno}","UyeController@uyeguncelle");
    Route::get('/uyelistesi', "UyeController@uyelistesi")->name("uyelistesi");
    Route::get('/adreslistesi', "AdresController@adreslistesi")->name("adreslistesi");



    Route::get('/emanetlerlistesi', "EmanetController@emanetlerlistesi")->name("emanetlerlistesi");
    Route::get('/emanetekle', "EmanetController@emaneteklegoster")->name("emaneteklegoster");
    Route::post('/emanetekle', "EmanetController@emanetekle");
    Route::delete('/emanetsil/{Emanet_no}', "EmanetController@emanetsil");
    Route::get("/emanetguncelle/{Emanet_no}","EmanetController@emanetgetir");
    Route::put("/emanetguncelle/{Emanet_no}","EmanetController@emanetguncelle");




    Route::get('/kutuphanelistesi', "KutuphaneController@kutuphaneListesi")->name("kutuphaneListesi");
    Route::get('/kutuphanekle', "KutuphaneController@kutuphaneklegoster")->name("kutuphanekle");
    Route::post('/kutuphanekle', "KutuphaneController@kutuphanekle");
    Route::delete('/kutuphanesil/{kutuphane_no}', "KutuphaneController@kutuphanesil");
    Route::get("/kutuphaneguncelle/{Kutuphane_no}","KutuphaneController@kutuphanegetir");
    Route::put("/kutuphaneguncelle/{Kutuphane_no}","KutuphaneController@kutuphaneguncelle");


    Route::get('/kitaplistesi', "KitapController@kitaplistesi")->name("kitaplistesi");
    Route::get('/kitapekle',"KitapController@kitapeklegoster")->name("kitapekle");
    Route::post('/kitapekle',"KitapController@kitapekle");
    Route::delete('/kitapsil/{Kitap_no}', "KitapController@kitapsil");
    Route::get("/kitapguncelle/{kitap_no}","KitapController@kitapgetir");
    Route::put("/kitapguncelle/{kitap_no}","KitapController@kitapguncelle");



    Route::get('/yazarlistesi', "YazarController@yazarlistesi")->name("yazarlistesi");
    Route::get('/yazarekle', "YazarController@yazareklegoster")->name("yazarekle");
    Route::post('/yazarekle', "YazarController@yazarekle");
    Route::delete('/yazarsil/{Yazar_no}', "YazarController@yazarsil")->name("yazarsil");
    Route::get("/yazarguncelle/{Yazarno}","YazarController@yazargetir");
    Route::put("/yazarguncelle/{Yazarno}","YazarController@yazarguncelle");

    Route::get('/kategorilistesi', "KategoriController@kategorilistesi")->name("kategorilistesi");
    Route::get('/kategoriekle', "KategoriController@kategorieklegoster")->name("kategoriekle");
    Route::post('/kategoriekle', "KategoriController@kategoriekle");
    Route::delete('/kategorisil/{Kategori_no}', "KategoriController@kategorisil");
    Route::get("/kategoriguncelle/{Kategori_no}","KategoriController@kategorigetir");
    Route::put("/kategoriguncelle/{Kategori_no}","KategoriController@kategoriguncelle");
});
