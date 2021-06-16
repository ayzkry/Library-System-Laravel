<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdresController extends Controller
{
    public function adreslistesi()
    {
        $adresler = DB::table("adresler")->get();
        return view("admin.adrestablo",compact("adresler"));
    }
}
