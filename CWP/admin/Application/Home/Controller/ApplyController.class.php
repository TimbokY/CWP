<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/5
 * Time: 11:00
 */

namespace Home\Controller;

use Think\Controller;
date_default_timezone_set('PRC');
class ApplyController extends Controller{
    public function index()
    {
        $category = M('apply');
        $c=$category->order('appid ASC')->select();
        $this->assign("c", $c);
        $this->display();
    }
    public function chaxun(){
        $keyword=$_GET['keyword'];
        $apply = M('apply');
        $c=$apply->where("applytype like '%{$keyword}%'")->select();
        $this->assign("c", $c);
        $this->display(Apply_index);
    }
    public function applydelete($appid){
            $comment = D('apply');
            if ($comment->delete($appid)) {
                $this->success('删除成功！', U('index'));
            } else {
                $this->error('删除失败！');
            }
        }
}