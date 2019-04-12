<?php

namespace App\Models;


class ColorsModel {

    private $table = "colors";

    public function getColors(){
        return \DB::table($this->table)
            ->get();
    }
}