<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function kategorilistesi()
    {
        $kategoriler = DB::table("kategoriler")->get();
        return view("admin.kategoriler", compact("kategoriler"));
    }

    public function kategorieklegoster()
    {
        return view("admin.kategoriform");
    }

    public function kategoriekle(Request $request)
    {
        $test = DB::table("kategoriler")->insert([
            "Kategori_adi" => $request->kategoriad,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        alert()->success("Başarılı", "Oluşturuldu")->showConfirmButton("Tamam", "#3085d6");
        return redirect()->route("kategoriekle");
    }

    public function kategorisil($Kategori_no)
    {
        DB::table("kategoriler")->where("Kategori_no", $Kategori_no)->delete();

        return response()->json([
            "success" => true
        ]);
    }

    public function kategorigetir($Kategori_no)
    {
        $kategorigetir = DB::table("kategoriler")->where("Kategori_no",$Kategori_no)->first();

        return response()->json($kategorigetir,200);
    }

    public function kategoriguncelle(Request $request,$Kategori_no)
    {
        DB::table("kategoriler")->where("Kategori_no",$Kategori_no)
            ->update([
                "Kategori_adi" => $request->kategoriadi,
            ]);

        return response()->json([
            "message" => true,
        ]);
    }
}
