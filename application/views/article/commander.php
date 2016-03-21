<div id="body">

    <div class="wrapper">

        <flash-message duration="5000" show-close="true" on-dismiss="myCallback(flash);"></flash-message>

        <?php if ($pizza): ?>

            <h1>Commandez votre pizza en ligne !</h1>
            <div class="row-fluid"  >

                <div class="span6"  >



                        <div class="pizzas" ng-repeat="pizza in pizzas">

                            <h2>{{pizza.noms}}<?php //echo $a->noms; ?></h2>
                            <span class="prix">{{pizza.prix}}<?php //echo number_format($a->prix, 2, ',', ' '); ?>
                                €</span>


                            <p>{{pizza.ingredients}}<?php //echo $a->ingredients; ?></p>

                            <?php //foreach ($pizza as $a): ?>
                            <form class="navbar-form pull-right" action=""
                                  method="post" >
                                <input type="hidden" name="idpiz" value="{{pizza.id}}">

                                <!-- <label class="control-label">Quantité</label>

           <select name="quantite">
               <option value="1" selected="selected" >1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
           </select>-->


                                <!--  <input type="submit" value="Ajouter" class="btn btn-primary" name="valider">-->
                            </form>

                            <a class="btn btn-commande" href="<?php echo site_url('site/add/') ?>/{{pizza.id}}"
                               ng-click="popupmessages(pizza.noms);addPizza(pizza.noms, pizza.prix)"><i class="icon icon-shoppint-cart"></i>Commander</a>

                            <a class="btn btn-commande" href="#"
                               ng-click="addPizza(pizza.noms, pizza.prix)"><i class="icon icon-shoppint-cart" ></i>Commande</a>
                            <div class="clearfix"></div>
                        </div>


                    <?php //endforeach; ?>
                </div>
                <div class="span6">


                    <div id="commande">


                        <div class="rubandcommande"><h2>Votre Commande</h2>
                            

                            <ul ng-repeat="local in localStorageDemoValue" class="fade-in" >
                                <li>{{local.nom}} <button>supprimez</button> </li>
                                <li>{{local.prix}}</li>
                            </ul>


                        </div>


                    </div>


                </div>


            </div>
        <?php endif; ?>

        <div class="clearfix"></div>
    </div>
</div>