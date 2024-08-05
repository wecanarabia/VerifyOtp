<?php

namespace App\Http\Controllers\dash;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\dash\LoginRequest;

class LoginController extends Controller
{
         private $login ='dash.auth.login';
    private $dash ='dash.dashboard';
    private $route ='dash.login-page';
    private $message = ['unauthorized'=>'messages.controller.UNAUTHORIZED'];

    public function getLogin(){
        return view($this->login);
    }
    public function postLogin(LoginRequest $request){

     $remember_me = $request->has('remember_me') ? true : false;
     if (auth()->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],$remember_me)){
         return redirect()->route($this->dash);
     }
     return redirect()->back()->withInput()->with(['error'=>__($this->message['unauthorized'])]);
    }

    public function logout(){
        auth()->logout();
        return redirect()->route($this->route);
    }


}
