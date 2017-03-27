<?php

namespace App\Library;

use Memcached;

/**
 * curl　继承类，设置变量较少，以后根据需要逐渐添加
 *
 * 　2013-3-6
 */
class Curl {

    const EXPIRE_MINUTE = 60;
    const EXPIRE_HOUR = 3600;
    const EXPIRE_DAY = 86400;

    private static $_timeout = 3500;
    private static $_conect_timeout = 1000;
    private static $_ci = null;
    private static $_memcache = null;

    function ip_address_to_number($IPaddress) {
        if (!$IPaddress) {
            return false;
        } else {
            $ips = split('\.', $IPaddress);
            return($ips[3] | $ips[2] << 8 | $ips[1] << 16 | $ips[0] << 24);
        }
    }

    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     * curl get请求
     * @param string $url  请求资源连接
     * 
     * return string
     */
    public static function get($url, $header, $type, $params) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        switch ($type) {
            case "GET" :
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case "PUT" :
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
        }
        curl_setopt($curl, CURLOPT_NOSIGNAL, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, self::$_conect_timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, self::$_timeout);
        $result = curl_exec($curl);
        if ($result === false) {
            /* if (self::$_memcache) {
              self::$_memcache->set($memkey, time(), self::EXPIRE_HOUR);
              } */
            return array();
        } else {
            return $result;
        }
    }

    /**
     * curl post请求 
     * @param string $url	 	请求资源连接
     * @param string $param  	请求参数
     * 
     * return string
     */
    public static function post($url, $param, $header) {
        //self::__init_memcache();
        $param_string = gettype($param) !== 'string' ? json_encode($param) : $param;
        $memkey = 'CURL_POST_FAIL_' . md5($url . '_' . $param_string);
        /* if (self::$_memcache) {
          $ret = self::$_memcache->get($memkey);
          if ($ret && intval($ret) + self::EXPIRE_HOUR > time()) {
          return array();
          }
          } */
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, self::$_conect_timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, self::$_timeout);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        $result = curl_exec($curl);
        if ($result === false) {
            /* if (self::$_memcache) {
              self::$_memcache->set($memkey, time(), self::EXPIRE_HOUR);
              } */
            return array();
        } else {
            return $result;
        }
    }

    public static function get_timeout($timeout) {
        return self::$_timeout;
    }

    public static function get_connect_timeout($connect_timeout) {
        return self::$_connect_timeout;
    }

    public static function set_timeout($timeout) {
        self::$_timeout = $timeout;
    }

    public static function set_connect_timeout($connect_timeout) {
        self::$_connect_timeout = $connect_timeout;
    }

}
