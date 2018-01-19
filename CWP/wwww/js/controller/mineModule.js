angular.module('mineModule',[])
    .controller('mineCtrl',function($state,$scope,$ionicHistory,$ionicSlideBoxDelegate,$ionicPopup){
        var data = JSON.parse(localStorage.getItem('data')) ;
        var list = data.content;
        function getMyComment() {
            var id = list.userid;
            //console.log(id);
            $.ajax({
                url:'http://172.16.121.36/CWP/service/admin.php/home/dynamic/getMyComment/id/'+id,
                type:'post',
                dataType:'json',
                success:function (data) {
                    console.log(data);
                    if (data.code>0)
                    {
                        $scope.myComments = data.content;
                        console.log($scope.myComments);
                        $scope.$apply();
                    }

                },
                error:function (err) {
                    console.log('错误');
                }
            });
        }
        getMyComment();
        //获取我的评论的ID
        var dcId = $scope.dcId;
        function getMyLike() {
            var id = list.userid;
            //console.log(id);
            $.ajax({
                url:'http://172.16.121.36/CWP/service/admin.php/home/dynamic/getMyLike/id/'+id,
                type:'post',
                dataType:'json',
                success:function (data) {
                    console.log(data);
                    if (data.code>0)
                    {
                        $scope.mylikes= data.content;
                        console.log($scope.mylikes);
                        $scope.$apply();
                    }

                },
                error:function (data) {
                    console.log(data);
                }
            });
        }
        getMyLike();
        //获取评论我的数据
        function commentMyDynamic() {
            var userid = list.userid;
            //console.log(userid);
            $.ajax({
                url:'http://172.16.121.36/CWP/service/admin.php/Home/Comment/commentMyDynamic/userid/'+userid,
                type:'post',
                dataType:'json',
                success:function (data) {
                    console.log(data);
                    if (data.code>0)
                    {
                        $scope.commentsMy= data.content;
                        //console.log("接口返回评论我的数据"+$scope.commentsMy);
                        $scope.$apply();
                    }

                },
                error:function (data) {
                    //console.log(data);
                }
            });
        }
        commentMyDynamic();

        //获取点赞我的数据
        function likeMyDynamic() {
            var userid = list.userid;
            //console.log(userid);
            $.ajax({
                url:'http://172.16.121.36/CWP/service/admin.php/Home/Comment/likeMyDynamic/userid/'+userid,
                type:'post',
                dataType:'json',
                success:function (data) {
                    console.log(data);
                    if (data.code>0)
                    {
                        $scope.likesMy= data.content;
                        console.log($scope.likesMy);
                        $scope.$apply();
                    }

                },
                error:function (data) {
                    //console.log(data);
                }
            });
        }
        likeMyDynamic();

        //查看动态详细内容和具体评论
        $scope.showComMyDynamic=function (index) {
            var myComments = JSON.stringify($scope.myComments[index]);
            localStorage.setItem('myComments', myComments);
            //console.log('json转换后的我的评论数据' + myComments);
            $state.go('dynamicDetails');
        }
        //查看评论我的某一具体评论
        $scope.showMyComMyDynamic=function (index) {
            var commentsMy = JSON.stringify($scope.commentsMy[index]);
            localStorage.setItem('commentsMy', commentsMy);

            //console.log('json转换后的评论我的数据' + commentsMy);
            $state.go('dynamicComMyDetails');
        }

        //删除评论我的数据
        $scope.deleteComMy=function (index) {
            var commentsMy = JSON.stringify($scope.commentsMy[index]);
            localStorage.setItem('commentsMy', commentsMy);
            //console.log('json转换后的评论我的数据' + commentsMy);
            var data = JSON.parse(localStorage.getItem('commentsMy'));
            //console.log("需要删除的评论我的数据",data);
            var comid=data.dccomid;
           // console.log("需要删除的评论我的评论id "+comid);

            function deleteCom(comid) {
                $.ajax('http://172.16.121.36/CWP/service/admin.php/Home/Comment/deleteCom/comId/'+comid,
                    {
                        type: 'get',
                        datatype: 'json',
                        success: function (data) {
                            if (data.code > 0) {
                                //console.log($scope.comments[0]['dyncomcreatedate']);
                                commentMyDynamic();
                                $scope.$apply();//实现数据同步刷新

                                var alertPopup = $ionicPopup.alert({

                                    template: '删除成功'
                                })
                            }
                        }, error: function (data) {
                        }
                    });
            }
            //调用函数
            deleteCom(comid);

        }
        //删除我的评论数据
        $scope.deleteMyCom=function (index) {
            var commentsMy = JSON.stringify($scope.commentsMy[index]);
            localStorage.setItem('commentsMy', commentsMy);
            //console.log('json转换后的评论我的数据' + commentsMy);
            var data = JSON.parse(localStorage.getItem('commentsMy'));
            //console.log("需要删除的评论我的数据",data);
            var comid=data.dccomid;
            //console.log("需要删除的评论我的评论id "+comid);

            function deleteCom(comid) {
                $.ajax('http://172.16.121.36/CWP/service/admin.php/Home/Comment/deleteCom/comId/'+comid,
                    {
                        type: 'get',
                        datatype: 'json',
                        success: function (data) {
                            if (data.code > 0) {
                                //console.log($scope.comments[0]['dyncomcreatedate']);
                                commentMyDynamic();
                                $scope.$apply();//实现数据同步刷新

                                var alertPopup = $ionicPopup.alert({

                                    template: '删除成功'
                                })
                            }
                        }, error: function (data) {
                        }
                    });
            }
            //调用函数
            deleteCom(comid);

        }
        //删除我的评论数据
        $scope.deleteMyCom=function (index) {
            var myComments = JSON.stringify($scope.myComments[index]);
            localStorage.setItem('myComments', myComments);
            //console.log('json转换后的评论我的数据' + myComments);
            var data = JSON.parse(localStorage.getItem('myComments'));
            //console.log("需要删除的评论我的数据",data);
            var dcid=data.dcid;
            function deleteCom(dcId) {
                $.ajax('http://172.16.121.36/CWP/service/admin.php/Home/Dynamic/deleteCom/comId/'+dcId,
                    {
                        type: 'get',
                        datatype: 'json',
                        success: function (data) {
                                //console.log($scope.comments[0]['dyncomcreatedate']);
                                getMyComment();
                                $scope.$apply();//实现数据同步刷新

                                var alertPopup = $ionicPopup.alert({

                                    template: '删除成功'
                                })
                        }, error: function (data) {
                            console.log("错误");
                        }
                    });
            }
            //调用函数
            deleteCom(dcid);
        }


        $scope.initSlideTabs = {
            data:[
                {name:"我评论的",tpl:'template/slidetabs/myComment.html'},
                {name:"我赞的",tpl:'template/slidetabs/myLike.html'},
                {name:"评论我的",tpl:'template/slidetabs/commentMy.html'},
                {name:"赞我的",tpl:'template/slidetabs/likeMy.html'}
            ],//tab的内容
            doesContinue:true,//是否循环切换
            showPager:false,//是否显示小黑点
            slideInterval:4000//自动切换的时间间隔
        };
        //默认选择第一个
        $scope.slideIndex = 0;
        //滑动下面的滑块，响应上面的tabs切换
        $scope.slideChanged = function(index) {
            $scope.slideIndex = index;
        };

        //点击上面的tabs切换，响应下面的滑块滑动
        $scope.activeSlide = function (index) {
            $ionicSlideBoxDelegate.slide(index);
        };
        //去动态
        $scope.goDynamic = function () {
            $state.go('dynamic');
        }
        //去动态
        $scope.goAddDynamic = function () {
            $state.go('addDynamic');
        }
        //刷新页面
        $scope.doRefresh = function () {
            getMyLike();
            getMyComment();
            commentMyDynamic();
            likeMyDynamic();
            $scope.$broadcast("scroll.refreshComplete");
        }
});