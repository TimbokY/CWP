<?php
namespace Home\Controller;
use Home\Common\Response;
use Think\Controller;
header('Access-Control-Allow-Origin:*');
class HateController extends Controller {
    public function index(){
        $this->display();
    }
    public function changeHate($id)
    {
        $dynId = $_POST['dynid'];
        $isset = $_POST['ishate'];
        $date = date('Y-m-d H:i:s');
        $dynhate = M('dynhate');
        $data['userId'] = $id;
        $data['dynId'] = $dynId;
        $data['dynHateCreateDate'] = $date;

        if ($isset!=''){
            $dynhate->where("dynId = {$dynId}")->delete();
        }else{
            $dynhate->add($data);
        }
    }
}

