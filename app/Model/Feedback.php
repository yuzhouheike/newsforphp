<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Description of Feedback
 *
 * @author Administrator
 */
class Feedback  extends Model {
    //put your code here
     protected $table = 't_feedback';
    
     //插入feedback
    public function insertFeedBack($arr) {
        return DB::table($this->table)->insertGetId($arr);
    }
     
}
