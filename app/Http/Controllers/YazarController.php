<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YazarController extends Controller
{
    public function yazarlistesi()
    {
        $yazarlar = DB::table("yazarlar")->get();
        return view("admin.Yazarlar", compact("yazarlar"));
    }

    public function yazareklegoster()
    {
        return view("admin.yazarform");
    }

    public function yazarekle(Request $request)
    {
        DB::table("yazarlar")->insert([
            "Yazar_adi" => $request->yazarad,
            "Yazar_soyadi" => $request->yazarsoyad,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        alert()->success("Başarılı", "Oluşturuldu")->showConfirmButton("Tamam", "#3085d6");
        return redirect()->route("yazarlistesi");
    }

    public function yazarsil($Yazar_no)
    {
        DB::table("yazarlar")->where("Yazar_no", $Yazar_no)->delete();
        return response()->json([
            "success" => true
        ]);

    }

    public function yazargetir($Yazar_no)
    {
        $yazargetir = DB::table("yazarlar")->where("Yazar_no", $Yazar_no)->first();

        return response()->json($yazargetir, 200);
    }

    public function yazarguncelle(Request $request, $yazar_no)
    {
        DB::table("yazarlar")->where("yazar_no", $yazar_no)
            ->update([
                "Yazar_adi" => $request->yazarad,
                "Yazar_soyadi" => $request->yazarsoyad,
            ]);

        return response()->json([
            "message" => true,
        ]);
    }
}
