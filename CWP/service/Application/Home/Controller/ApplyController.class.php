<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/5
 * Time: 17:02
 */

namespace Home\Controller;
header('content-type:application/json');
header('Access-Control-Allow-Origin:*');

use Think\Controller;
use Home\Common\Response;


class ApplyController extends Controller
{
    public function index()
    {


        $arr = $_REQUEST;
        $appcontent = $arr['applycontent'];
        $keyword = $arr['keyword'];
        $number = $arr['number'];

        $category = M('apply');
        $data = $category->create();
        $data['applycontent'] = $appcontent;
        $data['applytype']=$keyword;
        $data['applynumber']=$number;
        $data['applytime'] =  date('Y-m-d H:i:s',time());
        $result = $category->add($data);
        if ($result) {
            Response::json('10001', '获取成功',$result);
        } else {
            Response::json('-10001', '获取失败');
        }
    }
}