<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Response;
header('Access-Control-Allow-Origin:*');
class SkinController extends Controller{
    public function changeSkin(){
        $skinId = $_REQUEST['skinId'];
        $skin = M('skin');
        $result = $skin->where("skinId={$skinId}")->find();
        if($result){
            Response::json('1001','切换皮肤成功',$result);
        }else{
            Response::json('-1001','切换皮肤失败');
        }
    }
    public function userSkin(){
        $skinId = $_REQUEST['skinId'];
        $userId = $_REQUEST['userId'];
        $user = M('user');
        //$result = $user->where("skinId={$skinId}")->find();
        $data['userId'] =$userId;
        $data['skinId'] = $skinId;
        $result = $user->save($data);
        if($result){
            Response::json('1001','保存成功',$result);
        }else{
            Response::json('-1001','保存失败');
        }
    }
    public function getSkin(){
        $userId = $_REQUEST['userId'];
        $user = M('user');
        $data = $user->query("select skin from cwp_user,cwp_skin where cwp_user.skinId = cwp_skin.skinId AND userId={$userId}");
        if($data){
            Response::json('1001','获取皮肤成功',$data);
        }else{
            Response::json('-1001','获取皮肤失败');
        }
    }
}