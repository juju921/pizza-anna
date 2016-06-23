'use strict';

app.factory("DataService", function () {

    var myCarts = new shoppingCart("PizzaAnna");

    return {
        cart: myCarts
    };
});

