// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic','ezModule','loginModule','registerModule','dynamicModule','personalCenterModule',
'ionic-citypicker','aboutAppModule','mineModule','setUpModule','addDynamicModule','myDynamicModule','fankuiModule',
'changeSkinModule','slideTabModule','dynaCommentModule','otherCenterModule','dynamicComMyDetailsModule',
'seeImgModule','otherUserDynamicModule','announceModule'])

.run(function($ionicPlatform) {
    $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
}).config(function($stateProvider,$urlRouterProvider,$ionicConfigProvider){
	$ionicConfigProvider.platform.android.navBar.alignTitle('center'); 
  $stateProvider
  .state("login",{
    cache:false,
    templateUrl:"template/login.html",
    controller:"loginCtrl"
  })
  .state("register",{
      cache:false,
      templateUrl:"template/register.html",
      controller:"registerCtrl"
  })
  .state("dynamic",{
      cache:false,
      templateUrl:"template/dynamic.html",
      controller:"dynamicCtrl"
  })
  .state("addDynamic",{
      cache:false,
      templateUrl:"template/addDynamic.html",
      controller:"addDynamicCtrl"
  })
  .state("mine",{
      cache:false,
      templateUrl:"template/mine.html",
      controller:"mineCtrl"
  })
  .state("personalCenter",{
      cache:false,
      templateUrl:"template/personalCenter.html",
      controller:"personalCenterCtrl"
  })
  .state("setUp",{
      cache:false,
      templateUrl:"template/setUp.html",
      controller:"setUpCtrl"
  })
  .state("myDynamic",{
      cache:false,
      templateUrl:"template/myDynamic.html",
      controller:"myDynamicCtrl"
  })
  .state("aboutApp",{
      cache:false,
      templateUrl:"template/aboutApp.html",
      controller:"aboutAppCtrl"
  })
  .state("fankui",{
      cache:false,
      templateUrl:"template/fankui.html",
      controller:"fankuiCtrl"
  })
    .state("changeSkin",{
    cache:false,
    templateUrl:"template/changeSkin.html",
    controller:"changeSkinCtrl"
    })
  .state("slideTab",{
      cache: false,
      templateUrl:"template/slideTab.html",
      controller:"slideTabCtrl"
  })
  .state("dynaComment",{
      cache: false,
      templateUrl:"template/dynaComment.html",
      controller:"dynaCommentCtrl"
  })
    .state("otherCenter",{
      cache: false,
      templateUrl:"template/otherCenter.html",
      controller:"otherCenterCtrl"
    })
  .state("dynamicDetails",{
      cache: false,
      templateUrl:"template/dynamicDetails.html",
      controller:"dynamicDetailsCtrl"
  })
  .state("dynamicComMyDetails",{
      cache: false,
      templateUrl:"template/dynamicComMyDetails.html",
      controller:"dynamicComMyDetailsCtrl"
  })
  .state("seeImg",{
      cache: false,
      templateUrl:"template/seeImg.html",
      controller:"seeImgCtrl"
  })
  .state("otherUserDynamic",{
      cache: false,
      templateUrl:"template/otherUserDynamic.html",
      controller:"otherUserDynamicCtrl"
  })
  .state("announce",{
      cache: false,
      templateUrl:"template/announce.html",
      controller:"announceCtrl"
  })



})
