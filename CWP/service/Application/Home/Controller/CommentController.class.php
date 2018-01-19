<?php
namespace Home\Controller;
use Home\Common\Response;
use Think\Controller;
header('content-type:application/json');
header('Access-Control-Allow-Origin:*');
class CommentController extends Controller {
    //获取所有的评论
    function getDynComment($dynId){
        //echo $dynId;exit();
        $data = D("user")->query("SELECT cwp_user.userId,cwp_user.userPic,cwp_user.userNickName,cwp_dyncomment.dynComCreateDate,cwp_dyncomment.dynComContent 
from cwp_user,cwp_dynamic,cwp_dyncomment WHERE 
cwp_dyncomment.dynId=cwp_dynamic.dynId and cwp_dyncomment.userId=cwp_user.userId and
 cwp_dynamic.userId=cwp.cwp_dynamic.userId and cwp_dynamic.dynId={$dynId} ORDER BY cwp_dyncomment.dynComCreateDate DESC ");


        if($data>0){
            Response::json("1001","成功",$data);

        }
        else{
            Response::json("-1001","失败");
        }
    }
//获取所有的点赞
    function getLikeDynamic($dynId){

        $data = M("dynlike")->query("SELECT cwp_user.userId,cwp_user.userPic ,cwp_user.userNickName,cwp_dynlike.dynLikeCreateDate from cwp_user,cwp_dynlike WHERE cwp_dynlike.userId=cwp_user.userId and dynId={$dynId} ORDER BY cwp_dynlike.dynLikeCreateDate DESC");
        //var_dump($data);exit();
        if($data>0){
            Response::json("1001","成功",$data);
        }
        else{
            Response::json("-1001","失败");
        }
    }


   //获取所有的踩
    function getHateDynamic($dynId){

        $data = M("dynlike")->query("SELECT cwp_user.userId,cwp_user.userPic ,cwp_user.userNickName,cwp_dynhate.dynHateCreateDate from cwp_user,cwp_dynhate WHERE cwp_dynhate.userId=cwp_user.userId and dynId={$dynId} ORDER BY cwp_dynhate.dynHateCreateDate DESC");
        //var_dump($data);exit();
        if($data>0){
            Response::json("1001","成功",$data);
        }
        else{
            Response::json("-1001","失败");
        }
    }
//写入评论
    function saveComment(){

        $dynId = $_REQUEST['dynId'];
        $comment = $_REQUEST['comment'];
        $date = date('Y-m-d H:i:s',time());
        $userid= $_REQUEST['userid'];
        $user = M('dyncomment');
        $user->create();
        $data['dynId'] = $dynId;
        $data['dynComContent'] = $comment;
        $data['dynComCreateDate'] = $date;
        $data['userId'] =$userid;
        $user->data($data)->add();
        echo "hello world";

    }
    //评论我的
    function commentMyDynamic($userid){

        $data = M("dynlike")->query("SELECT mine.dynId,mine.mineword,mine.dyndate,mine.pic,mine.dynickname,other.otherdate,other.otherheadpic,other.othernickname,other.otherword,other.dcComId FROM
		(SELECT dm.dynId,dm.dynWord mineword ,dm.dynCreateDate dyndate,dm.dynPic pic,u.userNickName dynickname FROM cwp_dynamic dm
		LEFT JOIN cwp_user u ON dm.userId = u.userId WHERE u.userId = {$userid}) AS mine
		LEFT JOIN
		(SELECT dm.dynId,dc.dynComCreateDate otherdate,dc.dynCommentId dcComId,u.userPic otherheadpic,u.userNickName othernickname,dc.dynComContent otherword FROM cwp_dynamic dm 
		LEFT JOIN cwp_dyncomment dc  ON dm.dynId = dc.dynId 
		LEFT JOIN cwp_user u ON dc.userId = u.userId
		 WHERE dc.dynComContent != '') AS other ON mine.dynId = other.dynId
		ORDER BY other.otherdate DESC
");
        //ar_dump($data);exit();
        if($data>0){
            Response::json("1001","获取评论我的成功",$data);
        }
        else{
            Response::json("-1001","获取评论我的失败");
        }
    }
    //点赞我的
    function likeMyDynamic($userid){

        $data = M("dynlike")->query("SELECT mine.dynId,mine.mineword,other.otherdate,other.otherheadpic,other.othernickname FROM
		(SELECT dm.dynId,dm.dynWord mineword FROM cwp_dynamic dm
		LEFT JOIN cwp_user u ON dm.userId = u.userId WHERE u.userId = {$userid}) AS mine
		LEFT JOIN
		(SELECT dm.dynId,dl.dynLikeCreateDate otherdate,u.userPic otherheadpic,u.userNickName othernickname FROM cwp_dynamic dm 
		LEFT JOIN cwp_dynlike dl ON dl.dynId = dm.dynId 
		LEFT JOIN cwp_user u ON dl.userId = u.userId
		) AS other ON mine.dynId = other.dynId
		ORDER BY other.otherdate DESC
");
        //ar_dump($data);exit();
        if($data>0){
            Response::json("1001","获取点赞我的成功",$data);
        }
        else{
            Response::json("-1001","获取点赞我的失败");
        }
    }

//查询某一条具体的评论
function whichDynamicDetails($dynId,$dyncommentId){
    $data = M("dynamic")->query("SELECT cwp_user.userPic,cwp_user.userNickName,cwp_dyncomment.dynComContent,cwp_dyncomment.dynComCreateDate,
cwp_dynamic.dynWord
FROM cwp_dyncomment,cwp_user,cwp_dynamic WHERE cwp_dyncomment.dynId=cwp_dynamic.dynId
and cwp_dyncomment.userId=cwp_user.userId and cwp_dyncomment.dynId={$dynId} and cwp_dyncomment.dynCommentId={$dyncommentId}");
    //var_dump($data);exit();
    if($data>0){
        Response::json("1001","成功",$data);
    }
    else{
        Response::json("-1001","失败");
    }
}
//删除某一评论
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