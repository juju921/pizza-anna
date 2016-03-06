<footer>

    <div id="footer">
        <p><span>Remerciements à : José, Cindy, Sarah et Julien pour la vie du site internet depuis sa création
  
  
 Copyright 2013 - Tous Droits Réservés.</span></p>


        <img src="<?php echo base_url(); ?>img/patonetartisant.png" id="patonart">

    </div>

    <?php echo site_url('site/ajax_load_data'); ?>
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
<script src="<?php echo base_url(); ?>node_modules/angular-modal-service/dst/angular-modal-service.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-flash-alert/dist/angular-flash.min.js"></script>
<script src="<?php echo base_url(); ?>node_modules/angular-animate/angular-animate.min.js"></script>
<script src="<?php echo base_url(); ?>js/app.js"></script>
<script>

    var app = angular.module('sampleapp', ['angularModalService', 'ngFlash', 'ngAnimate']);


    app.controller('MainCtrl', ['$rootScope', '$scope', 'Flash', '$timeout','$http', function ($rootScope, $scope, Flash, $timeout,$http) {

        $scope.success = function () {
            var message = '<strong>votre pizza</strong> ' +
                pizza.noms+   'à été ajouté au patnier';
            Flash.create('success', message);
        };

        $scope.pizzas = [];
        $http.get('<?php echo site_url('site/get_list');?>').success(function($data){ $scope.pizzas=$data;  });




    }]);



</script>

</body>
</html>
