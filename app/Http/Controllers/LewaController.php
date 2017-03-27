<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Library\Api;
use App\Library\Curl;

/**
 *
 * @author Administrator
 */
class LewaController extends Controller {
    //put your code here
    
    public function curl_get($url, $header, $type = "GET", $postData = "") {

        $result = Curl::get($url, $header, $type, $postData);
        if (!empty($result)) {
            $result = json_decode($result, true);
            if (is_array($result) && !empty($result)) {
                return $result;
            }
        }
        return array();
    }
    
    public function array_remove($data, $key) {
        if (!array_key_exists($key, $data)) {
            return $data;
        }
        $keys = array_keys($data);
        $index = array_search($key, $keys);
        if ($index !== FALSE) {
            array_splice($data, $index, 1);
        }
        return $data;
    }

    public function set_err_return($result) {
        if (array_key_exists("err_code", $result)) {
            if (count($result) == count($result, 1)) {
                Api::set_key("result_object");
            }
            Api::set_code($result["err_code"]);
            Api::set_message($result["err_msg"]);
            Api::response();
        }
    }
    
    public function formatKey($did, $ntype,$language) {
        $arr["ntype"] = $ntype;
        $arr["company"] = "android:lewa";
        switch ($language) {
            case "english":
                $arr["lang"] = "en";
                break;
            case "india":
                $arr["lang"] = "hi";
                break;
            default :
                $arr["lang"] = "en";
                break;
        }
        $arr["region"] = "IN";
        $arr["long"] = 121.48;
        $arr["lat"] = 31.22;
        $arr["did"] = $did;
        $str = http_build_query($arr);
        return $str;
    }

    public function getallheaders() {
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', strtolower(str_replace('_', ' ', substr($name, 5))))] = $value;
            }
        }
        return $headers;
    }

    public function checkParam($keyArr, $json) {
        $flag = true;
        if (!is_null($json)) {
            foreach ($keyArr as $k) {
                $isset = property_exists($json, $k);
                if (!$isset) {
                    $flag = false;
                    break;
                }
            }
        } else {
            $flag = false;
        }

        if (!$flag) {
            $code = 400;
            $msg = "param is invalid";
            Api::set_code($code);
            Api::set_message($msg);
            Api::response();
        }
    }
}
