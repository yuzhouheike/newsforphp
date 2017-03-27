<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favour extends Model {

    protected $table = 't_news_like';
    protected $user_like_table = 't_user_like';

    public function getNewsFavourForId($id) {
        $news = DB::table($this->table)->where('news_id', '=', $id)->first();
        return $news;
    }

    public function getUserLikeForId($id, $token) {
        $record = DB::table($this->user_like_table)->where('news_id', $id)->where('token', $token)->first();
        return $record;
    }

    public function recordUserFavour($news_id, $action, $token) {
        $news = DB::table($this->table)->where('news_id', '=', $news_id)->first();
        $record = DB::table($this->user_like_table)->where('news_id', $news_id)->where('token', $token)->first();

        if (!is_null($news)) {
            if ($action == "like") {
                //用户对这条新闻没有记录
                if (!is_null($record)) {
                    if ($record->unlike == "true") {
                        DB::statement("update {$this->table} set unlike_count = unlike_count - 1 where news_id = '{$news_id}'");
                    }
                }
                DB::statement("update {$this->table} set like_count = like_count + 1 where news_id = '{$news_id}'");
            } else {
                if (!is_null($record)) {
                    if ($record->like == "true") {
                        DB::statement("update {$this->table} set like_count = like_count - 1 where news_id = '{$news_id}'");
                    }
                }
                DB::statement("update {$this->table} set unlike_count = unlike_count + 1 where news_id = '{$news_id}'");
            }
        } else {
            $data["news_id"] = $news_id;
            if ($action == "like") {
                $data["like_count"] = 1;
                $data["unlike_count"] = 0;
            } else {
                $data["like_count"] = 0;
                $data["unlike_count"] = 1;
            }
            return DB::table($this->table)->insertGetId($data);
        }
    }

    public function minusLike($news_id) {
        return DB::statement("update {$this->table} set like_count = like_count - 1 where news_id = '{$news_id}'");
    }

    public function minusUnLike($news_id) {
        return DB::statement("update {$this->table} set unlike_count = unlike_count - 1 where news_id = '{$news_id}'");
    }

    public function recordFakeData($like, $unlike, $news_id) {
        $data["like_count"] = $like;
        $data["unlike_count"] = $unlike;
        $data["news_id"] = $news_id;
        return DB::table($this->table)->insertGetId($data);
    }

    public function recordUserLike($newsid, $token, $like, $unlike) {
        $record = DB::table($this->user_like_table)->where('news_id', $newsid)->where('token', $token)->first();
        if (!is_null($record)) {
            $data["like"] = $like;
            $data["unlike"] = $unlike;
            return DB::table($this->user_like_table)->where('news_id', $newsid)->where('token', $token)->update($data);
        } else {
            $data["news_id"] = $newsid;
            $data["token"] = $token;
            $data["like"] = $like;
            $data["unlike"] = $unlike;
            return DB::table($this->user_like_table)->insertGetId($data);
        }
    }

}
