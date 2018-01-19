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
    <div class="aright_1">
        <blockquote style="padding: 10px;border-left: 10px solid #AC1122;" class="layui-elem-quote">欢迎进入校园随拍后台管理，管理员们需要注意以下问题:</blockquote>
        <table width="100%">
            <tr>
                <td width="480px">程序正式上线运营请把admin.php里面调试模式关闭；</td>
                <td>请使用<span style="color: #AC1122">谷歌浏览器</span>打开本系统</td>
            </tr>
            <tr>
                <td>请仔细筛选用户信息；</td>
                <td>请将程序内的所有文件直接放在根目录下，不要多层目录；</td>
            </tr>
        </table>
        <blockquote style="padding: 10px;border-left: 10px solid #AC1122;" class="layui-elem-quote">系统信息：</blockquote>
        <table width="100%">
            <tr><td width="110px">程序版本</td><td>校园随拍APP V-1.0</td></tr>
            <tr><td>服务器类型</td><td><?php echo php_uname('s');?></td></tr>
            <tr><td>PHP版本</td><td><?php echo PHP_VERSION;?></td></tr>
            <tr><td>Zend版本</td><td><?php echo Zend_Version();?></td></tr>
            <tr><td>服务器解译引擎</td><td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td></tr>
            <tr><td>服务器语言</td><td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></td></tr>
            <tr><td>服务器Web端口</td><td><?php echo $_SERVER['SERVER_PORT'];?></td></tr>
        </table>
        <blockquote style="padding: 10px;border-left: 10px solid #AC1122;" class="layui-elem-quote">开发团队：</blockquote>
        <table width="100%">
            <tr><td width="110px">版权所有</td><td>《其实圈圈是组长》开发团队保留所有权利</td></tr>
            <tr><td>开发团队</td><td>许星杰、程帅、杨波、陈媛媛、董邦</td></tr>
            <tr><td>特别提醒您</td><td>本程序均可免费下载使用，但严禁删除、隐藏或更改版权信息，且导致的一切损失由使用者自行承担。</td></tr>
        </table>
    </div>
</div>
</div>
</body>
</html>