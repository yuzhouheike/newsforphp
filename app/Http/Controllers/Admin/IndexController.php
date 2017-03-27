<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\LewaController;
use App\Model\Catagory;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author Administrator
 */
class IndexController extends LewaController{
    //put your code here
   
    
    
    //后台dashboard
    public function index(){
       
        return view("admin/content");
    }
    
    
    
    
}
