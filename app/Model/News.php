<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class News extends Model {

    protected $table = 't_newsdog';

    public function updateNewsDetail($data,$newsid,$language) {
        $news = DB::table($this->table)->where('news_id', $newsid)->where("t_language",$language)->first();
        if (!is_null($news)) {
            return DB::table($this->table) ->where('news_id', $newsid)->update($data);
        } else {
            return DB::table($this->table)->insertGetId($data);
        }
    }
    
    
    public function selectNewsDetail($newsid,$language) {
        $news = DB::table($this->table)->where('news_id', $newsid)->where("t_language",$language)->first();
        return $news;
    }
    
    public function selectNews($newsid,$type) {
        $news = DB::table($this->table)->where('news_id', $newsid)->where("type",$type)->first();
        return $news;
    }

}
