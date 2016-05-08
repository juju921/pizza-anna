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

    var app = angular.module('sampleapp', ['angularModalService', 'ngFlash', 'ngAnimate','LocalStorageModule','ngResource','ngStorage']);
    app.config(function (localStorageServiceProvider) {
        localStorageServiceProvider
            .setPrefix('yourAppName');
    });

	app.provider('$ngCart', function () {
		this.$get = function () {
		};
	})

	app.run(['$rootScope', 'ngCart','ngCartItem', 'store', function ($rootScope, ngCart, ngCartItem, store) {

			$rootScope.$on('ngCart:change', function(){
				ngCart.$save();
			});

			if (angular.isObject(store.get('cart'))) {
				ngCart.$restore(store.get('cart'));

			} else {
				ngCart.init();
			}

		}])





	app.controller('MainCtrl', ['$rootScope', '$scope', 'Flash', '$timeout','$http','localStorageService','ngCart','$localStorage', function ($rootScope, $scope, Flash, $timeout,$http,localStorageService,ngCart,$localStorage) {
        $scope.ngCart = ngCart;

		$scope.$storage = $localStorage.$default({
			"notes": []
		});




		$scope.success = function () {
            var message = '<strong>votre pizza</strong> ' +
                  'à été ajouté au patnier';
            Flash.create('success', message);
        };

        $scope.pizzas = [];
       $http.get('<?php echo site_url('site/get_list');?>').success(function($data){
            $scope.pizzas = $data;
        });


        $scope.popupmessages = function (piz) {
            var message = '<strong>votre pizza</strong> ' + piz +
                ' à été ajouté au patnier';
            Flash.create('success', message);

        }

        $scope.pizza = [];
		$scope.addItem = function (id, name, name, quantity, data) {
			//var inCart = this.getItemById(id);
			if (typeof inCart === 'object'){
				//Update quantity of an item if it's already in the cart
				inCart.setQuantity(quantity, false);
				$rootScope.$broadcast('ngCart:itemUpdated', inCart);
			} else {
				$scope.$storage.notes.push({
					"id": id,
					"name": name,
					"qt": quantity,
					"data": data
				});

				$scope.pizzas = $localStorage.notes;

				//$rootScope.$broadcast('ngCart:itemAdded', newItem);
			}
			$rootScope.$broadcast('ngCart:change', {});
		};
        /*$scope.addPizza = function(nom, prix, id){

            var tabpizza = {
                nom: nom,
                prix: prix,
                id: id

            };
            $scope.pizza.push(tabpizza);
            console.log($scope.pizza);
            $scope.saveItems($scope.pizza);
            localStorageService.set('localStorageDemo', $scope.pizza);
            $scope.localStorageDemoValue = localStorageService.get('localStorageDemo');


        };*/

        $scope.deletePizza = function(noms){
            console.log(noms);
            var index = $scope.pizza.indexOf(noms)
            $scope.pizza.splice(index,1);
        };

        $scope.saveItems = function (pizza) {
            if (localStorage !== null && JSON !== null) {
                localStorage['moncadie_items'] = JSON.stringify($scope.pizza);

            }
        };

        $scope.deleteThispizza =  function (id) {
            return localStorageService.remove(id);


        };

        /*$scope.addItem = function (noms, prix, id, q) {
            var tabpizza = {
                nom: noms,
                prix: prix,
                id: id,
                qt : q
            };
            $scope.pizza.push(tabpizza);
            //console.log(tabpizza);
            $rootScope.$broadcast('ngCart:change', {});
        };*/




      


	}]);
    
</script>
<script src="<?php echo base_url(); ?>js/service/item.js"></script>
<script src="<?php echo base_url(); ?>js/service/panier.js"></script>
<script src="<?php echo base_url(); ?>js/service/Cart.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-i18n/angular-locale_fr-fr.js"></script>
</body>
</html>
