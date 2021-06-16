<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        if (Auth::check())
        {
            return view("admin.home");
        }
        return view("login");
    }

    public function uyeform()
    {
        return view("admin.userform");
    }

    public function uyeekle(Request $request)
    {

       $adres = Adress::create([
            "Cadde" => $request->cadde,
            "Mahalle" => $request->mahalle,
            "Bina_no" => $request->bina,
            "Sehir" => $request->sehir,
            "Posta_kodu" => $request->postakod,
            "Ulke" => $request->ulke,


        ]);

        DB::table("Uyeler")->insert([
            "Uye_adi" => $request->name,
            "Uye_soyadi" => $request->lastname,
            "cinsiyet" => $request->gender,
            "telefon" => $request->tel,
            "eposta" => $request->email,
            "adres_no" => $adres->Adres_no

        ]);



        alert()->success("Başarılı","Kayıt Oluşturuldu")->showConfirmButton("Tamam","#3085d6");
        return redirect()->route("uyelistesi");
    }
    public function uyesil($Uye_no, $adres_no)
    {
        DB::table("uyeler")->where("Uye_no",$Uye_no)->delete();
        DB::table("adresler")->where("adres_no",$adres_no)->delete();
        return response()->json([
            "success" => true
        ]);

    }

}
