<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
Route::group(['prefix' => 'v2'],function() {
    //获取文章推荐
    Route::post('api/articles', 'v2\ApiController@getFavour');
    //反馈
    Route::post('api/feedback', 'v2\ApiController@feedback');
    //获取城市
    Route::get('api/city', 'v2\ApiController@getCity');
     //新闻详情webview
    Route::get('articles', 'v2\ApiController@getWebView');
});

Route::group(['prefix' => 'v1'],function() {
    //传递客户端新闻api方法
    Route::post('api/102', 'v1\ApiController@sendnews');
    //传递客户端频道api方法
    Route::get('api/catagory', 'v1\ApiController@getCatagoryInfo');
    //传递新闻详情
    Route::post('api/detail', 'v1\ApiController@getNewsDetail');
    //新闻详情webview
    Route::get('articles', 'v1\ApiController@getWebView');
    //用户注册方法
    Route::post('api/register', 'v1\ApiController@userRegister');
    //获取文章推荐
    Route::post('api/articles', 'v1\ApiController@getFavour');
    //获取媒体列表
    Route::post('api/medias', 'v1\ApiController@getMedias');
    //newsdog 搜索接口
    Route::post('api/search', 'v1\ApiController@search');
    //获取订阅列表
    Route::post('api/subscribe', 'v1\ApiController@getSubList');
    //获取订阅列表
    Route::post('api/medialist', 'v1\ApiController@getMediasList');
    //订阅媒体
    Route::post('api/putsubscribe', 'v1\ApiController@editSub');
    //删除媒体
    Route::post('api/delsubscribe', 'v1\ApiController@delSub');
    //like新闻
    Route::post('api/like', 'v1\ApiController@likeNews');
    //unlike新闻
    Route::post('api/unlike', 'v1\ApiController@unlikeNews');
    //获取城市
    Route::get('api/city', 'v1\ApiController@getCity');
    //反馈新闻
    Route::post('api/feedback', 'v1\ApiController@SubFeed');
    //log
    Route::post('api/log', 'v1\ApiController@PostLog');
    //error
    Route::get('api/error', 'v1\ApiController@noload');
     //收藏
    Route::post('api/collection', 'v1\ApiController@getCollection');
});


Route::group(['prefix' => ''],function() {
    //传递客户端新闻api方法
    Route::post('api/102', 'v1\ApiController@sendnews');
    //传递客户端频道api方法
    Route::get('api/catagory', 'v1\ApiController@getCatagoryInfo');
    //传递新闻详情
    Route::post('api/detail', 'v1\ApiController@getNewsDetail');
    //新闻详情webview
    Route::get('articles', 'v1\ApiController@getWebView');
    //用户注册方法
    Route::post('api/register', 'v1\ApiController@userRegister');
    //获取文章推荐
    Route::post('api/articles', 'v1\ApiController@getFavour');
    //获取媒体列表
    Route::post('api/medias', 'v1\ApiController@getMedias');
    //newsdog 搜索接口
    Route::post('api/search', 'v1\ApiController@search');
    //获取订阅列表
    Route::post('api/subscribe', 'v1\ApiController@getSubList');
    //获取订阅列表
    Route::post('api/medialist', 'v1\ApiController@getMediasList');
    //订阅媒体
    Route::post('api/putsubscribe', 'v1\ApiController@editSub');
    //删除媒体
    Route::post('api/delsubscribe', 'v1\ApiController@delSub');
    //like新闻
    Route::post('api/like', 'v1\ApiController@likeNews');
    //unlike新闻
    Route::post('api/unlike', 'v1\ApiController@unlikeNews');
    //获取城市
    Route::get('api/city', 'v1\ApiController@getCity');
    //反馈新闻
    Route::post('api/feedback', 'v1\ApiController@SubFeed');
    //log
    Route::post('api/log', 'v1\ApiController@PostLog');
    //error
    Route::get('api/error', 'v1\ApiController@noload');
     //收藏
    Route::post('api/collection', 'v1\ApiController@getCollection');
});

Route::any('admin', 'Admin\IndexController@index');
Route::any('admin/channel', 'Admin\ChannelController@getAdmChannel');
Route::any('admin/login', function() {
    return view("admin/login");
});
