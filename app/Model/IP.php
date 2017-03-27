<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class IP extends Model {
    
    protected $table = 'map_ip';
    
     public function getLocationByIp($ip) {
        $query = DB::table($this->table)->where('p_ip_from','<=' ,$ip)->where('p_ip_to','>=' ,$ip)->first();
        return $query;
    }

    
}
