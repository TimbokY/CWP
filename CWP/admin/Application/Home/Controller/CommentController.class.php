<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller {
    public function index()
    {
        $dyncomment = D('dyncomment');
        $where = 1;
        if ($kw = I('kw')) {
            $where .= ' AND dynComContent LIKE "%' . $kw . '%"';
        }
        $count = $dyncomment->count();
        $Page = new \Think\Page($count, 15);
        $show = $Page->show();
        $list = $dyncomment->where($where)->order('dynComCreateDate DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        var_dump($list)."<br>";
//        var_dump($show);exit();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }

//    public function add()
//    {
//
//        $this->display();
//    }
//    public function doadd()
//    {
//        $article = D('article');
//        $data = $article->create();
//        $data['time'] = time();
//        if ($_FILES['pic']['tmp_name'] != '') {
//            $upload = new \Think\Upload();
//            $upload->maxSize = 3145728;
//            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
//            $upload->rootPath = './Uploads/';
//            $upload->savePath = '/';
//            $info = $upload->uploadOne($_FILES['pic']);
//            if (!$info) {
//                $this->error($upload->getError());
//            } else {
//                $data['pic'] = $info['savepath'] . $info['savename'];
//            }
//        }
//        $result = $article->add($data);
//        if ($result > 0) {
//            $this->success('添加成功！', U('index'));
//        } else {
//            $this->error('添加失败！');
//        }
//    }

    public function delete($dyncommentid)
    {
//   echo $dyncommentid;exit();


        $comment = D('dyncomment');
        if ($comment->delete($dyncommentid)) {
            $this->success('删除成功！', U('index'));
        } else {
            $this->error('删除失败！');
        }
    }
    public function deletes(){

        $dyncomment = D('dyncomment');
        //var_dump($dyncomment);exit();
        $deletes=I('deletes');
     //var_dump($deletes);exit();
        $deletes=implode(',',$deletes);
        //var_dump($deletes);exit();
        if($dyncomment->delete($deletes)){
            $this->success('批量删除成功！',U('index'));
        }else{
            $this->error('批量删除失败！');
        }

    }
}