<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Response;

//header('content-type:application/json');
class AnnounceController extends Controller {

    public function getAnnounce()
    {
        $ann = M('announce');
        $data = $ann->select();
        if ($data){
            Response::json('1001','获取公告成功',$data);
        }else{
            Response::json('-1001','获取公告失败');
        }
    }
}