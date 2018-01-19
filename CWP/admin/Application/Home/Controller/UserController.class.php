<?php
namespace Home\Controller;
use Think\Controller;
date_default_timezone_set('PRC');
class UserController extends Controller
{
    public function index()
    {
        $user = M('user');
        $where = 1;
        if ($kw = I('kw')) {
            $where .= ' AND userName LIKE "%' . $kw . '%"';
        }
        $count = $user->count();
        $Page = new \Think\Page($count, 7);
        $show = $Page->show();
        $list = $user->where($where)->order('userid ASC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }
    //注册用户
    public function doadd(){
        $user = M('user');
        $date = date('Y-m-d H:i:s',time());
        $data = $user->create();
        $data['userPic'] = '/pic.jpg';
        $data['userBirth'] = $date;
        $data['userNickName'] = $data['userName'];
        $RE = '/^(?=.*[0-9])(?=.*[a-zA-Z])(.{6,12})$/';

        $num = $user->where("username = '{$data['userName']}'")->count();
        //echo $num;exit();
        //dump(in_array('yb123456',$list));exit();
        if(preg_match($RE,$data['userName']) && preg_match($RE,$data['userPwd'])){
            if($num!=0){
                $this->error('改账号已存在！');
            }else{
                $result = $user->add($data);
                if($result){
                    $this->success('添加成功！', U('index'));
                }else{
                    $this->error('添加失败！');
                }
            }
        }else{
            $this->error('账号或密码格式有误！');
        }
/*        if($result){
            $this->success('添加成功！', U('index'));
        }else{
            $this->error('添加失败！');
        }*/
    }

    public function edit($id){
        $user = M('user');
        $list = $user->where("userid = {$id}")->find();
        //dump($list);exit();
        $this->assign('list', $list);
        $this->display();

    }

    public function doEdit(){
        $user = M('user');
        $data = $user->create();
        //dump($data);
        if ($_FILES['userPic']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->autoSub = false;
            $upload->rootPath = './Uploads/';
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
            $this->success('修改成功！');
        } else {
            $this->error('修改失败！');
        }
    }

    public function delete($id)
    {
        $user = M('user');
        if ($user->delete($id)) {
            $this->success('删除成功！', U('index'));
        } else {
            $this->error('删除失败！');
        }
    }
    public function deletes(){
        $user=M('user');
        $deletes=I('deletes');
        $deletes=implode(',',$deletes);
        if($user->delete($deletes)){
            $this->success('批量删除成功！',U('index'));
        }else{
            $this->error('批量删除失败！');
        }

    }
}