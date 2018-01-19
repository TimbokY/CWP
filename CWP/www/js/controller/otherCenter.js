angular.module('otherCenterModule',[]).controller('otherCenterCtrl',function($state,$scope){
    var otherUserId = localStorage.getItem('otherUserId');
    //console.log(otherUserId);
    //返回我的动态
    $scope.goMyDynamic = function () {
        $state.go('myDynamic');
    }
    function getUserInfo() {
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/Home/User/getUserInfo',
            data:{userId:otherUserId},
            dataType:'json',
            success:function (data) {
                console.log(data);
                $scope.list = data.content;
            },
            error:function (err) {
                console.log(err);
            }
        });
    }
    getUserInfo();
});