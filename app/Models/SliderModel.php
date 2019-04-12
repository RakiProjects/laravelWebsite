<?php

namespace App\Models;

class SliderModel {

    private $table = 'pictures';

    public function getSliders(){
        return \DB::table($this->table)
                ->where("src", "like", "images/slider/%")
                ->get();
    }
}