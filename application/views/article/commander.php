<div id="body">

    <div class="wrapper">

        <flash-message duration="5000" show-close="true" on-dismiss="myCallback(flash);"></flash-message>

        <?php if ($pizza): ?>

            <h1>Commandez votre pizza en ligne !</h1>
            <div class="row-fluid">

                <div class="span6">


                    <div class="pizzas" ng-repeat="pizza in pizzas">

                        <h2>{{pizza.noms}}<?php //echo $a->noms; ?></h2>
                            <span class="prix">{{pizza.prix}}<?php //echo number_format($a->prix, 2, ',', ' '); ?>
                                €</span>


                        <p>{{pizza.ingredients}}<?php //echo $a->ingredients; ?></p>

                        <?php //foreach ($pizza as $a): ?>
                        <form class="navbar-form pull-right" action=""
                              method="post">
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
                           ng-click="popupmessages(pizza.noms);addPizza(pizza.noms, pizza.prix, pizza.id)"><i
                                class="icon icon-shoppint-cart"></i>Commander</a>

                      <!--  <a class="btn btn-commande" href="#"
                           ng-click="addPizza(pizza.noms, pizza.prix,pizza.id)"><i class="icon icon-shoppint-cart"></i>Commande</a>-->


                        <select name="quantity" id="quantity" ng-model="q" data="item">
                            <option value="1" ng-selected="1" >1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>

                        <a class="btn btn-sm btn-primary macommande"
                           href="<?php echo site_url('site/add/') ?>/{{pizza.id}}"
                           ng-click="ngCart.addItem(pizza.id,pizza.noms, pizza.prix,q,data)"
                           >Ajouter</a>


                        <div class="clearfix"></div>
                    </div>


                    <?php //endforeach; ?>
                </div>
                <div class="span6" >


                    <div id="commande">


                        <div class="rubandcommande"><h2>Votre Commande</h2>


                            <ul ng-repeat="local in localStorageDemoValue" class="fade-in">
                                <li>{{local.nom}}
                                    <button ng-click="deletePizza(localStorageDemoValue.noms)">supprimez</button>
                                </li>
                                <li>{{local.prix}}</li>
                                <li>{{local.id}}</li>
                                <a href="#" ng-click="deleteThispizza(local.id)">{{local.id}}</a>



                            </ul>


                            <ul ng-repeat="item in ngCart.getCart().items track by $index">
                                <li><span ng-click="ngCart.removeItemById(item.getId())" class="icon-white icon-trash"></span></li>

                                <li>{{ item.getName() }}</li>
                                <li><span class="fa fa-minus" ng-class="{'disabled':item.getQuantity()==1}"
                                          ng-click="item.setQuantity(-1, true)"></span>&nbsp;&nbsp;
                                    {{ item.getQuantity() | number }}&nbsp;&nbsp;
                                    <span class="fa fa-plus" ng-click="item.setQuantity(1, true)"></span></li>

                            </ul>

                            <span>{{ ngCart.totalCost() | currency }}</span>




                        </div>


                    </div>


                </div>


            </div>
        <?php endif; ?>

        <div class="clearfix"></div>
    </div>
</div>