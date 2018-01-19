angular.module('registerModule',[]).controller('registerCtrl',function($state,$scope,$ionicHistory,$ionicPopup,$ionicViewSwitcher){
    $scope.goLogin = function () {
        $ionicHistory.goBack();
        $ionicViewSwitcher.nextDirection("back");
    }
    //验证注册
    var btn = document.getElementById("btn");
    var result = document.getElementById("result");
    result.innerHTML = 'false';
    //$scope.boole = 'false';
    var slider = new FtSlider({
        id: "slider",
        callback: function(res) {
            //console.log(res);
            result.innerHTML = res;
        }
    });


    //显示密码
    $scope.showPwd = function () {
        var typeStyle = $("#RegPasswordId").attr("type");
        //console.log(typeStyle);
        if(typeStyle == "password"){
            $("#RegPasswordId").attr("type","text");
        }else{
            $("#RegPasswordId").attr("type","password");
        }
    };
    $scope.dismissOne = function () {
        $scope.userName = "";
    };
    $scope.dismissTwo = function () {
        $scope.userPwd = "";
    };

    //注册
    $scope.registerBtn = function () {
        //slider.restore();
        var userName = $scope.userName;
        var userPwd = $scope.userPwd;
        //console.log(slider.isDrag);
        var boole = result.innerHTML;

        if (!userName || userName == '') {
            $ionicPopup.alert({
                title: '提示',
                template: '用户名不能为空!'
            });
            return;
        }

        if (!userPwd || userPwd == '') {
            $ionicPopup.alert({
                title: '提示',
                template: '密码不能为空!'
            });
            return;
        }
        if (boole == 'false') {
            $ionicPopup.alert({
                title: '提示',
                template: '验证失败!'
            });
            return;
        }
        checkRegister(userName,userPwd);
    }
    function checkRegister(userName,userPwd) {
        $.ajax({
            url:'http://172.16.121.36/CWP/service/admin.php/Home/User/checkRegister',
            type:'post',
            data:{
                userName:userName,
                userPwd:userPwd
            },
            success:function (data) {
                data = JSON.parse(data);
                console.log(data);
                switch (data.code){
                    case '1001':
                        var confirmPopup = $ionicPopup.confirm({
                            title: '提示',
                            template: data.message,
                            buttons: [{
                                text:'OK',
                                type: 'button-positive',
                                onTap: function(res) {
                                    if (res) {
                                        $state.go('login');
                                    }
                                }
                            }]
                        });
                    break;
                    case '-1001':
                        $ionicPopup.alert({
                            title: '错误',
                            template: data.message,
                            buttons: [{
                                text:'OK',
                                type: 'button-assertive'
                            }]
                        });
                    break;
                    case '-1002':
                        $ionicPopup.alert({
                            title: '错误',
                            template: data.message,
                            buttons: [{
                                text:'OK',
                                type: 'button-assertive'
                            }]
                        });
                    break;
                    case '-1003':
                        $ionicPopup.alert({
                            title: '错误',
                            template: data.message,
                            buttons: [{
                                text:'OK',
                                type: 'button-assertive'
                            }]
                        });
                    break;

                }
            },
            error:function (err) {
                console.log(err);
            }
        });
    }

});