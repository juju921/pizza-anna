var app = angular.module('sampleapp', ['angularModalService']);

app.directive('notification', function($timeout){
    return {
        restrict: 'E',
        replace: true,
        scope: {
            ngModel: '='
        },
        template: '<div class="alert fade" bs-alert="ngModel"></div>',
        link: function(scope, element, attrs) {
            $timeout(function(){
                element.hide();
            }, 3000);
        }
    }
});


app.controller('MainCtrl', ['$scope', function ($scope) {
    $scope.fruit = "pomme";

    $scope.message = {
        "type": "info",
        "title": "Success!",
        "content": "alert directive is working pretty well with 3 sec timeout"
    };

    $scope.alerts = [];
    $scope.addAlert = function(index, type) {
        $scope.alerts.push(
            {
                "type": type,
                "title": "Success!" + index,
                "content": "alert "  + index + " directive is working pretty well with 3 sec timeout"
            }
        )

    }

}]);








