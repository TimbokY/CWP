angular.module('announceModule',[])
    .controller('announceCtrl',function($state,$scope){
        $scope.goBack = function () {
            $state.go('dynamic');
        }
        $scope.ann = JSON.parse(localStorage.getItem('announce'));

});