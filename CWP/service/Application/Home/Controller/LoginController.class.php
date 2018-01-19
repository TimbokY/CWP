<?php
namespace Home\Controller;
use Think\Controller;
date_default_timezone_set('PRC');
header('Access-Control-Allow-Origin:*');
class LoginController extends Controller {
    public function index(){
        $this->display();
    }

    public function checklogin(){
        $username = I('post.username');
        $password = I('post.password');
        $user = M('user');
        $result = $user->where("userName='%s' AND userPwd='%s' AND userType = 1", $username, $password)->find();
        //echo $result['userid'];exit();
        //$this->assign('id',$result['userId']);
        //$this->display('User:index');
        if($result) {
            $date = date('Y-m-d H:i:s',time());
            $data['userLastLoginTime'] = $date;
            $user->where("userId={$result['userid']}")->save($data);
            $this->success('登陆成功', U('Main/index'), 1);
        }else{
            $this->error('您没有权限登录该系统');
        }
    }

    //退出系统
    public function logout()
    {
        session(null);
        $this->success('欢迎再来', U('/'), 3);
    }
}