<?php

namespace App\Http\Controllers;

use App\Models\Kutuphane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KutuphaneController extends Controller
{
    public function kutuphanelistesi()
    {
        $kutuphane = DB::table("kutuphane")->get();

        return view("admin.kutuphane", compact("kutuphane"));
    }

    public function kutuphaneklegoster()
    {
        return view("admin.kutuphaneform");
    }

    public function kutuphanekle(Request $request)
    {
      $kutuphane =  Kutuphane::create([
            "kutuphane_ismi" => $request->kutuphanead,
            "aciklama" => $request->aciklama
        ]);

        DB::table("kitap_kutuphane")->insert([
            "Kutuphane_no" => $kutuphane->kutuphane_no,
            "ISBN" => $request->ISBN,
        ]);

        alert()->success("Başarılı","Oluşturuldu")->showConfirmButton("Tamam","#3085d6");
        return redirect()->route("kutuphanekle");

    }
    public function kutuphanesil($kutuphane_no)
    {
        DB::table("kutuphane")->where("kutuphane_no",$kutuphane_no)->delete();
        return response()->json([
            "success" => true
        ]);

    }


    public function kutuphanegetir($Kutuphane_no)
    {
        $kutuphanegetir = DB::table("kutuphane")->where("kutuphane_no",$Kutuphane_no)->first();

        return response()->json($kutuphanegetir,200);
    }

    public function kutuphaneguncelle(Request $request,$Kutuphane_no)
    {
        DB::table("kutuphane")->where("kutuphane.kutuphane_no",$Kutuphane_no)
            ->update([
                "kutuphane_ismi" => $request->kutuphaneismi,
                "aciklama" => $request->aciklama,
            ]);

        return response()->json([
            "message" => true,
        ]);
    }
}
