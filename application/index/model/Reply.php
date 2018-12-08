<?php

namespace app\index\model;

use think\Model;

class Reply extends Model
{
    //联表获取用户信息
    public function getUserByReplyUserId(){
        return $this->belongsTo('app\\index\\model\\User','user_id','id');
    }

    //根据话题id获取对应的回复
    public function getReplyByTopicId($topicId){
        return Reply::with('getUserByReplyUserId')->where('topic_id',$topicId)->all();
    }
}
