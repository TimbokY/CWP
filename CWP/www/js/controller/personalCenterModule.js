angular.module('personalCenterModule',[]).controller('personalCenterCtrl',function($state,$scope,$ionicPopup,$ionicActionSheet){
    $scope.goPersonSideMenu = function () {
        var formData = new FormData($('#editPic')[0]);
        //console.log(formData);
        $.ajax({
            type: 'POST',
            url: 'http://localhost/CWP/service/admin.php/Home/User/editPic',
            data:formData,
            dataType:"json",
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
            }
        });
        $state.reload();
        $state.go('dynamic',{reload:true});
    }

    //数据
    var data = JSON.parse(localStorage.getItem('data')) ;
    var USER = data.content;
    //获取用户资料
    function getUserInfo(){
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/Home/User/getUserInfo',
            data:{userId:USER.userid},
            dataType:'json',
            success:function (data) {
                console.log(data);
                var list = data.content;
                $scope.list = list;
                console.log(list);
                $scope.userName = list.username;
                $scope.userNickName = list.usernickname;
                $scope.userInfo = list.userinfo;
                $scope.userHomePlace = list.userhomeplace;
                $scope.userBirth = list.userbirth;
                $scope.userSchool = list.userschool;
                $scope.userLastLoginTime = list.userlastlogintime;
                if(list.usersex == 1){
                    $scope.userSex = '男';
                }else{
                    $scope.userSex = '女';
                }
            },
            error:function (err) {
                console.log(err);
            }
        });
    }
    getUserInfo();

    var userId = USER.userid;
    var str = USER.userhomeplace;
    var array = str.split("-");
    //console.log(array);
    //地址
    var vm=$scope.vm={};
    vm.CityPickData = {
        areaData: [],
        defaultAreaData: [array[0],array[1],array[2]],
        title:'地区',
        buttonClicked: function(callback) {
            //console.log(vm.CityPickData.areaData);
            var HomePlace = vm.CityPickData.areaData[0]+'-'+vm.CityPickData.areaData[1]+'-'+vm.CityPickData.areaData[2]
            console.log(HomePlace);
            $.ajax({
                url:'http://localhost/CWP/service/admin.php/Home/User/editHomePlace',
                type:'post',
                data:{
                    userId:userId,
                    userHomePlace:HomePlace,
                },
                success:function (data) {
                    console.log(data);
                },
                error:function (err) {
                    console.log(err);
                }
            });
        }
    }

    //保存资料
    $scope.saveUser = function () {
        var userId = USER.userid;
        var userNickName = $scope.userNickName;
        var userInfo = $scope.userInfo;
        var userSchool = $scope.userSchool;
        var userBirth = $scope.userBirth;
        if($scope.userSex == '男'){
            var userSex = 1;
        }else{
            var userSex = 0;
        }
        //console.log(userId);
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/Home/User/doEdit',
            type:'post',
            data:{
                userId:userId,
                userNickName:userNickName,
                userInfo:userInfo,
                userSchool:userSchool,
                userBirth:userBirth,
                userSex:userSex,
            },
            success:function (data) {
                console.log(data);
            },
            error:function (err) {
                console.log(err);
            }
        });
    }
});