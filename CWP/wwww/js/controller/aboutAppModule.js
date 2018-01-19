angular.module('aboutAppModule',[]).controller('aboutAppCtrl',function($state,$scope){
    $scope.goPersonSideMenu = function () {
        $state.go('dynamic');
    }
    //去反馈界面
    $scope.gofankui = function () {
        $state.go('fankui');
    }
});