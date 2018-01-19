angular.module('fankuiModule', []).controller('fankuiCtrl', function ($state,$ionicPopup, $scope) {

    $scope.fankuiback = function () {
        $state.go("aboutApp");
    }

    $scope.fasong = function () {

        $scope.wenzi = $(".wenben").val();
        $scope.xuanze = $(".xuanze").find("option:selected").text();
        $scope.number = $(".num").val();
        $.ajax({
            url: 'http://172.16.121.36/CWP/service/admin.php/Home/Apply/index',
            type: 'post',
            dataType: 'json',
            data: {
                applycontent: $scope.wenzi,
                keyword: $scope.xuanze,
                number: $scope.number
            },
            success: function (data) {
              if(data.code>0){
                  $ionicPopup.alert({
                      title: '发送',
                      template: '发送成功！'
                  });
              }
            }
        });

    }
});