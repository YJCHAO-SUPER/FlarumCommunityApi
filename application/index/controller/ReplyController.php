<?php

namespace app\index\controller;

use app\index\model\Reply;
use think\Controller;
use think\Request;

class ReplyController extends Controller
{
//    根据话题id获取对应所有的回复
    public function getAllReplyByTopicId(Request $request){
        $topicId = $request->id;
        $reply = new Reply();
        $data = $reply->getReplyByTopicId($topicId);

        return $data;

    }

//    添加话题回复
    public function addTopicReply(Request $request){
        $topicId = $request->topicId;
        $replyContent = $request->replyContent;
        $replyWithId = $request->replyWithId;
        $userId = $request->jwt->id;
        $time = date('Y-m-d h:i:s');

        $reply = new Reply();
        $newReplyId = $reply->createReply($userId,$topicId,$replyContent,$time,$replyWithId);

        if($newReplyId){
            echo json_encode([
                'topicId' => $newReplyId,
                'code' => 200,
                'state' => true,
                'msg' => '回复成功'
            ]);
        }else{
            echo json_encode([
                'code' => 400,
                'state' => false,
                'msg' => '回复失败，请重新回复~'
            ]);
        }

    }

//    根据回复id获取回复内容
    public function getEditReplyById(Request $request){
        $editReplyId = $request->editReplyId;
        $reply = new Reply();
        $data = $reply->getContentById($editReplyId);
        return $data;
    }

//    编辑回复
    public function EditReply(Request $request){
        $topicId = $request->topicId;
        $replyEditContent = $request->replyEditContent;
        $replyWithId = $request->replyWithId;
        $userId = $request->jwt->id;
        $replyId = $request->replyId;
        $time = date('Y-m-d h:i:s');

        $reply = new Reply();
        $editReplyId = $reply->createEditReply($replyId,$userId,$topicId,$replyEditContent,$time,$replyWithId);

        if($editReplyId){
            echo json_encode([
                'topicId' => $editReplyId,
                'code' => 200,
                'state' => true,
                'msg' => '编辑回复成功'
            ]);
        }else{
            echo json_encode([
                'code' => 400,
                'state' => false,
                'msg' => '编辑回复失败，请重新编辑~'
            ]);
        }

    }

//   删除回复
    public function deleteReply(Request $request){
        $replyId = $request->replyId;
        $reply = new Reply();
        $reply->deleteReplyById($replyId);

        echo json_encode([
            'code' => 200,
            'state' => true,
            'msg' => '删除回复成功'
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
