<?php

namespace app\index\controller;

//require('../../../vendor/autoload.php');

use Firebase\JWT\JWT;
use app\index\model\User;
use think\Controller;
use think\Request;

class UserController extends Controller
{
//    接收前端传来的注册数据
    public function addUser(Request $request)
    {
        $user = new User();
        $name = $request->name;
        $email = $request->email;
        $password = password_hash($request->password,1);
        $user->createUser($name,$email,$password);
        return "OK";
    }

//    处理前端传来的登录数据
    public function doLogin(Request $request){
        $email = $request->Lemail;
        $password = $request->Lpassword;
        $user = new User();
        $userInfo = $user->contrastLogin($email);
//        return $userInfo;
        if(password_verify($password,$userInfo['password'])){
            $key = 'abcd1234';
            $data = [
              'id' => $userInfo['id'],
              'name' => $userInfo['name'],
              'avatar' => $userInfo['avatar'],
              'email' => $userInfo['email'],
              'password' => $userInfo['password'],
            ];
//            生成令牌
            $jwt = JWT::encode($data,$key);
//            返回json数据
            echo json_encode([
                'code'=>'200',
                'jwt'=>$jwt,
            ]);
        }else{
            echo json_encode([
                'code'=>'403',
                'error'=>'邮箱或者密码错误！',
            ]);
        }
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
