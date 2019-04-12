<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    private $data = [];
    private $users = null;

    public function __construct(){
        $this->users = new UserModel(); 
    }

    public function index()
    {      
        return view("admin.users.index");   
    }

    public function getAllUsers(){
        return $this->users->getUsers();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $this->users->username = $request->input("username");
        $this->users->password = $request->input("password");
        $this->users->email = $request->input("email");
        $this->users->roleId = $request->input("role");
      
        try{
            $this->users->insertUser();
            return redirect('admin/korisnici')->with("message", "Uspešno je dodat korisnik.");
        }catch(QueryExpection $e){
            return redirect()->back()->with("message", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      
        $this->data['user'] = $this->users->getUser($id);
        return view("admin.users.edit", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->input('password') ==null) {
            $request->validate([
                'username' =>'required|regex:/^[A-Za-z][A-Za-z0-9\-\.\_]{2,}$/',
                'email' =>'required|email|max:60',
            ]);
        }else{
            $request->validate([
                'username' =>'required|regex:/^[A-Za-z][A-Za-z0-9\-\.\_]{2,}$/',
                'email' =>'required|email|max:60',
                'password' =>'required|string|min:4|confirmed',
            ]);
        }

        $this->users->username = $request->input('username');
        $this->users->email = $request->input('email');       
        $this->users->roleId = $request->input('role');

        $bool = \DB::table('users')
                ->where([
                     ["id" , "<>", $id],
                     ["username", "=", $this->users->username]
                    ])
                ->first();
        if($bool == null){
            if($request->input('password') !=null){
                $this->users->password = $request->input('password');
                $this->users->updateUserWithPassword($id);
                return redirect('admin/korisnici')->with('message', "Uspešno je ažuriran korisnik");
            }else{
                $this->users->updateUser($id);
                return redirect('admin/korisnici')->with('message', "Uspešno je ažuriran korisnik");
            }
        }else{
            return redirect()->back()->with("message", "Username je zauzet");
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
         $this->users->deleteUser($id);
         return response(null, 204);
      }catch(QueryException $e){
          return response(null, 500);      
      }

    }
}
