<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Token extends Model {
    protected $table = 'user_token_cache';
    
     //插入分类
    public function insertToken($arr) {
        DB::table($this->table)->where("did","=",$arr["did"])->delete();
        return DB::table($this->table)->insertGetId($arr);
    }
    
    //插入分类
    public function SelectToken($createtime,$did) {
       $result = DB::table($this->table)->where('createtime', '>', $createtime)->where("did","=",$did)->first();
       return $result;
    }
}
