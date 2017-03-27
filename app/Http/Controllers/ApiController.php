<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LewaController;
use App\Library\Api;
use App\Model\Favour;
use App\Model\News;
use App\Model\Token;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use phpQuery;

class ApiController extends LewaController {

    private $code = 200;
    private $msg = "";
    private $favourModel;
    private $tokenModel;
    private $language;
    private $base_url;
    private $newsModel;
    private $request_get;

    public function __construct() {
        $this->favourModel = new Favour();
        $this->newsModel = new News();
        $this->tokenModel = new Token();
        $this->language = Input::get("language");
        $logPath = Config::get('app.api_log_path');
        $request = file_get_contents("php://input");

        $did = "";
        $ntype = "";

        foreach (parent::getallheaders() as $name => $value) {
            if ($name == "did") {
                $did = $value;
            }
            if ($name == "ntype") {
                $ntype = $value;
            }
            if($name == "appname"){
                $appName = $value;
            }
        }
        $this->request_get = parent::formatKey($did, $ntype, $this->language);

        @ file_put_contents($logPath . date("Y-m-d") . '.log', date("H:i:s") . $appName . $_SERVER['PHP_SELF'] . "?" . $this->request_get . " \r\n" . $request . " \r\n", FILE_APPEND);
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

    public function userRegister() {
        $ApiUrl = $this->base_url . "v1/users/?" . $this->request_get;
        $request = file_get_contents('php://input');
        $postJson = json_decode($request);
        $validData = array("source_id", "phone_type", "resolution");
        $this->checkParam($validData, $postJson);
        $postData["user_info"]["source_uid"] = $postJson->source_id;
        $postData["user_info"]["phone_type"] = $postJson->phone_type;
        $postData["user_info"]["resolution"] = $postJson->resolution;
        $postData["user_info"]["source"] = "android:lewa";
        $postData["user_info"]["avatar"] = "";
        $postData["user_info"]["name"] = "";
        $postData["user_info"]["oauth_token"] = "";
        $postData["user_info"]["gender"] = "";
        $postData["user_info"]["age"] = "";
        $post = json_encode($postData);
        $header = array('Content-Type: application/json', 'Content-Length: ' . strlen($post));
        $result = parent::curl_get($ApiUrl, $header, "POST", $post);
        parent::set_err_return($result);
        if (count($result) == 0) {
            $result = parent::curl_get($ApiUrl, $header, "POST", $post);
        }
        /*if (empty($postJson->source_id)) {
            $post = json_encode($postData);
            $header = array('Content-Type: application/json', 'Content-Length: ' . strlen($post));
            $result = parent::curl_get($ApiUrl, $header, "POST", $post);
            parent::set_err_return($result);
            if (count($result) == 0) {
                $result = parent::curl_get($ApiUrl, $header, "POST", $post);
            }
        } else {
            $token_cache = $this->tokenModel->SelectToken(time(), $postJson->source_id);
            if (is_null($token_cache)) {
                $post = json_encode($postData);
                $header = array('Content-Type: application/json', 'Content-Length: ' . strlen($post));
                $result = parent::curl_get($ApiUrl, $header, "POST", $post);
                parent::set_err_return($result);
                if (count($result) == 0) {
                    $result = parent::curl_get($ApiUrl, $header, "POST", $post);
                }
                $sql["did"] = $postJson->source_id;
                $sql["token"] = $result["token"];
                $sql["createtime"] = strtotime("+60 day");
                $this->tokenModel->insertToken($sql);
            } else {
                $result["status"] = 0;
                $result["name"] = null;
                $result["gender"] = null;
                $result["registered"] = 0;
                $result["atype"] = 2;
                $result["source"] = "android:lewa";
                $result["token"] = $token_cache->token;
                $result["avater"] = array();
                $result["id"] = $postJson->source_id;
            }
        }*/
        Api::set_key("result_object");
        Api::response($result);
    }

    //获取新闻list
    public function sendnews() {
        //获取contentbody的值
        $postData = file_get_contents('php://input');
        $postJson = json_decode($postData);
        $validData = array("categories", "action", "token", "read_tag");
        $this->checkParam($validData, $postJson);
        $categories = $postJson->categories;
        $action = $postJson->action;
        $token = $postJson->token;
        $read_tag = $postJson->read_tag;
        $ApiUrl = $this->base_url . "v4/categories/{$categories}/articles/{$action}/?" . $this->request_get;
        if (!empty($read_tag) && $action == "prev") {
            $ApiUrl.="&read_tag={$read_tag}";
        }
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        if ($categories == "subscribed") {
            $result = $this->getMedia($token, $header);
            Api::response($result);
        } else {
            $result = parent::curl_get($ApiUrl, $header);
            if (count($result) == 0) {
                $result = parent::curl_get($ApiUrl, $header);
                if (count($result) == 0) {
                    Api::response(array());
                }
            }
            $logPath = Config::get('app.api_log_path');
            @ file_put_contents($logPath . date("Y-m-d") . '.log', date("H:i:s") . $_SERVER['PHP_SELF'] . " \r\n" . json_encode($result) . " \r\n", FILE_APPEND);
            parent::set_err_return($result);
            if (array_key_exists("galary", $result)) {
                $arr = $result["galary"];
                $loc = $result["galary"]["loc"];
                $arr = parent::array_remove($arr, "loc");
                array_splice($result["articles"], $loc, 0, $arr);
            }
            if (array_key_exists("youtube_video", $result)) {
                $arr = $result["youtube_video"];
                $loc = $result["youtube_video"]["loc"];
                $arr = parent::array_remove($arr, "loc");
                array_splice($result["articles"], $loc, 0, $arr);
            }
            $blackList = Config::get("app.black_source");
            for ($i = 0; $i < count($result["articles"]); $i++) {
                if ($result["articles"][$i]["type"] == "article") {
                    if (in_array($result["articles"][$i]["site_url"], $blackList)) {
                        unset($result["articles"][$i]);
                        continue;
                    }
                }
                $result["articles"][$i]["detail_url"] = Config::get('app.news_detail_url') . "?id=" . $result["articles"][$i]["id"] . "&language=" . $this->language . "&type=" . $result["articles"][$i]["type"];
                $result["articles"][$i] = parent::array_remove($result["articles"][$i], "bigger");
            }
            $arr = array_values($result["articles"]);
            Api::response($arr);
        }
    }

    //新闻搜索接口
    public function search() {

        $postData = file_get_contents('php://input');
        $postJson = json_decode($postData);
        $validData = array("keyword", "token");
        $this->checkParam($validData, $postJson);
        $keyword = urlencode($postJson->keyword);
        $token = $postJson->token;
        $from = empty($postJson->from) ? 0 : $postJson->from;
        $size = empty($postJson->size) ? 10 : $postJson->size;
        $ApiUrl = $this->base_url . "v1/thesaurus/words/?words={$keyword}&from={$from}&size={$size}&" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $result = parent::curl_get($ApiUrl, $header);
        if (count($result) == 0) {
            $result = parent::curl_get($ApiUrl, $header);
            if (count($result) == 0) {
                Api::response(array());
            }
        }
        parent::set_err_return($result);
        $blackList = Config::get("app.black_source");
        foreach ($result["articles"] as $key => $r) {

            if ($result["articles"][$key]["type"] == "article") {
                if (in_array($result["articles"][$key]["site_url"], $blackList)) {
                    unset($result["articles"][$key]);
                    continue;
                }
            }

            $title = $r["title"][0];
            $title = str_replace('<em>', '<font color="red">', $title);
            $title = str_replace('</em>', '</font>', $title);
            $result["articles"][$key]["title"] = $title;
            $result["articles"][$key]["detail_url"] = Config::get('app.news_detail_url') . "?id=" . $result["articles"][$key]["id"] . "&language=" . $this->language . "&type=" . $result["articles"][$key]["type"];
        }
        $arr = array_values($result["articles"]);
        Api::response($arr);
    }

//获取分类
    public function getCatagoryInfo() {

        $ApiUrl = $this->base_url . "v4/categories/sorted/?" . $this->request_get;
        $header = array('Content-Type: application/json');
        $request = parent::curl_get($ApiUrl, $header);
        $data = array();
        foreach ($request as $key => $value) {
            $result["id"] = $key;
            $result["catagory"] = $value["name"];
            $result["title"] = ucfirst($value["title"]);
            array_push($data, $result);
        }
        if (count($data) == count($data, 1)) {
            Api::set_key("result_object");
        }
        Api::response($data);
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
            $result["source_url"] = "";
        }


        Api::set_key("result_object");
        Api::response($result);
    }

//获取媒体列表
    public function getMedias() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("token", "read_tag");
        $this->checkParam($validData, $postData);
        $token = $postData->token;
        $read_tag = $postData->read_tag;
        $ApiUrl = $this->base_url . "v1/medias/?" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        if (!empty($read_tag)) {
            $ApiUrl .= "&read_tag={$read_tag}";
        }
        $result = parent::curl_get($ApiUrl, $header);
        if (count($result) == 0) {
            $result = parent::curl_get($ApiUrl, $header);
            if (count($result) == 0) {
                Api::response(array());
            }
        }
        parent::set_err_return($result);
        $blackList = Config::get("app.black_source");
        foreach ($result as $key => $r) {
            if (in_array($r["site_url"], $blackList)) {
                unset($result[$key]);
            }

            if (!is_array($r["avatar"]) || $r["avatar"] == "") {
                $result[$key]["avatar"]["origin"] = Config::get("app.url") . 'img/item_image_default.png';
                $result[$key]["avatar"]["width"] = 140;
                $result[$key]["avatar"]["height"] = 140;
            }
        }
        $result = array_values($result);
        if (count($result) == count($result, 1)) {
            Api::set_key("result_object");
        }
        Api::response($result);
    }

    //获取订阅列表
    public function getSubList() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("token");
        $this->checkParam($validData, $postData);
        $token = $postData->token;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $result = $this->getMedia($token, $header);
        $blackList = Config::get("app.black_source");
        foreach ($result as $key => $r) {
            if (in_array($r["site_url"], $blackList)) {
                unset($result[$key]);
            }
            if (!is_array($r["avatar"]) || $r["avatar"] == "") {
                $result[$key]["avatar"]["origin"] = Config::get("app.url") . 'img/item_image_default.png';
                $result[$key]["avatar"]["width"] = 140;
                $result[$key]["avatar"]["height"] = 140;
            }
        }
        $result = array_values($result);
        if (count($result) > 0) {
            if (count($result) == count($result, 1)) {
                Api::set_key("result_object");
            }
            Api::response($result);
        } else {
            Api::response();
        }
    }

//订阅媒体
    public function editSub() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("token", "site_url");
        $this->checkParam($validData, $postData);
        $token = $postData->token;
        $data['site_url'] = $postData->site_url;
        $data = json_encode($data);
        $ApiUrl = $this->base_url . "v1/medias/subscribing/?" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}",
            'Content-Length: ' . strlen($data));
        $result = parent::curl_get($ApiUrl, $header, "POST", $data);
        parent::set_err_return($result);
        if (count($result) == count($result, 1)) {
            Api::set_key("result_object");
        }
        Api::response($result);
    }

//删除媒体
    public function delSub() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("token", "site_url");
        $this->checkParam($validData, $postData);
        $token = $postData->token;
        $ApiUrl = $this->base_url . "v1/medias/subscribing/?site_url={$postData->site_url}&" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $result = parent::curl_get($ApiUrl, $header, "DELETE");
        @ file_put_contents($logPath . date("Y-m-d") . '.log', date("H:i:s") . $_SERVER['PHP_SELF'] . " \r\n" . json_encode($result) . " \r\n", FILE_APPEND);
        parent::set_err_return($result);
        if (count($result) == count($result, 1)) {
            Api::set_key("result_object");
        }
        Api::response($result);
    }

    public function likeNews() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("token", "id");
        $this->checkParam($validData, $postData);
        $token = $postData->token;
        $news_id = $postData->id;
        $ApiUrl = $this->base_url . "v1/articles/{$news_id}/likes/?" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $result = parent::curl_get($ApiUrl, $header, "POST");
        $this->favourModel->recordUserFavour($news_id, "like", $token);
        $this->favourModel->recordUserLike($news_id, $token, "true", "false");
        if (array_key_exists("status", $result)) {
            Api::set_message($result["status"]);
        } else {
            Api::set_code($result["err_code"]);
            Api::set_message($result["err_msg"]);
        }
        Api::set_key("result_object");
        Api::response($result);
    }

    public function unlikeNews() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("token", "id");
        $this->checkParam($validData, $postData);
        $token = $postData->token;
        $news_id = $postData->id;
        $ApiUrl = $this->base_url . "v1/articles/{$news_id}/likes/?" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $result = parent::curl_get($ApiUrl, $header, "DELETE");
        $this->favourModel->recordUserFavour($news_id, "unlike", $token);
        $this->favourModel->recordUserLike($news_id, $token, "false", "true");
        if (array_key_exists("status", $result)) {
            Api::set_message($result["status"]);
        } else {
            Api::set_code($result["err_code"]);
            Api::set_message($result["err_msg"]);
        }
        Api::set_key("result_object");
        Api::response($result);
    }

    public function noload() {

        return view("error")->with("language", $this->language);
    }

//获取城市列表
    public function getCity() {
        $ApiUrl = $this->base_url . "v1/categories/cities/?" . $this->request_get;
        $header = array('Content-Type: application/json');
        $result = parent::curl_get($ApiUrl, $header);
        Api::response($result);
    }

//提交新闻反馈
    public function SubFeed() {
        $postData = json_decode(file_get_contents('php://input'));

        $validData = array("token", "id");
        $this->checkParam($validData, $postData);

        $token = $postData->token;
        $news_id = $postData->id;
        $reason = $postData->reason;
        $data['reason'] = $reason;
        $data = json_encode($data);
        $ApiUrl = $this->base_url . "v1/articles/{$news_id}/unlike/?" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}",
            'Content-Length: ' . strlen($data));
        $result = parent::curl_get($ApiUrl, $header, "POST", $data);
        parent::set_err_return($result);
        if (count($result) == count($result, 1)) {
            Api::set_key("result_object");
        }
        Api::response($result);
    }

    //获取媒体下的新闻列表
    public function getMediasList() {
        $postData = json_decode(file_get_contents('php://input'));

        $validData = array("token", "id");
        $this->checkParam($validData, $postData);

        $mediaId = $postData->id;
        $token = $postData->token;
        $ApiUrl = $this->base_url . "v1/medias/{$mediaId}/articles/?" . $this->request_get;
        $header = array('Content-Type: application/json',
            "Authorization: HIN {$token}");
        $result = parent::curl_get($ApiUrl, $header);
        if (count($result) == 0) {
            $result = parent::curl_get($ApiUrl, $header);
            if (count($result) == 0) {
                Api::response(array());
            }
        }
        foreach ($result["articles"] as $key => $r) {
            $result["articles"][$key]["detail_url"] = Config::get('app.news_detail_url') . "?id=" . $result["articles"][$key]["id"] . "&language=" . $this->language . "&type=" . $result["articles"][$key]["type"];
        }
        Api::response($result["articles"]);
    }

    //提交Log至newsdog
    public function postLog() {
        $postJson = file_get_contents('php://input');
        $postJsonArr = json_decode($postJson);
        $header = parent::getallheaders();
        foreach ($postJsonArr->mAllDataBean as $postData) {
            $data["ip"] = $postData->ip;
            $data["size"] = $postData->size;
            $data["resolution"] = $postData->resolution;
            $data["model"] = $postData->model;
            $data["lang"] = $this->language == "india" ? "hi" : "en";
            $data["os"] = $postData->os;
            $data["os_v"] = $postData->os_v;
            $data["app_v"] = $postData->app_v;
            $data["channel"] = "lewa";
            $data["net"] = $postData->net;
            $data["u_type"] = "lewa";
            $data["did"] = $header["did"];
            $data["imei"] = $postData->imei;
            $data["mac"] = $postData->mac;
            $data["android_id"] = $postData->android_id;
            $data["ts"] = time();
            $data["lv"] = 1;
            $click = $postData->detailUtils;
            $duration = $postData->appUtil;
            $postBody["data"] = $click;
            $postBody2["data"] = $duration;
            $ContentBody = json_encode($postBody);
            $ContentBody2 = json_encode($postBody2);
            $requestParam = http_build_query($data);
            $logUrl = "http://log.newsdog.today/v1/lewa/logs/?" . $requestParam;
            $requestHeader = array('Content-Type: application/json');
            $result = parent::curl_get($logUrl, $requestHeader, "POST", $ContentBody);
            $result2 = parent::curl_get($logUrl, $requestHeader, "POST", $ContentBody2);
        }
        Api::set_key("result_object");
        Api::response($result);
    }

    public function getCollection() {
        $postData = json_decode(file_get_contents('php://input'));
        $validData = array("type", "id");
        $this->checkParam($validData, $postData);
        $type = $postData->type;
        $news_id = $postData->id;
        $result = $this->newsModel->selectNews($news_id, $type);

        $responseArr = array();
        $responseArr["top_images"] = array();
        if (!empty($result->top_image)) {
            $toparr = explode(",", $result->top_image);
            if (count($toparr) > 0) {
                for ($i = 0; $i < count($toparr); $i++) {
                    $responseArr["top_images"][$i]["origin"] = $toparr[$i];
                    $responseArr["top_images"][$i]["source"] = $toparr[$i];
                    $responseArr["top_images"][$i]["thumb"] = $toparr[$i];
                    $responseArr["top_images"][$i]["thumb_height"] = $result->top_image_height;
                    $responseArr["top_images"][$i]["thumb_width"] = $result->top_image_width;
                    $responseArr["top_images"][$i]["width"] = $result->top_image_width;
                    $responseArr["top_images"][$i]["height"] = $result->top_image_height;
                }
            }
        }

        if ($type == "youtube_video") {
            $responseArr["category"] = null;
            $responseArr["seq_id"] = 0;
            $responseArr["liked"] = false;
            $responseArr["favoured"] = false;
            $responseArr["share_url"] = Config::get('app.news_detail_url') . "?id=" . $news_id . "&language=" . $this->language . "&type=youtube_video";
            $responseArr["shared_count"] = 0;
            $responseArr["content"] = $result->content;
            $responseArr["source"] = "test";
            $responseArr["type"] = "youtube_video";
            $responseArr["id"] = $news_id;
            $responseArr["detail_url"] = Config::get('app.news_detail_url') . "?id=" . $news_id . "&language=" . $this->language . "&type=youtube_video";
            $responseArr['like_count'] = 0;
            $responseArr['comments_count'] = 0;
            $responseArr["youtube"][0] = $result->source;
        } else {
            $responseArr["related_images"] = array();
            if (!empty($result->related_images)) {
                $relarr = explode(",", $result->related_images);
                if (count($relarr) > 0) {
                    for ($i = 0; $i < count($relarr); $i++) {
                        $responseArr["related_images"][$i]["origin"] = $relarr[$i];
                        $responseArr["related_images"][$i]["source"] = $relarr[$i];
                        $responseArr["related_images"][$i]["thumb"] = $relarr[$i];
                        $responseArr["related_images"][$i]["thumb_height"] = $result->top_image_height;
                        $responseArr["related_images"][$i]["thumb_width"] = $result->top_image_width;
                        $responseArr["related_images"][$i]["width"] = $result->top_image_width;
                        $responseArr["related_images"][$i]["height"] = $result->top_image_height;
                    }
                }
            }
            $responseArr["title"] = $result->title;
            $responseArr["seq_id"] = 0;
            $responseArr["is_hot"] = 0;
            $responseArr["source"] = $result->source;
            $responseArr["published_at"] = $result->published_at;
            $responseArr["source_url"] = $result->source_url;
            $site_url = str_replace("http://", "", $result->source_url);
            $site_url = explode("/", $site_url);
            $responseArr["site_url"] = $site_url[0];
            $responseArr["type"] = "article";
            $responseArr["id"] = $news_id;
            $responseArr["detail_url"] = Config::get('app.news_detail_url') . "?id=" . $news_id . "&language=" . $this->language . "&type=article";
            $responseArr['op_recommend'] = false;
            $responseArr['comments_count'] = 0;
        }

        Api::set_key("result_object");
        Api::response($responseArr);
    }

    public function getMedia($token, $header) {
        $ApiUrl = $this->base_url . "v1/medias/subscribed/?" . $this->request_get;
        $result = parent::curl_get($ApiUrl, $header);
        return $result;
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
                    $related_image.=$r["origin"] . ",";
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

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

