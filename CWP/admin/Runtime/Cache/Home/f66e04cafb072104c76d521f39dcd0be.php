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
<div class="aright">

<div class="arz cl"><a href="<?php echo U('Announce/add');?>"><i class="layui-icon">&#xe608;</i>添加公告</a></div>
<form method="post" class="aform cl">
<table width="100%">
<tr>
<th width="10%" align="center">公告编号</th>
<th width="20%" align="center">公告图片</th>
<th width="20%" align="center">添加时间</th>
<th width="20%" align="center">基本操作</th>
</tr>
<?php if(is_array($c)): foreach($c as $k=>$vo): ?><tr>
<td align="center"><?php echo ($vo["annid"]); ?></td>

<td align="center"><?php if($vo['annpic'] != ''): ?><img src="/CWP/admin/Uploads<?php echo ($vo["annpic"]); ?>" height="30"><?php else: ?>暂无图片<?php endif; ?></td>
<td align="center"><?php echo ($vo["anncreatedate"]); ?></td>
<td align="center">
<a class="layui-btn layui-btn-mini layui-btn-normal" href="<?php echo U('Announce/edit',array('annid'=>$vo['annid']));?>">修改</a><a class="layui-btn layui-btn-mini layui-btn-danger" href="<?php echo U('Announce/delete',array('annid'=>$vo['annid']));?>" onclick="return confirm('您确定删除吗？');">删除</a>
</td>
</tr><?php endforeach; endif; ?>
</table>
</form> 
</div>
</div>
</body>
</html>