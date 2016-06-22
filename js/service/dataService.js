'use strict';

storeApp.factory("DataService", function() {

	var myCart = new shoppingCart("myCart");

	return {
		cart: myCart
	};
});