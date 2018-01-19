<?php

namespace Home\Controller;

use Think\Controller;
use Home\Common\Response;

date_default_timezone_set('PRC');
//header('content-type:application/json');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class DynamicController extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function getDynamicBYdate($id)
    {
        $dynamic = M('dynamic');
        $data = $dynamic->query("SELECT a.dynId,d.userId,c.isHate,b.isLike,a.dynComCount,b.dynLikeCount,c.dynHateCount,a.date,a.word,a.pic,d.nickname,d.headpic FROM
				(SELECT u.userId,u.userNickName nickname,u.userPic headpic,dm.dynId FROM cwp_user u,cwp_dynamic dm 
				WHERE u.userId = dm.userId AND dm.dynStatus = 1) as d
				LEFT JOIN
        (SELECT dm.dynId,COUNT(dc.userId) dynComCount,dm.dynCreateDate date,dm.dynWord word,dm.dynPic pic FROM cwp_dynamic dm
        LEFT JOIN cwp_dyncomment dc ON dc.dynId = dm.dynId
        LEFT JOIN cwp_user u ON dc.userId = u.userId
        GROUP BY dm.dynId) as a ON d.dynId = a.dynId
        LEFT JOIN
        (SELECT dm.dynId,COUNT(dl.dynLikeCreateDate) dynLikeCount,dl.userId isLike FROM cwp_dynamic dm
        LEFT JOIN cwp_user u ON u.userId = dm.userId AND u.userId = {$id}
        LEFT JOIN cwp_dynlike dl ON dl.dynId = dm.dynId  
        GROUP BY dm.dynId) as b ON a.dynId = b.dynId 
        LEFT JOIN
        (SELECT dm.dynId,COUNT(dh.dynHateCreateDate) dynHateCount,dh.userId isHate FROM cwp_dynamic dm
         LEFT JOIN cwp_user u ON u.userId = dm.userId AND u.userId = {$id}
        LEFT JOIN cwp_dynhate dh ON dh.dynId = dm.dynId
        GROUP BY dm.dynId) as c ON b.dynId = c.dynId
        ORDER BY a.date DESC");

        if ($data) {
            Response::json('1001', '获取动态成功！', $data);
        } else {
            Response::json('-1001', '获取动态失败！');
        }
    }

    public function getDynamicByLikeCount($id)
    {
        $dynamic = M('dynamic');
        $data = $dynamic->query("SELECT a.dynId,d.userId,c.isHate,b.isLike,a.dynComCount,b.dynLikeCount,c.dynHateCount,a.date,a.word,a.pic,d.nickname,d.headpic FROM
				(SELECT u.userId,u.userNickName nickname,u.userPic headpic,dm.dynId FROM cwp_user u,cwp_dynamic dm 
				WHERE u.userId = dm.userId AND dm.dynStatus = 1) as d
				LEFT JOIN
        (SELECT dm.dynId,COUNT(dc.userId) dynComCount,dm.dynCreateDate date,dm.dynWord word,dm.dynPic pic FROM cwp_dynamic dm
        LEFT JOIN cwp_dyncomment dc ON dc.dynId = dm.dynId
        LEFT JOIN cwp_user u ON dc.userId = u.userId
        GROUP BY dm.dynId) as a ON d.dynId = a.dynId
        LEFT JOIN
        (SELECT dm.dynId,COUNT(dl.dynLikeCreateDate) dynLikeCount,dl.userId isLike FROM cwp_dynamic dm
        LEFT JOIN cwp_user u ON u.userId = dm.userId AND u.userId = {$id}
        LEFT JOIN cwp_dynlike dl ON dl.dynId = dm.dynId 
        GROUP BY dm.dynId) as b ON a.dynId = b.dynId 
        LEFT JOIN
        (SELECT dm.dynId,COUNT(dh.dynHateCreateDate) dynHateCount,dh.userId isHate FROM cwp_dynamic dm
        LEFT JOIN cwp_user u ON u.userId = dm.userId AND u.userId = {$id}
        LEFT JOIN cwp_dynhate dh ON dh.dynId = dm.dynId
        GROUP BY dm.dynId) as c ON b.dynId = c.dynId
        ORDER BY b.dynLikeCount desc		
        ");
        //var_dump($data);
        if ($data) {
            Response::json('1001', '获取动态成功！', $data);
        } else {
            Response::json('-1001', '获取动态失败！');
        }
    }

    public function getMyComment($id)
    {
        $dynamic = M('dynamic');
        $data = $dynamic->query("SELECT mine.dynId,mine.minenickname,mine.mineheadpic,mine.date,mine.mineword,mine.dcId,other.otherheadpic,other.othernickname,other.otherword FROM
            (SELECT dc.dynId,u.userPic mineheadpic,u.userNickName minenickname,dc.dynComCreateDate date,dc.dynComContent mineword ,dc.dynCommentId dcId FROM cwp_dyncomment dc
            LEFT JOIN cwp_user u ON dc.userId = u.userId WHERE u.userId = {$id}) AS mine
            LEFT JOIN
            (SELECT dm.dynId,u.userPic otherheadpic,u.userNickName othernickname,dm.dynWord otherword FROM cwp_dynamic dm
            LEFT JOIN cwp_user u ON dm.userId = u.userId GROUP BY dm.dynId) AS other ON mine.dynId = other.dynId
            GROUP BY mine.dynId
ORDER BY mine.date
");
        //var_dump($data);
        if ($data) {
            Response::json('1001', '获取我评论的成功！', $data);
        } else {
            Response::json('-1001', '获取我评论的失败！');
        }
    }

    public function getMyLike($id)
    {
        $dynamic = M('dynamic');
        $data = $dynamic->query("SELECT mine.dynId,mine.minenickname,mine.mineheadpic,mine.likedate,other.otherheadpic,other.othernickname,other.otherword FROM
            (SELECT dl.dynId,u.userPic mineheadpic,u.userNickName minenickname,dl.dynLikeCreateDate likedate FROM cwp_dynlike dl
            LEFT JOIN cwp_user u ON dl.userId = u.userId WHERE u.userId = {$id}) AS mine
            LEFT JOIN
            (SELECT dm.dynId,u.userPic otherheadpic,u.userNickName othernickname,dm.dynWord otherword FROM cwp_dynamic dm
            LEFT JOIN cwp_user u ON dm.userId = u.userId GROUP BY dm.dynId) AS other ON mine.dynId = other.dynId
            GROUP BY mine.dynId
ORDER BY mine.likedate
");
        //var_dump($data);
        if ($data) {
            Response::json('1001', '获取我赞的成功！', $data);
        } else {
            Response::json('-1001', '获取我赞的失败！');
        }
    }

    public function addDynamic()
    {
        $dynamic = M('dynamic');
        $data = $dynamic->create();
        //dump($data);
        if ($_FILES['dynPic']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->autoSub = false;
            $upload->rootPath = '../admin/Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['dynPic']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['dynPic'] = $info['savepath'] . $info['savename'];
            }
        }
        $date = date('Y-m-d H:i:s', time());
        $data['dynCreateDate'] = $date;
        $result = $dynamic->add($data);
        if ($result) {
            Response::json('1001', '添加成功');
        } else {
            Response::json('-1001', '添加失败');
        }
    }

    public function getMyDynamic($id)
    {
        $dynamic = M('dynamic');
        $data = $dynamic->query("SELECT a.dynId,d.userId,b.isLike,c.isHate,a.dynComCount,b.dynLikeCount,c.dynHateCount,a.date,a.word,a.pic,d.nickname,d.headpic FROM
				(SELECT u.userId,u.userNickName nickname,u.userPic headpic,dm.dynId FROM cwp_user u,cwp_dynamic dm 
				WHERE u.userId = dm.userId AND u.userId = {$id} AND dm.dynStatus = 1) as d
				LEFT JOIN
        (SELECT dm.dynId,COUNT(dc.userId) dynComCount,dm.dynCreateDate date,dm.dynWord word,dm.dynPic pic FROM cwp_dynamic dm
        LEFT JOIN cwp_dyncomment dc ON dc.dynId = dm.dynId
        LEFT JOIN cwp_user u ON dc.userId = u.userId
        GROUP BY dm.dynId) as a ON d.dynId = a.dynId
        LEFT JOIN
        (SELECT dm.dynId,COUNT(dl.dynLikeCreateDate) dynLikeCount,dl.userId isLike FROM cwp_dynamic dm
        LEFT JOIN cwp_user u ON u.userId = dm.userId
        LEFT JOIN cwp_dynlike dl ON dl.dynId = dm.dynId AND dl.userId = {$id}
        GROUP BY dm.dynId) as b ON a.dynId = b.dynId 
        LEFT JOIN
        (SELECT dm.dynId,COUNT(dh.dynHateCreateDate) dynHateCount,dh.userId isHate FROM cwp_dynamic dm
         LEFT JOIN cwp_user u ON u.userId = dm.userId
        LEFT JOIN cwp_dynhate dh ON dh.dynId = dm.dynId AND dh.userId = {$id}
        GROUP BY dm.dynId) as c ON b.dynId = c.dynId
        ORDER BY a.date DESC 
");
        if ($data) {
            Response::json('1001', '获取我的动态成功！', $data);
        } else {
            Response::json('-1001', '获取我的动态失败！');
        }
    }

    public function deleteDynamic($id)
    {
        $dynamic = M('dynamic');
        $dynamic->where("dynid = {$id}")->delete();
    }
    //删除我的评论
    function deleteCom($comId)
    {
        $data = D('dyncomment');
        if ($data->delete($comId)) {
            Response::json("1001", "删除某一评论成功", $data);
        } else {
            Response::json("-1001", "删除某一评论失败");
        }

    }



}