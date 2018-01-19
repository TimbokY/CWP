<?php
namespace Home\Controller;
use Think\Controller;
date_default_timezone_set('PRC');
use Home\Common\Response;
header('Access-Control-Allow-Origin:*');
class UserController extends Controller
{
    function checkLogin(){
        $userName = $_REQUEST['userName'];
        $userPwd = $_REQUEST['userPwd'];
        $user = M('user');
        $result = $user->where("userName='%s' AND userPwd='%s'", $userName, $userPwd)->find();
        //dump($result);exit();
        //$this->assign('id',$result['userId']);
        //$this->display('User:index');
        if($result) {
            //$date = date('Y-m-d H:i:s',time());
            //$data['userLastLoginTime'] = $date;
            //$user->where("userId={$result['userid']}")->save($data);
            Response::json('1001','登录成功',$result);
        }else{
            Response::json('-1001','账号或密码错误');
        }
    }

    function checkRegister(){
        $userName = $_REQUEST['userName'];
        $userPwd = $_REQUEST['userPwd'];
        //$date = date('Y-m-d H:i:s',time());
        $user = M('user');
        $data = $user->create();

        $data['userName'] = $userName;
        $data['userPwd'] = $userPwd;
        $data['userNickName'] = $data['userName'];
        $data['userPic'] = '/pic.jpg';
        //$data['userBirth'] = $date;
        $RE = '/^(?=.*[0-9])(?=.*[a-zA-Z])(.{6,12})$/';

        $num = $user->where("username = '{$data['userName']}'")->count();
        //echo $num;exit();
        //dump(in_array('yb123456',$list));exit();
        if(preg_match($RE,$data['userName']) && preg_match($RE,$data['userPwd'])){
            if($num!=0){
                Response::json('-1001','改账号已存在');
            }else{
                $result = $user->add($data);
                if($result){
                    Response::json('1001','注册成功');
                }else{
                    Response::json('-1002','注册失败');
                }
            }
        }else{
            Response::json('-1003','账号或密码格式有误');
        }

    }

    public function doEdit(){
        $userId = $_REQUEST['userId'];
        $userNickName = $_REQUEST['userNickName'];
        $userInfo = $_REQUEST['userInfo'];
        $userSchool = $_REQUEST['userSchool'];
        $userBirth = $_REQUEST['userBirth'];
        $userSex = $_REQUEST['userSex'];
        $user = M('user');
        $user->create();
        $data['userNickName'] = $userNickName;
        $data['userInfo'] = $userInfo;
        $data['userSchool'] = $userSchool;
        $data['userBirth'] = $userBirth;
        $data['userSex'] = $userSex;
        $result = $user->where("userId={$userId}")->save($data);
        if($result){
            Response::json('1001','修改成功');
        }else{
            Response::json('-1001','修改失败');
        }
    }
    public function editHomePlace(){
        $userId = $_REQUEST['userId'];
        $userHomePlace = $_REQUEST['userHomePlace'];
        $user = M('user');
        $user->create();
        $data['userHomePlace'] = $userHomePlace;
        $result = $user->where("userId={$userId}")->save($data);
        if($result){
            Response::json('1001','修改成功');
        }else{
            Response::json('-1001','修改失败');
        }
    }
    public function editBirth(){
        $userId = $_REQUEST['userId'];
        $userBirth = $_REQUEST['userBirth'];
        $user = M('user');
        $user->create();
        $data['userBirth'] = $userBirth;
        $result = $user->where("userId={$userId}")->save($data);
        if($result){
            Response::json('1001','修改成功');
        }else{
            Response::json('-1001','修改失败');
        }
    }
    public function editPic(){
        $user = M('user');
        $data = $user->create();
        //dump($data);
        if ($_FILES['userPic']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->autoSub = false;
            $upload->rootPath = '../admin/Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['userPic']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['userPic'] = $info['savepath'] . $info['savename'];
            }
        }
        $result = $user->save($data);
        if ($result) {
            Response::json('1001', '修改成功');
        } else {
            Response::json('-1001', '修改失败');
        }
    }
    public function LoginOut(){
        $userId = $_REQUEST['userId'];
        $user = M('user');
        $user->create();
        $date = date('Y-m-d H:i:s',time());
        $data['userLastLoginTime'] = $date;
        $user->where("userId={$userId}")->save($data);
    }
    public function getUserInfo(){
        $userId = $_REQUEST['userId'];
        $user = M('user');
        $result = $user->where("userId={$userId}")->find();
        if ($result) {
            Response::json('1001', '查找成功',$result);
        } else {
            Response::json('-1001', '查找失败');
        }
    }
}