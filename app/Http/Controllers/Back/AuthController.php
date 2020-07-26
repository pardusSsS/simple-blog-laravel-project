<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function foo\func;

class AuthController extends Controller
{

    //lOGİN İŞLEMLERİ-------------------------------------------------------------------------------
    public function login(){
        return view('back.auth.login');
    }


    public function loginpost(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login')->withErrors('Email veya şifre hatalı');
        }
    }
//----------------------------------------------------------------------------------------------------



   //ÜYELİK İŞLEMLERİ ---------------------------------------------------------
    public function uyelik(){
        return view('back.auth.register');
    }

    public function uyelikpost(Request $request){

        if($request->password === $request->password2)
        {
            $difpasw = Hash::make($request->password);

            $data = new admin();
            $data-> name = $request->name;
            $data-> email =$request->email;
            $data->password = $difpasw;


            $data->save();

            return redirect('admin/giris');
        }else{
            return 'Şifreleriniz Uyuşmamaktadır';
        }


    }

    //------------------------------------------------------------------------------------


//Logout Islemleri-------------------------------------------------------------------

    public function logout(){
Auth::logout();

      return redirect()->route('homepage');


    }

}

//-----------------------------------------------------------------------------------------