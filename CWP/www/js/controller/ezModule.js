angular.module('ezModule',[]).controller('ezCtrl',function($state,$scope){
    $state.go('login');
});