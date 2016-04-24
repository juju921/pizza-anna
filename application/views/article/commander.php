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
                        <?php echo form_open('site/add/'); ?>
                            <input type="hidden" name="idpiz" value="{{pizza.id}}">

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


							<a class="btn btn-sm btn-primary macommande">Ajouter</a>
                        <input TYPE="submit" NAME="nom" VALUE="texte du bouton" ng-click="ngCart.addItem(pizza.id,pizza.noms, pizza.prix,q,data)">


                        </form>






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