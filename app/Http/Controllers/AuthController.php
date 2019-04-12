<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Http\Requests\RegisterRequest;

class AuthController extends FrontEndController
{
    private $userModel;

    public function __construct(){
        parent::__construct();
        $this->userModel = new UserModel();
    }
    
    public function loginRegisterView(Request $request){
            return view ("pages.loginRegister", $this->data);
    }

    public function doLogin(Request $request){
        if($request->has('login')){
            $this->userModel->username = $request->input('username1');
            $this->userModel->password = $request->input('password1');
            $user = $this->userModel->checkUserParams();

            if($user){
                $request->session()->put('user', $user);
                \Log::info("[".date('Y-m-d H:i:s')."] je ulogovan korisnik: ".$this->userModel->username);
                return redirect()->route('home')->with("message", "Dobrodošli ".$request->session()->get('user')->username." uživajte.");              
            }else{
                return redirect()->back()->with("message", "Loše korisničko ime ili lozinka."); 
            }
        }
    }

    public function doRegister(RegisterRequest $request){

        $this->userModel->username = $request->input("username");
        $this->userModel->password = $request->input("password");
        $this->userModel->email = $request->input("email");
        $this->userModel->roleId = 2;

        try{
            $this->userModel->insertUser();
            \Log::info("[".date('Y-m-d H:i:s')."] je registrovan korisnik: ".$this->userModel->username.", email: ".$this->userModel->email);
            return redirect()->back()->with("message", "Uspešna registracija.");
        }catch(QueryException $e){
            return redirect()->back()->with("message", "Trenutno imamo probleme sa serverom, Pokušajte kasnije, hvala.");
            \Log::error("Neuspela registracija.." . $e->getMessage());
        }
    }

    public function logout(Request $request){
        if($request->session()->has('user')){
            $this->userModel->username = $request->session()->get('user')->username;
            \Log::info("[".date('Y-m-d H:i:s')."] je izlogovan korisnik: ".$this->userModel->username);
            $request->session()->forget('user');
            $request->session()->flush();
            return redirect()->route('home')->with('message', "Uspešno ste se izlogovali");
            
        }
    }
}
