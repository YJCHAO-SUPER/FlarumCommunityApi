<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    //添加新用户
    public function createUser($name,$email,$password){
        $user = new User([
            'name' => $name,
            'avatar' => 'http://discuss.flarum.org.cn/assets/avatars/fwqa1topglnq0swx.jpg',
            'email' => $email,
            'password' => $password
        ]);
        $user->save();
    }

//    判断用户是否有账号
    public function contrastLogin($email){
        return User::where('email',$email)->find();
    }

//    联表 获取一个用户对应的文章
    public function getTopicByUserId(){
        return $this->hasMany('app\\index\\model\\Article','user_id','id')->with(['getCategoryByArticleId']);
    }

//    根据用户id获取用户信息
    public function getUserInfoById($userId){
        return User::with(['getTopicByUserId'])->where('id',$userId)->find();
    }

//    根据id 获取当前登录用户信息
    public function getUserPasswordInfo($userId){
        return User::where('id',$userId)->find();
    }

//    修改用户密码
    public function editPassword($userId,$newPassword){
        $user = new User;
        $user->save([
            'password' => $newPassword
        ],['id'=>$userId]);
    }

//      修改用户邮箱
    public function editEmail($userId,$newEmail){
        $user = new User;
        $user->save([
            'email' => $newEmail
        ],['id'=>$userId]);
    }

//    修改用户头像
    public function setNewAvatar($userId,$newAvatar){
        $user = new User;
        $user->save([
            'avatar' => $newAvatar
        ],['id' => $userId]);
        return $user->avatar;
    }


}
