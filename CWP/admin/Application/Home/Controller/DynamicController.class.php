<?php
namespace Home\Controller;
use Home\Common\Response;
use Think\Controller;

//header('content-type:application/json');
//header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
//header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class DynamicController extends Controller {
    public function index(){
        $dynamic = D('dynamic');
        $where = 1;
        if ($kw = I('kw')) {
            $where .= ' AND dynWord LIKE "%' . $kw . '%"';
        }
        //var_dump($where);
        $count = $dynamic->count();
        $Page = new \Think\Page($count,15);
        $show = $Page->show();
        $list = $dynamic
            ->where($where)
            ->order('dynId DESC')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();
//        var_dump($list);
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }
    public function delete($dynid)
    {
        $dynamic = M('dynamic');
        if ($dynamic->delete($dynid)) {
            $this->success('删除成功！', U('index'));
        } else {
            $this->error('删除失败！');
        }
    }
    public function deletes()
    {
        $dynamic = M('dynamic');
        $deletes=I('deletes');
        $deletes=implode(',',$deletes);
        if($dynamic->delete($deletes)){
            $this->success('批量删除成功！',U('index'));
        }else{
            $this->error('批量删除失败！');
        }
    }

    public function changeshows()
    {
        $id = $_POST['id'];
        $dynamic = M('dynamic');
        $data = $dynamic->where("dynId={$id}")->find();
        //var_dump($data) ;
        if ($data['dynstatus'] == 0) {
            $dynamic->where("dynId={$id}")->setField('dynStatus', 1);
            $this->ajaxReturn(1);
        } else if ($data['dynstatus'] == 1) {
            $dynamic->where("dynId={$id}")->setField('dynStatus', 0);
            $this->ajaxReturn(0);
        }
    }

}