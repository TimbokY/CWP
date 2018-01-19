angular.module('changeSkinModule',[]).controller('changeSkinCtrl',function($state,$scope,$rootScope){
    var data = JSON.parse(localStorage.getItem('data'));
    var userId = data.content.userid;
    $scope.selectSkin = function (index) {
        //console.log(index);
        switch (index){
            case 1:
                changeSkin(1);
                break;
            case 2:
                changeSkin(2);
                break;
            case 3:
                changeSkin(3);
                break;
            case 4:
                changeSkin(4);
                break;
            case 5:
                changeSkin(5);
                break;
            case 6:
                changeSkin(6);
                break;
            case 7:
                changeSkin(7);
                break;
        }
    }

    //返回主界面
    $scope.goDynamic = function () {
        $state.go('dynamic');
    }

    function changeSkin(id) {
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/Home/Skin/changeSkin',
            data:{skinId:id},
            success:function (data) {
                data = JSON.parse(data);
                //console.log(data.content);
                var skin = data.content.skin;
                $rootScope.skin = skin;
            }
        });
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/Home/Skin/userSkin',
            data:{skinId:id,userId:userId},
            success:function (data) {
                data = JSON.parse(data);
                //console.log(data);
            }
        });
    }
});