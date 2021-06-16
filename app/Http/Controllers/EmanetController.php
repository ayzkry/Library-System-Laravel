<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmanetController extends Controller
{
    public function emanetlerlistesi()
    {
        $emanet = DB::table("emanet")
            ->join("kutuphane", "kutuphane.kutuphane_no", "emanet.kutuphane_no")
            ->join("uyeler", "uyeler.Uye_no", "emanet.Uye_no")
            ->join("kitaplar","kitaplar.ISBN","emanet.ISBN")
            ->get();
        $kitap = DB::table("kitaplar")->get();
        $kutuphane = DB::table("kutuphane")->get();
        $uyeler = DB::table("uyeler")->get();
        return view("admin.emanettablo", compact("emanet","kitap","kutuphane","uyeler"));
    }

    public function emaneteklegoster()
    {
        $kutuphane = DB::table("kutuphane")->get();
        $uyeler = DB::table("uyeler")->get();
        $kitap = DB::table("kitaplar")->get();
        return view("admin.emanetform", compact("kitap", "uyeler", "kutuphane",));
    }


    public function emanetekle(Request $request)
    {
        DB::table("emanet")->insert([
            "ISBN" => $request->ISBN,
            "uye_no" => $request->uyeno,
            "kutuphane_no" => $request->kutuphaneno,
            "emanet_tarihi" => $request->emanetarihi,
            "teslim_tarihi" => $request->teslimtarihi,
        ]);

        alert()->success("Başarılı", "Oluşturuldu")->showConfirmButton("Tamam", "#3085d6");
        return redirect()->route("emanetlerlistesi");
    }

    public function emanetsil($Emanet_no)
    {
        DB::table("emanet")->where("Emanet_no", $Emanet_no)->delete();
        return response()->json([
            "success" => true
        ]);

    }

    public function emanetgetir($emanet_no)
    {

        $emanetgetir = DB::table("emanet")
            ->join("kutuphane", "kutuphane.kutuphane_no", "emanet.kutuphane_no")
            ->join("uyeler", "uyeler.Uye_no", "emanet.Uye_no")
            ->join("kitaplar","kitaplar.ISBN","emanet.ISBN")
            ->where("emanet.Emanet_no", $emanet_no)
            ->first();


        return response()->json([

            "emanet" => $emanetgetir,

        ], 200);
    }

    public function emanetguncelle(Request $request, $Emanet_no)
    {
        DB::table("emanet")->where("Emanet_no",$Emanet_no)
            ->update([
                "ISBN" => $request->ISBN,
                "uye_no" => $request->uyeno,
                "kutuphane_no" => $request->kutuphaneno,
                "emanet_tarihi" => $request->emanetarihi,
                "teslim_tarihi" => $request->teslimtarihi,

            ]);

        return response()->json([
            "message" => true,
        ]);
    }
}
