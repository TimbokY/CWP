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

<fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
  <legend>添加公告</legend>
</fieldset>

<form class="layui-form bform" method="post" action="<?php echo U('Announce/doadd');?>" enctype="multipart/form-data">


  <div class="layui-form-item">
    <label class="layui-form-label">缩略图</label>
     <div class="layui-input-block">
     <div class="file-box">
     <i class="layui-icon">&#xe61f;</i>
     <input class="file-btn" type="button" value="选择图片"> 
     <input class="file-txt" type="text" name="textfield" id="textfield"> 
     <input class="file-file" type="file" name="annPic" id="annpic" size="28" onchange="document.getElementById('textfield').value=this.value" />
     </div>
     </div>
  </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <textarea name="annContent" placeholder="请输入内容" class="layui-textarea"></textarea>
        </div>
    </div>


  <div class="layui-form-item">
    <div class="layui-input-block">
	  <button class="layui-btn submitBtn" lay-submit lay-filter="formDemo">立即提交</button>
      <a class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</a>
    </div>
  </div>

</form>
<script>
layui.use('form', function(){
  var form = layui.form();
});
</script>
</div>
</div>
</body>
</html>