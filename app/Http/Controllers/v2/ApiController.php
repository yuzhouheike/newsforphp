<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\LewaController;
use App\Library\Api;
use App\Library\Curl;
use App\Model\Favour;
use App\Model\Feedback;
use App\Model\IP;
use App\Model\News;
use App\Model\Token;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use phpQuery;
use function pq;

class ApiController extends LewaController {

    private $code = 200;
    private $msg = "";
    private $favourModel;
    private $language;
    private $base_url;
    private $newsModel;
    private $request_get;
    private $tokenModel;

    public function __construct() {
        $this->favourModel = new Favour();
        $this->newsModel = new News();
        $this->tokenModel = new Token();
        $this->language = Input::get("language");
        $logPath = Config::get('app.api_log_path');
        $request = file_get_contents("php://input");
        $ip = Curl::get_client_ip();
        $did = "";
        $ntype = "";

        foreach (parent::getallheaders() as $name => $value) {
            if ($name == "did") {
                $did = $value;
            }
            if ($name == "ntype") {
                $ntype = $value;
            }
            if ($name == "appname") {
                $appName = $value;
            }
        }
        $this->request_get = parent::formatKey($did, $ntype, $this->language);

        @ file_put_contents($logPath . date("Y-m-d") . '.log', date("H:i:s") . $appName . ":" . $ip . $_SERVER['PHP_SELF'] . "?" . $this->request_get . " \r\n" . $request . " \r\n", FILE_APPEND);
        switch ($this->language) {
            case "english":
                $this->base_url = Config::get('app.api_en_url');
                $this->language = "english";
                break;
            case "india":
                $this->base_url = Config::get('app.api_in_url');
                $this->language = "india";
                break;
            default :
                $this->base_url = Config::get('app.api_en_url');
                $this->language = "english";
                break;
        }
    }

//获取文章推荐
    public function getFavour() {
        $postData = json_decode(file_get_contents('php://input'));

        $validData = array("id", "token", "type");
        $this->checkParam($validData, $postData);

        $news_id = $postData->id;
        $token = $postData->token;
        $type = $postData->type;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $ApiUrl2 = $this->base_url . "v2/articles/{$type}/{$news_id}/?" . $this->request_get;
        $result = parent::curl_get($ApiUrl2, $header);
        parent::set_err_return($result);
        $result = parent::array_remove($result, "has_commented");
        $result = parent::array_remove($result, "media");
        $result = parent::array_remove($result, "op_recommend");
        $result = parent::array_remove($result, "related_articles");
        $result = parent::array_remove($result, "seq_id");
        $result = parent::array_remove($result, "share_url");
        $result = parent::array_remove($result, "key_words");
        $result = parent::array_remove($result, "top_images");
        $result = parent::array_remove($result, "shared_count");
        $result = parent::array_remove($result, "comments_count");
        $result = parent::array_remove($result, "liked");
        $result = parent::array_remove($result, "is_hot");
        $result = parent::array_remove($result, "favored");
        $result = parent::array_remove($result, "bigger");
        $newsContent = $result["content"];
        $newsContent=str_replace("\n","",$newsContent);
        $adStrReg = '/<a target="_blank".*src="http:\/\/static.newsdog.today\/app_download_banner.png".*<\/a>/';
        $newsContent = preg_replace($adStrReg, "", $newsContent);
        $doc = phpQuery::newDocumentHTML($newsContent);
        phpQuery::selectDocument($doc);
        foreach (pq(".image") as $key => $img) {
            if (isset($result["related_images"][$key]['origin'])) {
                $img_content = "<img src='{$result["related_images"][$key]['origin']}'>";
                $insert_img = phpQuery::newDocumentHTML($img_content);
                pq($img)->html($insert_img);
            }
        }
        $neoHtml = str_replace('<a class="image">', '<a class="image" style="width:100%;display:block;text-algin:center">', $doc->htmlOuter());
        $neoHtml = str_replace('<h1>', '<h6>', $neoHtml);
        $neoHtml = str_replace('</h1>', '</h6>', $neoHtml);
        $result["content"] = $neoHtml;
        $favourDetail = $this->favourModel->getNewsFavourForId($result["id"]);
        $userLike = $this->favourModel->getUserLikeForId($result["id"], $token);
        $result["liked"] = 0;
        if (is_null($userLike)) {
            $result["liked"] = 0;
        } else if ($userLike->like == "true") {
            $result["liked"] = 1;
        } else if ($userLike->unlike == "true") {
            $result["liked"] = 2;
        }
        $result["like_count"] = rand(12, 81);
        $result["unlike_count"] = rand(2, 12);
        if (!is_null($favourDetail)) {
            $result["like_count"] = $favourDetail->like_count;
            $result["unlike_count"] = $favourDetail->unlike_count;
        } else {
            $this->favourModel->recordFakeData($result["like_count"], $result["unlike_count"], $result["id"]);
        }
        $result["detail_url"] = Config::get('app.news_detail_url') . "?id={$news_id}&language={$this->language}&type={$type}";
        $ApiUrl = $this->base_url . "v2/articles/{$type}/{$news_id}/similar_articles/?" . $this->request_get;
        $result2 = parent::curl_get($ApiUrl, $header);
        $result2["articles"] = isset($result2["articles"]) ? $result2["articles"] : array();
        $blackList = Config::get("app.black_source");
        if ($type == "article") {
            $result['subscribed'] = is_null($result['subscribed']) ? false : $result['subscribed'];
            foreach ($result2["articles"] as $key => $r) {
                if (in_array($result2["articles"][$key]["site_url"], $blackList)) {
                    unset($result2["articles"][$key]);
                } else {
                    $result2["articles"][$key]["detail_url"] = Config::get('app.news_detail_url') . "?id=" . $result2["articles"][$key]["id"] . "&language=" . $this->language . "&type=" . $result2["articles"][$key]["type"];
                }
            }
            $favourList = array_values($result2["articles"]);
            $result["favour"] = $favourList;
        } else if ($type == "youtube_video") {
            $result['subscribed'] = false;
            foreach ($result2["articles"] as $key => $r) {
                $result2["articles"][$key]["detail_url"] = Config::get('app.news_detail_url') . "?id=" . $result2["articles"][$key]["id"] . "&language=" . $this->language . "&type=" . $result2["articles"][$key]["type"];
            }
            $favourList = array_values($result2["articles"]);
            $result["favour"] = $favourList;
            $result["related_images"] = array();
            $result["source"] = "";
            $result["title"] = "";
            $result["published_at"] = "";
            $result["site_url"] = "";
            $result["source_url"] = "http://www.youtube.com/embed/{$result["youtube"][0]}";
        }


        Api::set_key("result_object");
        Api::response($result);
    }

    //获取城市列表
    public function getCity() {
        $ip = Curl::get_client_ip();
        $longIp = $this->ip_address_to_number($ip);
        $ipModel = new IP();
        $locationResult = $ipModel->getLocationByIp($longIp);
        $location;
        if (is_null($locationResult)) {
            $location = "null";
        } else {
            $location = $locationResult->p_city;
        }
        $ApiUrl = $this->base_url . "v1/categories/cities/?" . $this->request_get;
        $final_token = Config::get("app.english_token");
        $this->language = Input::get("language");
        switch ($this->language) {
            case "english":
                $final_token = Config::get("app.english_token");
                break;
            case "india":
                $final_token = Config::get("app.india_token");
                break;
            default :
                $final_token = Config::get("app.english_token");
                break;
        }
        $header = array('Content-Type: application/json', "Authorization: HIN {$final_token}");
        $result = parent::curl_get($ApiUrl, $header);
        array_unshift($result, $location);
        Api::response($result);
    }

    public function getMedia($token, $header) {
        $ApiUrl = $this->base_url . "v1/medias/subscribed/?" . $this->request_get;
        $result = parent::curl_get($ApiUrl, $header);
        return $result;
    }

    public function feedback() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("email", "type", "question");
        $this->checkParam($validData, $postData);
        $data["type"] = $postData->type;
        $data["email"] = $postData->email;
        $data["question"] = $postData->question;
        $data["subtime"] = date("Y-m-d H:i:s");
        $feedBackModel = new Feedback();
        $id = $feedBackModel->insertFeedBack($data);
        Api::set_key("result_object");
        Api::response();
    }

    public function dbToDetail($newsid, $final_token, $newstype) {
        $news_id = $newsid;
        $token = $final_token;
        $type = $newstype;
        $ApiUrl = $this->base_url . "v2/articles/{$type}/{$news_id}/";
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $result = parent::curl_get($ApiUrl, $header);
        parent::set_err_return($result);
        if ($result["type"] == "article") {
            $news_data['news_id'] = $result["id"];
            $news_data['title'] = $result["title"];
            $news_data['content'] = $result["content"];
            if (count($result["top_images"]) > 0) {
                $news_data['top_image'] = $result["top_images"][0]['origin'];
                $news_data['top_image_width'] = $result["top_images"][0]['width'];
                $news_data['top_image_height'] = $result["top_images"][0]['height'];
            }
            if (count($result["related_images"]) > 0) {
                $related_image = "";
                foreach ($result["related_images"] as $r) {
                    $related_image .= $r["origin"] . ",";
                }
                $related_image = substr($related_image, 0, strlen($related_image) - 1);
                $news_data['related_images'] = $related_image;
                $news_data['related_image_width'] = $result["related_images"][0]['width'];
                $news_data['related_image_height'] = $result["related_images"][0]['height'];
            }
            $news_data['source'] = $result["source"];
            $news_data['type'] = $result["type"];
            $news_data['published_at'] = $result["published_at"];
            $news_data['source_url'] = $result["source_url"];
            $news_data['t_language'] = $this->language;
        } else {
            $news_data['news_id'] = $result["id"];
            $news_data['content'] = $result["content"];
            $news_data['top_image'] = $result["top_images"][0]['origin'];
            $news_data['top_image_width'] = $result["top_images"][0]['width'];
            $news_data['top_image_height'] = $result["top_images"][0]['height'];
            $news_data['source'] = $result["youtube"][0];
            $news_data['type'] = $result["type"];
            $news_data['source_url'] = "http://www.youtube.com/embed/{$result["youtube"][0]}?autoplay=1&showinfo=0";
            $news_data['t_language'] = $this->language;
        }

        $this->newsModel->updateNewsDetail($news_data, $result['id'], $this->language);
    }

    public function reloadToken() {
        $ApiUrl = $this->base_url . "v1/users/?" . $this->request_get;
        $postData["user_info"]["source_uid"] = uniqid();
        $postData["user_info"]["phone_type"] = "android";
        $postData["user_info"]["resolution"] = "480*800";
        $postData["user_info"]["source"] = "android:lewa";
        $postData["user_info"]["from"] = "android:lewa";
        $postData["user_info"]["avatar"] = "";
        $postData["user_info"]["name"] = "";
        $postData["user_info"]["oauth_token"] = "";
        $postData["user_info"]["gender"] = "";
        $postData["user_info"]["age"] = "";
        $post = json_encode($postData);
        $header = array('Content-Type: application/json', 'Content-Length: ' . strlen($post));
        $result = parent::curl_get($ApiUrl, $header, "POST", $post);
        return $result;
    }
    
    
    //文章webview
    public function getWebView() {
        $news_id = Input::get("id");
        $nopic = is_null(Input::get("nopic")) ? "no" : Input::get("nopic");
        $atNight = is_null(Input::get("atnight")) ? "no" : Input::get("atnight");
        $font = is_null(Input::get("font")) ? "m" : Input::get("font");
        $type = Input::get("type");
        $tokenInfo = $this->reloadToken();
        $final_token = Config::get("app.english_token");
        if (array_key_exists("err_code", $tokenInfo)) {
            $this->language = Input::get("language");
            switch ($this->language) {
                case "english":
                    $final_token = Config::get("app.english_token");
                    break;
                case "india":
                    $final_token = Config::get("app.india_token");
                    break;
                default :
                    $final_token = Config::get("app.english_token");
                    break;
            }
        } else {
            $final_token = $tokenInfo["token"];
        }
        $this->dbToDetail($news_id, $final_token, $type);

        $newsDetail = $this->newsModel->selectNewsDetail($news_id, $this->language);
        $newsDetail->nopic = $nopic;
        $newsDetail->font = $font;
        $newsDetail->language = $this->language;
        $newsDetail->color = Config::get("app.day_color");
        $newsDetail->background = Config::get("app.day_background");
        if ($atNight == "yes") {
            $newsDetail->color = Config::get("app.night_color");
            $newsDetail->background = Config::get("app.night_background");
        }

        if ($newsDetail->type == "article") {
            return view("product")->with("result", $newsDetail);
        } else if ($newsDetail->type == "youtube_video") {
            return view("video")->with("result", $newsDetail);
        }
    }

    function ip_address_to_number($IPaddress) {
        if (!$IPaddress) {
            return false;
        } else {
            $ips = explode('.', $IPaddress);
            return($ips[3] | $ips[2] << 8 | $ips[1] << 16 | $ips[0] << 24);
        }
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

