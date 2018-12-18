<?php

namespace app\index\model;

use think\Model;
use think\Request;

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

    //添加话题回复
    public function createReply($userId,$topicId,$replyContent,$time,$replyWithId){
        $newReply = new Reply;
        $newReply->user_id = $userId;
        $newReply->topic_id = $topicId;
        $newReply->reply_content = $replyContent;
        $newReply->created_at = $time;
        $newReply->reply_with = $replyWithId;
        $newReply->save();
        return $newReply->id;
    }

    //根据回复id获取回复内容
    public function getContentById($editReplyId){
        return Reply::where('id',$editReplyId)->find();
    }

    //编辑回复
    public function createEditReply($replyId,$userId,$topicId,$replyEditContent,$time,$replyWithId){
        $editReply = Reply::where('id', $replyId)->find();
        $editReply->user_id = $userId;
        $editReply->topic_id = $topicId;
        $editReply->reply_content = $replyEditContent;
        $editReply->created_at = $time;
        $editReply->reply_with = $replyWithId;
        $editReply->save();
        return $editReply->id;
    }

    //删除回复
    public function deleteReplyById($replyId){
        return Reply::where('id',$replyId)->delete();
    }


}
