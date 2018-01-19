angular.module('dynamicDetailsModule', []).controller('dynamicDetailsCtrl', function ($state, $scope, $ionicSlideBoxDelegate) {
    $scope.back = function (dynid) {
        $state.go('mine');

    }

    //初始化slidetabs数据
    $scope.initSlideTabs = {
        data: [
            {name: "评论", tpl: 'template/slidetab/comment.html'},
            {name: "点赞", tpl: 'template/slidetab/like.html'},
            {name: "踩", tpl: 'template/slidetab/hate.html'}
        ],//tab的内容
        doesContinue: true,//是否循环切换
        showPager: false//是否显示小黑点
        //slideInterval:200//自动切换的时间间隔
    };
    //默认选择第一个
    $scope.slideIndex = 0;
    //滑动下面的滑块，响应上面的tabs切换
    $scope.slideChanged = function (index) {
        $scope.slideIndex = index;
    };

    //点击上面的tabs切换，响应下面的滑块滑动
    $scope.activeSlide = function (index) {
        $ionicSlideBoxDelegate.slide(index);
    }

    //console.log("接收的我的评论的myComments" + localStorage.getItem('myComments'));

    var userdata = JSON.parse(localStorage.getItem('data'));

    var userid=userdata.content.userid;

    var data = JSON.parse(localStorage.getItem('myComments'));

    $scope.myComments = data;

    var dynId = $scope.myComments.dynid;

    //console.log("请求需要的ID "+ dynId);

    function getComments(dynId) {
        $.ajax('http://localhost/CWP/service/admin.php/Home/Comment/getDynComment/dynId/' + dynId,
            {
                type: 'get',
                datatype: 'json',
                success: function (data) {
                    if (data.code > 0) {
                        $scope.comments = data.content;
                        //console.log("接口返回的评论"+$scope.comments);

                        $scope.$apply();//实现数据同步刷新
                    }

                }, error: function (data) {

            }

            });
    }

//调用函数

    getComments(dynId);

//请求点赞的数据
    function getLikeDynamic(dynId) {
        $.ajax('http://localhost/CWP/service/admin.php/Home/Comment/getLikeDynamic/dynId/' + dynId,
            {
                type: 'get',
                datatype: 'json',
                success: function (data) {
                    if (data.code > 0) {
                        $scope.likeLists = data.content;
                        //console.log($scope.likeLists);

                        $scope.$apply();//实现数据同步刷新
                    }

                }, error: function (data) {

            }

            });
    }

    getLikeDynamic(dynId);

    //请求踩的数据
    function getHateDynamic(dynId) {
        $.ajax('http://localhost/CWP/service/admin.php/Home/Comment/getHateDynamic/dynId/' + dynId,
            {
                type: 'get',
                datatype: 'json',
                success: function (data) {
                    if (data.code > 0) {
                        $scope.hateLists = data.content;
                        //console.log($scope.hateLists);
                        $scope.$apply();//实现数据同步刷新
                    }

                }, error: function (data) {

            }

            });
    }

    getHateDynamic(dynId);
    //跳转评论的页面
    $scope.showComThisUser = function (userid) {
        localStorage.setItem('cid', userid);
        $state.go('dynamic');
    }
    //跳转点赞的页面
    $scope.showLikeThisUser = function (userid) {
        localStorage.setItem('cid', userid);
        $state.go('dynamic');
    }
//跳转踩的页面
    $scope.showHateThisUser = function (userid) {
        localStorage.setItem('cid', userid);
        $state.go('dynamic');
    }
})


