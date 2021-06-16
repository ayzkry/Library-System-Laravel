<?php

namespace App\Http\Controllers;

use App\Models\Kitap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitapController extends Controller
{
    public function kitaplistesi()
    {

        $kitap = DB::table("kitaplar")
            ->join("kitap_yazar", "kitap_yazar.ISBN", "kitaplar.ISBN")
            ->join("yazarlar", "yazarlar.Yazar_no", "kitap_yazar.yazar_no")
            ->join("kitap_kutuphane","kitap_kutuphane.ISBN","kitaplar.ISBN")
            ->join("kitap_kategori","kitap_kategori.ISBN","kitaplar.ISBN")
            ->join("kategoriler","kategoriler.Kategori_no","kitap_kategori.kategori_no")
            ->join("kutuphane","kutuphane.kutuphane_no","kitap_kutuphane.Kutuphane_no")
            ->get();
        $kategori = DB::table("kategoriler")->get();
        $kutuphane = DB::table("kutuphane")->get();
        $yazar = DB::table("yazarlar")->get();


        return view("admin.kitaplar",compact("kitap","kategori","kutuphane","yazar"));
    }

    public function kitapeklegoster()
    {
        $kategori = DB::table("kategoriler")->get();
        $yazar = DB::table("yazarlar")->get();
        $kutuphane = DB::table("kutuphane")->get();
        return view("admin.kitapform", compact("yazar", "kategori", "kutuphane"));
    }

    public function kitapekle(Request $request)
    {

        Kitap::create([
            "kitap_adi" => $request->kitapad,
            "ISBN" => $request->ISBN,
            "Yayın_tarihi" => $request->yayintarihi,
            "S_sayisi" => $request->sayfasayisi
        ]);
        DB::table("kitap_yazar")->insert([
            "ISBN" => $request->ISBN,
            "yazar_no" => $request->yazarno,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        DB::table("kitap_kategori")->insert([
            "ISBN" => $request->ISBN,
            "kategori_no" => $request->kategorino,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        DB::table("kitap_kutuphane")->insert([
            "ISBN" => $request->ISBN,
            "Kutuphane_no" => $request->kutuphaneno,
            "miktar" => $request->miktar,
            "created_at" => now(),
            "updated_at" => now(),
        ]);


        alert()->success("Başarılı", "Oluşturuldu")->showConfirmButton("Tamam", "#3085d6");
        return redirect()->route("kitaplistesi");
    }
    public function kitapsil($Kitap_no)
    {
         DB::table("kitaplar")->where("ISBN",$Kitap_no)->delete();
         DB::table("kitap_kategori")->where("ISBN",$Kitap_no)->delete();
         DB::table("kitap_kutuphane")->where("ISBN",$Kitap_no)->delete();
         DB::table("kitap_yazar")->where("ISBN",$Kitap_no)->delete();
        return response()->json([
            "success" => true
        ]);

    }

    public function kitapgetir($kitap_no)
    {
        $kitap = DB::table("kitaplar")
            ->join("kitap_yazar", "kitap_yazar.ISBN", "kitaplar.ISBN")
            ->join("yazarlar", "yazarlar.Yazar_no", "kitap_yazar.yazar_no")
            ->join("kitap_kutuphane","kitap_kutuphane.ISBN","kitaplar.ISBN")
            ->join("kitap_kategori","kitap_kategori.ISBN","kitaplar.ISBN")
            ->join("kategoriler","kategoriler.Kategori_no","kitap_kategori.kategori_no")
            ->join("kutuphane","kutuphane.kutuphane_no","kitap_kutuphane.Kutuphane_no")
            ->where("kitaplar.ISBN",$kitap_no)
            ->first();

        return response()->json($kitap,200);
    }

    public function kitapguncelle(Request $request, $kitap_no)
    {
        DB::table("kitaplar")->where("ISBN",$kitap_no)->update([
            "kitap_adi" => $request->kitapadi,
            "Yayın_tarihi" => $request->yayintarihi,
            "S_sayisi" => $request->sayfasayisi

        ]);

        DB::table("kitap_kategori")->where("ISBN",$kitap_no)->update([
            "kategori_no" => $request->kategorino
        ]);;

        DB::table("kitap_yazar")->where("ISBN",$kitap_no)->update([
            "yazar_no" => $request->yazarno
        ]);;

        DB::table("kitap_kutuphane")->where("ISBN",$kitap_no)->update([
            "Kutuphane_no" => $request->kutuphaneno
        ]);;

        return response()->json([
            "success" => true
        ]);
    }
}
