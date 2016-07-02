<div id="body">
    <div class="wrapper">
        <flash-message duration="5000" show-close="true" on-dismiss="myCallback(flash);"></flash-message>
        <?php if ($pizza): ?>
            <h1>Commandez votre pizza en ligne !</h1>
            <div class="row-fluid">
                <div class="span6">
                    <div class="pizzas" ng-repeat="pizza in pizzas">
                        <h2>{{pizza.noms}}<?php //echo $a->noms; ?></h2>
                        <span class="prix">{{pizza.prix}}<?php //echo number_format($a->prix, 2, ',', ' '); ?>€</span>
                        <p>{{pizza.ingredients}}<?php //echo $a->ingredients; ?></p>
                        <?php //foreach ($pizza as $a): ?>
                        <?php echo form_open('site/add/'); ?>
                        <input type="hidden" name="idpiz" value="{{pizza.id}}">
                        <select name="quantity" id="quantity" ng-model="q" data="item" ng-init="q='1'">
                            <option value="1" ng-selected="true">1</option>
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
                        <!--<a class="btn btn-sm btn-primary macommande">Ajouter</a>-->
                        <input TYPE="submit" NAME="nom" VALUE="Ajouter"
                               ng-click="cart.addItem(pizza.id,pizza.noms, pizza.prix, q);success();"
                               class="btn btn-sm btn-primary">
                        <a href="#"
                           ng-click="addItem(pizza.id,pizza.noms, pizza.prix, q, data); success(); cart.addItem(pizza.id,pizza.noms, pizza.prix, q);"
                           class="btn btn-sm btn-primary">ajouter</a>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                    <?php //endforeach; ?>
                </div>
                <div class="span6">
                    <div id="commande">
                        <div class="rubandcommande"><h2>Votre Commande</h2>
                            total :{{cart.getTotalCount()}}
                            <?php echo form_open('site/add/'); ?>
                            <ul ng-repeat="item in ngStorage-notes">
                                <span>{{ item.nom }}</span>
                            </ul>
                            <ul ng-repeat="item in ngCart.getCart().items track by $index"
                                class="col-md-7 col-sm-12 text-left">
                                <span>
							<pre>{{ item._quantity | number }}</pre>
                                <span>{{ item.getName() }}</span>
                                <span><span class="fa fa-minus" ng-class="{'disabled':item.getQuantity()==1}"
                                            ng-click="item.setQuantity(-1, true)"></span>&nbsp;&nbsp;
                                    {{ item.getQuantity() | number }}&nbsp;&nbsp;
                                    <span class="fa fa-plus" ng-click="item.setQuantity(1, true)"></span></span>
									<span ng-click="ngCart.removeItemById(item.getId())"
                                          class="icon-white icon-trash"></span></span>
                                <pre>{{item.getQuantity()}}</pre>
                            </ul>
                            </form>
                            <span>{{ ngCart.totalCost() | currency }}</span>
                            <ul>
                                <li ng-repeat="item in data">
                                    <div>
                                        id:{{ item.id }}
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary"
                                                        ng-click="increment(item);"><i
                                                        class=" glyphicon glyphicon-menu-up"></i></button>
                                                <button type="button" class="btn btn-" style="width:55px;">{{ item.quan
                                                    }}
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                        ng-click="decrement(item);"><i
                                                        class=" glyphicon glyphicon-menu-down"></i></button>
                                            </div>
                                        </div>
                                        <div>price:{{item.price * item.quan}}</div>
                                    </div>
                                </li>
                            </ul>
                            <ul ng-repeat="item in moncadipizzas">
                                <li>{{item.name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>