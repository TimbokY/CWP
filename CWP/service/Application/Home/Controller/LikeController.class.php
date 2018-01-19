<?php
namespace Home\Controller;
use Think\Controller;
header('Access-Control-Allow-Origin:*');
class LikeController extends Controller {
    public function index(){
        $this->display();
    }
    public function changeLike($id)
    {
        $dynId = $_POST['dynid'];
        $isset = $_POST['islike'];
        $date = date('Y-m-d H:i:s');
        $dynlike = M('dynlike');
        $data['userId'] = $id;
        $data['dynId'] = $dynId;
        $data['dynLikeCreateDate'] = $date;

        if ($isset!=''){
            $dynlike->where("dynId = {$dynId}")->delete();
        }else{
            $dynlike->add($data);
        }
    }
}