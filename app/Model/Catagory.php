<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Catagory extends Model {

    protected $table = 't_catagory';
    public $timestamps = false;

    //插入分类
    public function insertCatagory($arr) {
        return DB::table($this->table)->insertGetId($arr);
    }

    //查询所有显示的分类
    public function selCatagory() {
        return DB::table($this->table)->orderBy('orderby', 'asc')->where('isshow', '=', 1)->select('id', "catagory")->get();
    }

    public function selCataId($type) {
        return DB::table($this->table)->where('catagory', '=', $type)->lists('id');
    }

    public function checkCatagoryUpdate($servertime) {
        
        $result = DB::table($this->table)->where('isshow', '=', 1);
        
        if(!empty($servertime)){
            $result->where('eidttime', '>', $servertime);
        }
        
        return $result->count();
    }
    
    //后台查询a分类的方法
    public function admCatagory(){
        return  DB::table($this->table)->orderBy("orderby","asc")->get();
        
    }

}
