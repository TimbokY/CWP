angular.module('loginModule',[]).controller('loginCtrl',function($state,$scope,$ionicPopup,$ionicLoading,$rootScope){
    $scope.goRegister = function () {
        $state.go('register');
    }
    
    $scope.loginBtn = function () {
        $ionicLoading.show({
            content: 'Loading',
            animation: 'fade-in',
            template: '<ion-spinner icon="lines" class="spinner-calm"></ion-spinner>',
            showBackdrop: true,
            maxWidth: 200,
            showDelay: 0
        });

        var userName = $scope.userName;
        var Pwd = $scope.userPwd;

        if (!userName || userName == '') {
            $ionicLoading.hide();
            $ionicPopup.alert({
                title: '提示',
                template: '请输入用户名'
            });
            return;
        }

        if (!Pwd || Pwd == '') {
            $ionicLoading.hide();
            $ionicPopup.alert({
                title: '提示',
                template: '请输入密码'
            });
            return;
        }
        checkLogin(userName,Pwd);
    }

    //显示密码
    $scope.showPwd = function () {
        var typeStyle = $('#loginPasswordId').attr('type');
        //console.log(typeStyle);
        if(typeStyle=='password'){
            $('#loginPasswordId').attr('type','text');
        }else{
            $('#loginPasswordId').attr('type','password');
        }
    }
    //判断登录
    function checkLogin(userName,Pwd) {
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/Home/User/checkLogin',
            type:'post',
            data:{
                userName:userName,
                userPwd:Pwd
            },
            success:function (data) {
                data = JSON.parse(data);
                //console.log(data.content.userid);
                var userId = data.content.userid;
                getSkin(userId);
                if(data.code>0){
                    $ionicLoading.hide();
                    $state.go('dynamic');
                }else {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: '提示',
                        template: data.message
                    });
                }
                data = JSON.stringify(data);
                //$scope.user = data;
                //console.log(data);
                localStorage.setItem('data',data);
                //$rootScope.skin = 'calm';
            },
            error:function () {

            }
        });
    }
    //获取皮肤数据
    function getSkin(nowUserId) {
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/Home/Skin/getSkin',
            type:'post',
            data:{userId:nowUserId},
            dataType:'json',
            success:function (data) {
                //console.log(data.content[0].skin);
                $rootScope.skin = data.content[0].skin;
            }
        });
    }
    console.clear();
});