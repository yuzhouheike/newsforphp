<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\LewaController;
use App\Model\Catagory;

/**
 * Description of ChannelController
 *
 * @author Administrator
 */
class ChannelController extends LewaController {

    private $catagory;

    public function __construct() {
        $this->catagory = new Catagory();
    }

    public function getAdmChannel() {
        $channel = $this->catagory->admCatagory();
        return view("admin/channel/content")->with('channel', $channel);
    }

}
