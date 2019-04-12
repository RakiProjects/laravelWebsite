<?php

namespace App\Models;

class UserModel{

    private $table = 'users';
    public $id;
    public $username;
    public $password;
    public $email;
    public $roleId;

    public function getUsers(){
        return \DB::table($this->table)
                    ->join('roles', "$this->table.role_id", "=", "roles.id")
                    ->select("$this->table.id", 'username', 'email', 'created_at', 'updatet_at', 'roles.name')
                    ->get();
    }

    public function getUser($id){
        return \DB::table($this->table)
                    ->join('roles', "$this->table.role_id", "=", "roles.id")
                    ->where("$this->table.id", "=", "$id")
                    ->select("$this->table.id", 'username', 'email', 'password', 'created_at', 'updatet_at', 'roles.name')
                    ->first();
    }

    public function checkUserParams(){
        return \DB::table($this->table.' as u')
                ->join('roles as r', "u.role_id", "=", "r.id")
                ->where([
                    ["username", "=", $this->username],
                    ["password", "=", md5($this->password)]
                ])
                ->select('u.id', 'u.username', 'u.email', 'u.password', 'u.role_id', 'u.created_at', 'u.updatet_at', 'r.id as roleId', 'r.name')
                ->first();
    }

    public function insertUser(){
        \DB::table($this->table)
            ->insert([
                "username" => $this->username,
                "email" => $this->email,
                "password" => md5($this->password),
                "role_id" => $this->roleId,
            ]);
    }

    public function deleteUser($id){
        \DB::table($this->table)
            ->where("users.id", "=", $id)
            ->delete();
    }

    public function updateUserWithPassword($id){
        \DB::table($this->table)
            ->where("$this->table.id", "=", $id)
            ->update(
                ["username" => $this->username, "email" => $this->email, "password" => md5("$this->username"), "role_id" => $this->roleId]
            );
    }
    public function updateUser($id){
        \DB::table($this->table)
            ->where("$this->table.id", "=", $id)
            ->update(
                ["username" => $this->username, "email" => $this->email, "role_id" => $this->roleId]
            );
    }
}