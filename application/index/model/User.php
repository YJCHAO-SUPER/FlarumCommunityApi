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
}
