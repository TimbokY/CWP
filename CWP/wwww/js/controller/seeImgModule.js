angular.module('seeImgModule',[]).controller('seeImgCtrl',function($state,$scope){
    var dynamicPic = JSON.parse(localStorage.getItem('dynamicPic'));
    console.log(dynamicPic);
    $scope.pic = dynamicPic;
    $scope.goDynamic = function () {
        $state.go('dynamic');
    }
});