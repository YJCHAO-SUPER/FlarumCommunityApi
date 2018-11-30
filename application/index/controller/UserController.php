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
            $now = time();
//            return $now;
            $expire = $now + 7*24*60*60;
            $data = [
              'iat' => $now,
              'exp' => $expire,
              'id' => $userInfo['id'],
              'name' => $userInfo['name'],
              'avatar' => $userInfo['avatar'],
              'email' => $userInfo['email'],
            ];
//            生成令牌
            $jwt = JWT::encode($data,$key);
//            返回json数据
            echo json_encode([
                'code'=>'200',
                'ACCESS_TOKEN'=>$jwt,
                'id'=>$userInfo['id'],
                'name' => $userInfo['name'],
                'avatar' => $userInfo['avatar'],
            ]);
        }else{
            echo json_encode([
                'code'=>'403',
                'error'=>'邮箱或者密码错误！',
            ]);
        }
    }

//    根据用户id获取用户信息
    public function getUserById(Request $request){
        $userId = $request->userId;
        $user = new User();
        $data = $user->getUserInfoById($userId);
        return $data;
    }

//    更新用户密码
    public function updatePassword(Request $request){

        $userId = $request->jwt->id;

        $user = new User();
        $data = $user->getUserPasswordInfo($userId);

        $oldPassword = $request->oldPassword;
        $password = password_verify($oldPassword,$data->password);
//        return $password?"1":"0";
        $newPassword = password_hash($request->newPassword,1);
        if($password){
            $user->editPassword($userId,$newPassword);
            echo json_encode([
                'code'=>'200',
                'msg'=>'密码修改成功！',
            ]);
        }else{
            echo json_encode([
                'code'=>'403',
                'msg'=>'原密码错误！',
            ]);
        }

    }

//    更新用户邮箱
    public function updateEmail(Request $request){

        $userId = $request->jwt->id;

        $user = new User();
        $data = $user->getUserPasswordInfo($userId);

        $oldEmail = $request->oldEmail;
        $email = $data->email;
        $newEmail = $request->newEmail;
        if($oldEmail == $email){
            $user->editEmail($userId,$newEmail);
            echo json_encode([
                'code'=>'200',
                'msg'=>'邮箱修改成功！',
            ]);
        }else{
            echo json_encode([
                'code'=>'403',
                'msg'=>'原邮箱错误！',
            ]);
        }

    }

//    更新用户头像
    public function updateAvatar(Request $request){

        $userId = $request->jwt->id;

        $user = new User();
        $userInfo = $user->getUserPasswordInfo($userId);

        unlink(ROOT_PATH."/public/".$userInfo->avatar);

        $avatar = $request->file('avatar');
        $info = $avatar->move(ROOT_PATH."/public/uploads/");
        $newAvatar = '/uploads/'.$info->getSaveName();

        $data = $user->setNewAvatar($userId,$newAvatar);

        return $data;

    }

//    检查用户信息
    public function checkUserLogin(Request $request){
        $jwtToken = $request->jwtToken;
        $key = 'abcd1234';
        $jwt = JWT::decode($jwtToken, $key,array('HS256'));

        return json_encode([
            'avatar' => $jwt->avatar,
            'id' => $jwt->id,
            'name' => $jwt->name
        ]);
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
