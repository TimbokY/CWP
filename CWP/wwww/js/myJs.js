    //多行文本输入框剩余字数计算
    function checkMaxInput(obj, maxLen) {
        if (obj == null || obj == undefined || obj == "") {
            return;
        }
        if (maxLen == null || maxLen == undefined || maxLen == "") {
            maxLen = 100;
        }
        var strResult;
        var $obj = $(obj);
        var newid = $obj.attr("id") + 'msg';
        if (obj.value.length > maxLen) {	//如果输入的字数超过了限制
            obj.value = obj.value.substring(0, maxLen); //就去掉多余的字
            strResult = '<p id="' + newid + '" class=\'Max_msg\' ><br/>剩余' + (maxLen - obj.value.length) + '字</p>'; //计算并显示剩余字数
        }
        else {
            strResult = '<p id="' + newid + '" class=\'Max_msg\' ><br/>剩余' + (maxLen - obj.value.length) + '字</p>'; //计算并显示剩余字数
        }
        var $msg = $("#" + newid);
        if ($msg.length == 0) {
            $obj.after(strResult);
        }
        else {
            $msg.html(strResult);
        }
    }
//清空剩除字数提醒信息
function resetMaxmsg() {
    $("span.Max_msg").remove();
}
/*---------------------------------------------------------------------------------------*/
    //图片上传预览    IE是用了滤镜。
    function previewImage(file)
    {
        var MAXWIDTH  = 90;
        var MAXHEIGHT = 90;
        var div = document.getElementById('preview');
        if (file.files && file.files[0])
        {
            div.innerHTML ='<img id=imghead onclick=$("#previewImg").click()>';
            var img = document.getElementById('imghead');
            img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
            }
            var reader = new FileReader();
            reader.onload = function(evt){img.src = evt.target.result;}
            reader.readAsDataURL(file.files[0]);
        }
        else //兼容IE
        {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
        }
    }
    function clacImgZoomParam( maxWidth, maxHeight, width, height ){
        var param = {top:0, left:0, width:width, height:height};
        if( width>maxWidth || height>maxHeight ){
            rateWidth = width / maxWidth;
            rateHeight = height / maxHeight;

            if( rateWidth > rateHeight ){
                param.width =  maxWidth;
                param.height = Math.round(height / rateWidth);
            }else{
                param.width = Math.round(width / rateHeight);
                param.height = maxHeight;
            }
        }
        param.left = Math.round((maxWidth - param.width) / 2);
        param.top = Math.round((maxHeight - param.height) / 2);
        return param;
    }
/*---------------------------------------------------------------------------------------*/








