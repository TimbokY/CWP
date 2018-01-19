angular.module('myDynamicModule',[])
    .controller('myDynamicCtrl',function($state,$scope,$ionicHistory,$ionicPopup){
    $scope.goback = function () {
        $state.go('dynamic');
    }
    //去资料卡
    $scope.goOtherCenter = function () {
        $state.go('otherCenter');
    }
    $scope.delete = function (id) {
        $.ajax({
            url:'http://localhost/CWP/service/admin.php/home/dynamic/deleteDynamic/id/'+id,
            type:'post',
            success:function(data){
                
            },
            error:function (data) {
                
            }
        })
    }
        //展示动态列表
        var otherUserId = localStorage.getItem('otherUserId');
        console.log('otherUserId'+otherUserId);
        function getOtherDynamic() {
            $.ajax({
                url:'http://localhost/CWP/service/admin.php/home/dynamic/getMyDynamic/id/'+otherUserId,
                type:'post',
                dataType:'json',
                success:function (data) {
                    //console.log(data);
                    if (data.code>0)
                    {
                        var nowUserId = localStorage.getItem('nowUserId');
                        $scope.nowUserId = nowUserId;
                        $scope.mydynamics = data.content;
                        $scope.$apply();
                    }

                },
                error:function (data) {
                    console.log(data);
                }
            });
        }
        getOtherDynamic();
        //删除
        $scope.delete = function (id) {
            var confirmPopup = $ionicPopup.confirm({
                title: '提示',
                template: '确认删除？'
            });
            confirmPopup.then(function(res) {
                if(res) {
                    $.ajax({
                        url:'http://localhost/CWP/service/admin.php/home/dynamic/deleteDynamic/id/'+id,
                        type:'post',
                        success:function(){
                            getOtherDynamic();
                            $scope.$apply();
                        },
                        error:function (data) {
                            console.log('错误');
                        }
                    })
                } else {
                    //console.log('You are not sure');
                }
            });
        }
        $scope.changeHate = function (dynId,obj,ishate) {
            if (ishate != ''){
                $(obj.target).removeClass('cai').addClass('daicai');
            }else {
                $(obj.target).removeClass('daicai').addClass('cai');
            }
            $.ajax({
                url:'http://localhost/CWP/service/admin.php/home/hate/changeHate/id/'+otherUserId,
                type:'post',
                data:{
                    dynid:dynId,
                    ishate:ishate,
                },
                success:function (data) {
                    getOtherDynamic();
                    $scope.$apply();
                },
                error:function () {

                }
            });
        }
        $scope.changeLike = function (dynId,obj,islike) {
            if (islike!=''){
                $(obj.target).removeClass('dianzan').addClass('daidianzan');
            }else {
                $(obj.target).removeClass('daidianzan').addClass('dianzan');
            }
            $.ajax({
                url:'http://localhost/CWP/service/admin.php/home/like/changeLike/id/'+otherUserId,
                type:'post',
                data:{
                    dynid:dynId,
                    islike:islike,
                },
                success:function (data) {
                    getOtherDynamic();
                    $scope.$apply();
                },
                error:function () {

                }
            });
        }
        //去看评论
        $scope.showOtherUserDynamic = function (index) {
            var mydynamics = JSON.stringify($scope.mydynamics[index]);
            localStorage.setItem('mydynamics', mydynamics);
            //console.log('json转换后的数据mydynamics:' + mydynamics);
            $state.go('otherUserDynamic');
        }

    });