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
<!--<script src="/CWP/admin/Public/js/jquery-3.1.1.min.js"></script>-->
<div class="aright ">

    <div>
        <form class="layui-form" action="<?php echo U('dynamic/index');?>" method="get">
            <input placeholder="输入关键字" name="kw" value="<?php echo I('kw');?>" type="text" class="layui-input" style="float: left;margin-right: 10px;margin-bottom:30px;margin-left:30px;width: 300px;">
            <button class="layui-btn submitBtn" style="float: left;" value="查询" type="submit">查询</button>
        </form>
    </div>

    <form method="post" class="aform cl " action="<?php echo U('Dynamic/deletes');?>">
        <table width="100%">
            <tr>
                <th width="5%" align="center">
                    <input type="checkbox" name="checkbox" id="selall" />
                </th>
                <th width="5%" align="center">编号</th>
                <th width="30%" align="center">动态内容</th>
                <th width="10%" align="center">动态图片</th>
                <th width="10%" align="center">动态视频</th>
                <th width="10%" align="center">添加时间</th>
                <th width="10%" align="center">所属标签</th>
                <th width="10%" align="center">审核显示</th>
                <th width="10%" align="center">基本操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><input type="checkbox" class="selall" name="deletes[]" value="<?php echo ($vo["dynid"]); ?>" /></td>
                    <td align="center"><?php echo ($vo["dynid"]); ?></td>
                    <td align="center"><?php echo ($vo["dynword"]); ?></td>
                    <td align="center">
                        <?php if($vo[dynpic] != ''): ?><img src="/CWP/admin/Uploads<?php echo ($vo["dynpic"]); ?>" height="30">
                            <?php else: ?>
                            暂无缩略图<?php endif; ?>
                    </td>
                    <td align="center">
                        <?php if($vo[dynvideo] != ''): ?><img src="/CWP/admin/Uploads<?php echo ($vo["dynvideo"]); ?>" height="30">
                            <?php else: ?>
                            暂无缩略图<?php endif; ?>
                    </td>
                    <td align="center"><?php echo ($vo["dyncreatedate"]); ?></td>
                    <td align="center"><?php echo ($vo["dynlable"]); ?></td>
                    <td align="center">
                        <!--<div class="layui-form-item">-->
                                <!--<?php if($vo['dynstatus'] == 1): ?>-->
                                    <!--<input type="checkbox"  lay-skin="switch" onclick="changeshows(this,<?php echo ($vo["dynid"]); ?>);" lay-text="显示|隐藏" checked="checked">-->
                                    <!--<?php else: ?>-->
                                    <!--<input onclick="changeshows(this,<?php echo ($vo["dynid"]); ?>);" type="checkbox" lay-skin="switch" lay-text="显示|隐藏">-->
                                <!--<?php endif; ?>-->
                        <!--</div>-->
                        <?php if($vo['dynstatus'] == 1): ?><a onclick="changeshows(this,<?php echo ($vo["dynid"]); ?>);" class="layui-unselect layui-form layui-form-switch layui-form-onswitch"></a>
                        <?php else: ?>
                            <a onclick="changeshows(this,<?php echo ($vo["dynid"]); ?>);" class="layui-unselect layui-form layui-form-switch"></a><?php endif; ?>
                    </td>

                    <td align="center">
                        <a class="layui-btn layui-btn-mini layui-btn-danger" href="<?php echo U('Dynamic/delete',array('dynid'=>$vo['dynid']));?>" onclick="return confirm('您确定要删除吗？');">
                            删除
                        </a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="layui-form-item">
            <div style="margin-top: 20px;">
                <button class="layui-btn submitBtn" onclick="return confirm('您确定要删除吗？');" type="submit">删除选中</button>
                <a class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</a>
            </div>
        </div>
    </form>
    <div class="pages">
        <?php echo ($page); ?>
    </div>
</div>
</div>
<script>
    $("#selall").click(function () {
        if ($(this).attr("checked")) {
            $(".selall").attr("checked", "checked");
        } else {
            $(".selall").removeAttr("checked");
        }

    })
</script>
<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
    });
</script>
<script src="/CWP/admin/Public/js/js.js"></script>
</body>
</html>