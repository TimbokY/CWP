<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>校园随拍后台管理</title>
    <link rel="stylesheet" href="/CWP/admin/Public/css/admin.css">
    <link rel="stylesheet" href="/CWP/admin/Public/layui/css/layui.css">
    <script src="/CWP/admin/Public/layui/layui.js"></script>
    <link rel="stylesheet" href="/CWP/admin/Public/css/style.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/112481/45824/5a458baaf629d812acd860f3.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div class="header">
    <h2 class="z cl cssf44d2d9581b761">校园随拍后台管理</h2>
    <div class="y cl">
        <a href="<?php echo U('Login/logout');?>">退出</a>
    </div>
</div>
<div class="admin">
    <div class="aleft">
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #AC1122;">&#xe643;</i>操作菜单</h3>
        <ul class="cl">
            <li><i class="layui-icon">&#xe612;</i><a href="<?php echo U('User/index');?>">账号管理</a></li>
            <li><i class="layui-icon">&#xe638;</i><a href="<?php echo U('Dynamic/index');?>">帖子管理</a></li>
            <li><i class="layui-icon">&#xe63a;</i><a href="<?php echo U('Comment/index');?>">评论管理</a></li>
            <li><i class="layui-icon">&#xe609;</i><a href="<?php echo U('Announce/index');?>">公告管理</a></li>
            <li><i class="layui-icon">&#xe640;</i><a href="<?php echo U('apply/index');?>">反馈列表</a></li>
        </ul>
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #AC1122;">&#xe614;</i>系统管理</h3>
        <ul class="cl">
            <li><i class="layui-icon">&#xe640;</i><a href="<?php echo U('runtime/index');?>">清理缓存</a></li>
            <li><i class="layui-icon">&#x1006;</i><a href="<?php echo U('Login/logout');?>">立即退出</a></li>
        </ul>
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #AC1122;">&#xe612;</i>帮助中心</h3>
        <ul class="cl">
            <li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=909144903&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:909144903:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></li>
        </ul>
    </div>
<script src="/CWP/admin/Public/js/jquery-1.4.2.min.js"></script>
<div class="aright">
    <div class="arz" style="float: left;margin: 0px 20px 20px 30px;"><a href="<?php echo U('User/add');?>"><i class="layui-icon">&#xe608;</i>添加账号</a></div>

    <div style="float: left;">
        <form class="layui-form" action="http://localhost/Demo/CWP/admin/admin.php/Home/User/index.html" method="get">
            <input placeholder="输入账号" name="kw" value="<?php echo I('kw');?>" type="text" class="layui-input" style="float: left;margin-right: 10px;width: 300px;">
            <button class="layui-btn layui-btn submitBtn" style="float: left;" value="查询" type="submit">查询</button>
        </form>
    </div>

    <form method="post" class="aform cl" action="<?php echo U('User/deletes');?>">
        <table width="100%">
            <tr>
                <th width="5%"><input type="checkbox" name="checkbox" id="selall" /></th>
                <th width="5%">ID</th>
                <th width="10%">账号</th>
                <th width="10%">密码</th>
                <th width="5%">账号类型</th>
                <th width="10%">头像</th>
                <th width="5%">昵称</th>
                <th width="5%">性别</th>
                <th width="15%">注册日期</th>
                <th width="15%">最后登录时间</th>
                <th width="10%">基本操作</th>

            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><input type="checkbox" class="selall" name="deletes[]" value="<?php echo ($vo["userid"]); ?>" /></td>
                    <td><?php echo ($vo["userid"]); ?></td>
                    <td><span class="overFlow"><?php echo ($vo["username"]); ?></span></td>
                    <td><?php echo ($vo["userpwd"]); ?></td>
                    <td><?php if($vo[usertype] == 1): ?><button class="layui-btn layui-btn-mini layui-btn-radius layui-btn-warm">管理员</button><?php else: ?><button class="layui-btn layui-btn-mini layui-btn-radius layui-btn-primary">普通用户</button><?php endif; ?></td>
                    <td>
                        <?php if($vo[userpic] != ''): ?><img src="/CWP/admin/Uploads<?php echo ($vo["userpic"]); ?>" height="30">
                            <?php else: ?>
                            暂无缩略图<?php endif; ?>
                    </td>
                    <td><?php echo ($vo["usernickname"]); ?></td>
                    <td><?php if($vo[usersex] == 1): ?><span>男</span><?php else: ?><span>女</span><?php endif; ?></td>
                    <td><?php echo ($vo["userbirth"]); ?></td>
                    <td><?php echo ($vo["userlastlogintime"]); ?></td>
                    <td align="center"><a class="layui-btn layui-btn-mini layui-btn-normal" href="<?php echo U('User/edit',array('id'=>$vo['userid']));?>">修改</a><a class="layui-btn layui-btn-mini layui-btn-danger" href="<?php echo U('User/delete',array('id'=>$vo['userid']));?>" onclick="return confirm('您确定要删除吗？');">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="layui-form-item">
            <div style="margin-top: 20px;">
                <button class="layui-btn submitBtn" onclick="return confirm('您确定要删除吗？');" type="submit">删除选中</button>
                <!--<a class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</a>-->
            </div>
        </div>
    </form>
    <div class="pages">
        <?php echo ($page); ?>
    </div>
</div>
</div>
<script>
    $("#selall").click(function(){
        if($(this).attr("checked")){
            $(".selall").attr("checked","checked");
        }else{
            $(".selall").removeAttr("checked");
        }

    })
</script>
</body>
</html>