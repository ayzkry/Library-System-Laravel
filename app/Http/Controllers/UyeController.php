<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UyeController extends Controller
{
    public function uyelistesi()
    {
        $uyeler = DB::table("uyeler")->get();
        return view("admin.uyetablo", compact("uyeler"));
    }

    public function uyegetir($adresno)
    {
        $uyegetir = DB::table("uyeler")->join("adresler", "adresler.Adres_no", "uyeler.adres_no")
            ->where("uyeler.adres_no", $adresno)->first();


        return response()->json($uyegetir, 200);

    }

    public function uyeguncelle(Request $request, $adresno)
    {
        DB::table("uyeler")->join("adresler", "adresler.Adres_no", "uyeler.adres_no")
            ->where("uyeler.adres_no", $adresno)
            ->update([
                "Uye_adi" => $request->uyead,
                "Uye_soyadi" => $request->uyesoyad,
                "cinsiyet" => $request->cinsiyet,
                "telefon" => $request->tel,
                "eposta" => $request->mail,
                "Cadde" => $request->cadde,
                "Mahalle" => $request->mahalle,
                "Bina_no" => $request->binano,
                "Sehir" => $request->sehir,
                "Posta_kodu" => $request->postakod,
                "Ulke" => $request->ulke,
            ]);

        return response()->json([
            "message" => true,
        ]);
    }

    public function yazargetir($Yazar_no)
    {
        $yazargetir = DB::table("yazarlar")->where("Yazar_no", $Yazar_no)->first();
        return response()->json($yazargetir, 200);
    }

    public function yazarguncelle(Request $request, $yazar_no)
    {
        DB::table("yazarlar")->join("yazarlar", "yazarlar.Yazar_no", "yazarlar.yazar_no")
            ->where("yazarlar.yazar_no", $yazar_no)
            ->update([
                "Yazar_no" => $request->yazarno,
                "Yazar_adi" => $request->yazarad,
                "Yazar_soyadi" => $request->yazarsoyad,
            ]);
        return response()->json([
            "message" => true,
        ]);


    }
}
