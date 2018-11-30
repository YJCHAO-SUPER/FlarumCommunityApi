<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2018/11/19
 * Time: 17:54
 */

//获取分类
Route::get('api/category', 'CategoryController/getAllCategory')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//获取文章信息
Route::get('api/article','ArticleController/getAllArticle')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//接收注册信息
Route::post('/sendRegisterInfo','UserController/addUser')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//接收登录信息
Route::post('/sendLoginInfo','UserController/doLogin')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//接收添加话题信息
Route::post('/sendTopicInfo','ArticleController/addTopic')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true)
    ->middleware('\app\http\middleware\JwtMiddleware');

//接收某篇话题的id 获取这篇话题的内容
Route::get('/getTopicByIdInfo','ArticleController/getTopicById')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//用户id获取用户信息
Route::get('/getUserInfoById','UserController/getUserById')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//获取用户修改密码的信息
Route::post('/sendChangePassword','UserController/updatePassword')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true)
    ->middleware('\app\http\middleware\JwtMiddleware');

//获取用户修改密码的信息
Route::post('/sendChangeEmail','UserController/updateEmail')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true)
    ->middleware('\app\http\middleware\JwtMiddleware');

//修改用户头像
Route::post('/uploadAvatar','UserController/updateAvatar')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true)
    ->middleware('\app\http\middleware\JwtMiddleware');

//检查用户信息
Route::post('/doCheckLogin','UserController/checkUserLogin')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true)
    ->middleware('\app\http\middleware\JwtMiddleware');


