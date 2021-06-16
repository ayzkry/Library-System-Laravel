<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class AuthController extends Controller
{
    public function index(){
        return view("login");
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where("email",$email)->first();
        if (Auth::attempt(["email" => $email,"password" => $password])){
            Auth::login($user);
            alert()->success("Başarılı","Giriş Yapıldı")->showConfirmButton("Tamam","#3085d6");
            return redirect()->route("admin");
        }
        else{
            alert()->error("Hata","Giriş Başarısız")->showConfirmButton("Tamam","#3085d6");
            return redirect()->route("login");

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
