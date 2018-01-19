angular.module('addDynamicModule',[]).controller('addDynamicCtrl',function($state,$scope,$ionicPopup,$ionicHistory){
    //接受userId
    var data = JSON.parse(localStorage.getItem('data')) ;
    var list = data.content;
    $scope.userId = list.userid;
    //去消息
    $scope.goMine = function () {
        $state.go('mine');
    }
    //去动态
    $scope.goDynamic = function () {
        $state.go('dynamic');
    }
    //取消发布动态
    $scope.cancel = function () {
        $ionicPopup.confirm({
            title: '提示',
            template: '你的动态未保存!',
            buttons: [{
                text:'确认',
                type: 'button-assertive',
                onTap: function(res) {
                    if (res) {
                        $ionicHistory.goBack();
                    }
                }
            },
            {text:'取消'}]
        });
    }
    //发布动态
    $scope.releaseDynamic = function () {
        //console.log($('#textArea').val().length);
        if($('#textArea').val().length!=0){
            var formData = new FormData($('#addDynamic')[0]);
            //console.log(formData);
            $.ajax({
                type: 'POST',
                url: 'http://172.16.121.36/CWP/service/admin.php/Home/Dynamic/addDynamic',
                data:formData,
                dataType:"json",
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.code>0){
                        $ionicPopup.confirm({
                            title: '提示',
                            template: '发送成功！',
                            buttons: [{
                                text:'OK',
                                type: 'button-positive',
                                onTap: function(res) {
                                    if (res) {
                                        $state.go('dynamic');
                                    }
                                }
                            }]
                        });
                    }else{
                        $ionicPopup.confirm({
                            title: '提示',
                            template: '发布失败！'
                        });
                    }
                }
            });
        }else {
            $ionicPopup.confirm({
                title: '提示',
                template: '你的动态为空！',
                buttons: [{
                    text:'确认',
                    type: 'button-assertive'
                }]
            });
        }
    }
});