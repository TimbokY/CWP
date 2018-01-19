<?php
namespace Home\Controller;
use Think\Controller;
header('Access-Control-Allow-Origin:*');
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
}