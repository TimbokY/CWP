<?php
namespace Home\Controller;

use Think\Controller;
date_default_timezone_set('PRC');
class AnnounceController extends Controller
{
    public function index()
    {
        $category = M('announce');
        $c=$category->order('annId ASC')->select();
        $this->assign("c", $c);
        $this->display();
    }
    public function add()
    {
        $this->display();
    }
    public function doadd()
    {   $anncontent=$_POST['annContent'];
        $category = M('announce');
        $data = $category->create();
        $data['annContent'] = $anncontent;
        $data['annCreateDate'] =  date('Y-m-d H:i:s',time());

        if ($_FILES['annPic']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->autoSub = false;
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['annPic']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['annPic'] = $info['savepath'] . $info['savename'];
            }
        }

        $result = $category->add($data);
        if ($result > 0) {
            $this->success('添加成功！', U('index'));
        } else {
            $this->error('添加失败！');
        }
    }
    public function edit($annid)
    {
        $category = M('announce');
        $c = $category->find($annid);
        $this->assign('c', $c);
        $this->display();
    }
    public function doedit()
    {
        $id=I('annid');
        //echo $id;exit();
        $category = M('announce');
        $data = $category->create();
        $data['annContent'] =I('anncontent');
        $data['annCreateDate'] =  date('Y-m-d H:i:s',time());
        if ($_FILES['annPic']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->autoSub = false;
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['annPic']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['annPic'] = $info['savepath'] . $info['savename'];
            }
        }
        $result = $category->where("annId={$id}")->save($data);

        if ($result > 0) {
            $this->success('修改成功！', U('index'));
        } else {
            $this->error('修改失败！');
        }
    }
    public function delete($annid)
    {
        $category = M("announce");
        $result = $category->delete($annid);

        if ($result > 0) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}