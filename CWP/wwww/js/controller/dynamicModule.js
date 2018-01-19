angular.module('dynamicModule',[]).controller('dynamicCtrl',function($state,$scope,$ionicSideMenuDelegate,$ionicLoading,$ionicPopup,$rootScope,$ionicHistory){

    $scope.toggleLeft=function(){
        $ionicSideMenuDelegate.toggleLeft();
    }
    $scope.doEdit = function () {
        $state.go('personalCenter');
    }
    //获取ID
    var data = JSON.parse(localStorage.getItem('data')) ;
    var list = data.content;
    //console.log(list);
    $scope.list = list;
    //当前用户登录的ID
    var nowUserId = list.userid;
    localStorage.setItem('nowUserId',nowUserId);
    //获取用户资料
    function getUserInfo(){
        $.ajax({
            url:'http://172.16.121.36/CWP/service/admin.php/Home/User/getUserInfo',
            data:{userId:list.userid},
            dataType:'json',
            success:function (data) {
                //console.log(data);
                $scope.list = data.content;
                $scope.$apply();
            },
            error:function (err) {
                console.log(err);
            }
        });
    }
    getUserInfo();


    //按时间先后遍历
    function getDynamicBydate() {
        $.ajax({
            url:'http://172.16.121.36/CWP/service/admin.php/home/dynamic/getDynamicBydate/id/'+nowUserId,
            type:'post',
            dataType:'json',
            success:function (data) {
                console.log(data);
                if (data.code>0)
                {
                    $scope.nowUserId = nowUserId;
                    $scope.dynamics = data.content;
                    $scope.$apply();
                }

            },
            error:function (data) {
                console.log(data);
            }
        });
    }
    getDynamicBydate();
    //刷新页面
    $scope.doRefresh = function () {
        getDynamicBydate();
        $scope.$broadcast("scroll.refreshComplete");
    }
    //按热度大小遍历
    function getDynamicByLikeCount() {
        $.ajax({
            url:'http://172.16.121.36/CWP/service/admin.php/home/dynamic/getDynamicByLikeCount/id/'+nowUserId,
            type:'post',
            dataType:'json',
            success:function (data) {
                console.log(data);
                if (data.code>0)
                {
                    var nowId = localStorage.getItem('id');
                    $scope.nowId = nowId;
                    $scope.dynamics = data.content;
                    $scope.$apply();
                }
            },
            error:function (data) {
                console.log(data);
            }
        });
    }
    //getDynamicByLikeCount();

    //切换排行方式
    $scope.changeSortBylike = function () {
        getDynamicByLikeCount();
        $('#time').removeClass('active');
        $('#like').addClass('active');
    }
    $scope.changeSortByTime = function () {
        getDynamicBydate();
        $('#time').addClass('active');
        $('#like').removeClass('active');
    }
    //赞一赞
    $scope.changeLike = function (dynId,obj,islike) {
        if (islike != ''){
            $(obj.target).removeClass('dianzan').addClass('daidianzan');
        }else {
            $(obj.target).removeClass('daidianzan').addClass('dianzan');
        }
        $.ajax({
            url:'http://172.16.121.36/CWP/service/admin.php/home/like/changeLike/id/'+nowUserId,
            type:'post',
            data:{
                dynid:dynId,
                islike:islike,
            },
            success:function (data) {
                getDynamicBydate();
                $scope.$apply();
            },
            error:function () {

            }
        });
    }
    //踩一踩
    $scope.changeHate = function (dynId,obj,ishate) {
        if (ishate != ''){
            $(obj.target).removeClass('cai').addClass('daicai');
        }else {
            $(obj.target).removeClass('daicai').addClass('cai');
        }
        //获取登录用户的ID
        var nowUserId = localStorage.getItem('nowUserId');
        //console.log('当前用户的ID：'+nowUserId);
        $.ajax({
            url:'http://172.16.121.36/CWP/service/admin.php/home/hate/changeHate/id/'+nowUserId,
            type:'post',
            data:{
                dynid:dynId,
                ishate:ishate,
            },
            success:function (data) {
                getDynamicBydate();
                $scope.$apply();
            },
            error:function () {

            }
        });
    }
    //去我的所有动态
    $scope.goMyDynamic = function () {
        $state.go('myDynamic');
    }
    //去其他用户我的所有动态
    $scope.goOtherDynamic = function (id) {
        localStorage.setItem('otherUserId',id);
        $state.go('myDynamic');
    }
    //去关于我们
    $scope.goAboutApp = function () {
        $state.go('aboutApp');
    }
    //去设置
    $scope.goSetUp = function () {
        $state.go('setUp');
    }
    //去消息
    $scope.goMine = function () {
        $state.go('mine');
    }
    //去消息
    $scope.goAddDynamic = function () {
        $state.go('addDynamic');
    }
    //去切换皮肤
    $scope.goChangeSkin = function () {
        $state.go('changeSkin');
    }

    //踩一踩
    $scope.getobjId= function (id) {
        $scope.objId = id;
        //console.log( $scope.objId);
    }
    //看评论
    $scope.dynmicInfo = function (index) {
        var dynamics = JSON.stringify($scope.dynamics[index]);
        localStorage.setItem('dynamics', dynamics);

        $state.go('slideTab');
        // $state.go('dynaComment');
    }
    //评论
    $scope.doComment = function (index) {
        var dynamics = JSON.stringify($scope.dynamics[index]);
        localStorage.setItem('dynamics', dynamics);
        $state.go('dynaComment');

    }
    //查看大图
    $scope.goSeeImg= function (index) {
        var dynamicPic = JSON.stringify($scope.dynamics[index]);
        localStorage.setItem('dynamicPic', dynamicPic);
        $state.go('seeImg');
    }


});