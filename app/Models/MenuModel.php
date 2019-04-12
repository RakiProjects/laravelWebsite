<?php

namespace App\Models;

class MenuModel{
    
    private $table = 'menu';

    public function getMenuLinks(){
        return \DB::table($this->table)
                ->get();
    }
}