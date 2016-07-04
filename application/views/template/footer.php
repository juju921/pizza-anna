﻿﻿﻿
<footer>

    <div id="footer">
        <p><span>Remerciements à : José, Cindy, Sarah et Julien pour la vie du site internet depuis sa création
  
  
 Copyright 2013 - Tous Droits Réservés.</span></p>


        <img src="<?php echo base_url(); ?>img/patonetartisant.png" id="patonart">

    </div>

</footer>


</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>js/jquery.backstretch.js"></script>
<script>
    $.backstretch(["<?php echo base_url();?>img/bg.jpg"]);
</script>


<script src="<?php echo base_url(); ?>js/jquery-1.9.0.min.js"></script>
<script src="<?php echo base_url(); ?>js/custom.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-resource/angular-resource.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-modal-service/dst/angular-modal-service.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-sanitize/angular-sanitize.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-flash-alert/dist/angular-flash.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-sanitize/angular-sanitize.js"></script>
<script src="<?php echo base_url(); ?>node_modules/ngstorage/ngStorage.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-animate/angular-animate.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-local-storage/dist/angular-local-storage.min.js"></script>
<script src="<?php echo base_url(); ?>js/app.js"></script>
<script>
    var app = angular.module('sampleapp', ['angularModalService', 'ngFlash', 'ngAnimate', 'LocalStorageModule', 'ngResource', 'ngStorage']);
    app.config(function (localStorageServiceProvider) {
        localStorageServiceProvider
            .setPrefix('yourAppName');
    });

    app.factory("DataService", function () {

        var myCart = new shoppingCart("AngularStore");
        return {

            cart: myCart
        };
    });

    app.provider('$ngCart', function () {
        this.$get = function () {
        };
    })


    app.run(['$rootScope', 'ngCart', 'ngCartItem', 'store', function ($rootScope, ngCart, ngCartItem, store) {

        $rootScope.$on('ngCart:change', function () {
            ngCart.$save();
        });

        if (angular.isObject(store.get('cart'))) {
            ngCart.$restore(store.get('cart'));

        } else {
            ngCart.init();
        }

    }])


    app.controller('MainCtrl', ['$rootScope', '$scope', 'Flash', '$timeout', '$http', 'localStorageService', 'ngCart', '$localStorage', 'DataService', function ($rootScope, $scope, Flash, $timeout, $http, localStorageService, ngCart, $localStorage, DataService) {
        $scope.ngCart = ngCart;
        $scope.cart = DataService.cart;
        // create shopping cart

        var myCart = new shoppingCart("myCart");


        $scope.$storage = $localStorage.$default({
            "notes": []
        });


        $scope.success = function () {
            var message = '<strong>votre pizza</strong> ' +
                'à été ajouté au patnier';
            Flash.create('success', message);
        };

        $scope.pizzas = [];
        $http.get('<?php echo site_url('site/get_list');?>').success(function ($data) {
            $scope.pizzas = $data;
        });


        $scope.popupmessages = function (piz) {
            var message = '<strong>votre pizza</strong> ' + piz +
                ' à été ajouté au patnier';
            Flash.create('success', message);

        }




    }]);

</script>
<script src="<?php echo base_url(); ?>js/service/item.js"></script>
<script src="<?php echo base_url(); ?>js/shoppingCart.js"></script>
<script src="<?php echo base_url(); ?>js/service/Cart.js"></script>
<script src="<?php echo base_url(); ?>js/service/dataService.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-i18n/angular-locale_fr-fr.js"></script>
</body>
</html>
