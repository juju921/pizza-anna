var app = angular.module('sampleapp', ['angularModalService','ngFlash', 'ngAnimate']);




app.controller('MainCtrl', ['$rootScope', '$scope', 'Flash', '$timeout', function ($rootScope, $scope, Flash, $timeout) {




        $scope.success = function() {
        var message = '<strong>votre pizza</strong> à été ajouté au patnier';
        Flash.create('success', message);
    };


}]);








