angular.module('setUpModule',[]).controller('setUpCtrl',function($state,$scope,$ionicHistory,$ionicPopup){
    //返回
    $scope.goPersonSideMenu = function () {
        $state.go('dynamic');
    }
    $scope.settingsList = [
        { text: "声音", checked: true }
    ];

    var data = JSON.parse(localStorage.getItem('data')) ;
    var list = data.content;
    //console.log(list);
    $scope.list = list;
    //退出系统
    $scope.loginOut = function () {
        var confirmPopup = $ionicPopup.confirm({
            title: '提示',
            template: '确认退出吗？'
        });
        confirmPopup.then(function (res) {
            if (res) {
                localStorage.clear();
                $ionicHistory.clearCache();
                $state.go('login');
                //window.location.reload();
                //$ionicLoading.hide();
                $.ajax({
                    url:'http://172.16.121.36/CWP/service/admin.php/Home/User/LoginOut',
                    type:'post',
                    data:{
                        userId:list.userid
                    },
                    success:function (data) {

                    },
                    error:function (err) {
                        console.log(err);
                    }
                });
            } else {
                //console.log('You are not sure');
            }
        });
    }
});