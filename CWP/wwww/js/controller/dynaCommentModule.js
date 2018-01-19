angular.module('dynaCommentModule', []).controller('dynaCommentCtrl', function ($state, $scope, $ionicPopup) {

    $scope.send = function () {
        if ($scope.writeComment == null) {
            var alertPopup = $ionicPopup.alert({

                template: '评论不能为空'
            })


        } else {
            var comment = $scope.writeComment;
            //var dynId = localStorage.getItem('dynid');
            var data = JSON.parse(localStorage.getItem('data'));
            var userid = data.content.userid;

            var dynamic = JSON.parse(localStorage.getItem('dynamics'));
            //console.log(dynamic);
            var dynId = dynamic.dynid;


            $.ajax({
                url: 'http://172.16.121.36/CWP/service/admin.php/Home/Comment/saveComment',
                type: 'post',
                data: {
                    dynId: dynId,
                    comment: comment,
                    userid:userid
                },
                success: function (data) {


                },
                error: function () {

                }
            });

//         }
//
// //调用函数
//
//         saveComments(dynId,comment);
            $state.go('slideTab');

        }
    }
    $scope.comeBack = function () {

        $state.go('dynamic');
    }
});