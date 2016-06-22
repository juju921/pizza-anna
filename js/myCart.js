'use strict';

function myCart (cartName) {
	this.cartName = cartName;
	this.clearCart = false;
	this.checkoutParameters = {};
	this.items = [];

	// load items from local storage when initializing
	this.loadItems ();

	// save items to local storage when unloading
	var self = this;
	$(window).unload (function () {
		if (self.clearCart) {
			self.clearItems ();
		}
		self.saveItems ();
		self.clearCart = false;
	});
}

// load items from local storage
myCart.prototype.loadItems = function () {
    var items = localStorage != null ? localStorage[this.cartName + "_items"] : null;
	if (items != null && JSON != null) {
		try {
			var items = JSON.parse (items);
			for (var i = 0; i < items.length; i++) {
				var item = items[i];
				if (item.sku != null && item.name != null && item.price != null && item.quantity != null) {
					item = new cartItem (item.sku, item.name, item.price, item.quantity);
					this.items.push (item);
				}
			}
		}
		catch (err) {
			// ignore errors while loading...
		}
	}
}

// save items to local storage
myCart.prototype.saveItems = function () {
	if (localStorage != null && JSON != null) {
		localStorage[this.cartName + "_items"] = JSON.stringify (this.items);
	}
}

// adds an item to the cart
myCart.prototype.addItem = function (id, name, price, quantity) {
	quantity = this.toNumber (quantity);
	if (quantity != 0) {

		// update quantity for existing item
		var found = false;
		for (var i = 0; i < this.items.length && !found; i++) {
			var item = this.items[i];
			if (item.sku == sku) {
				found = true;
				item.quantity = this.toNumber (item.quantity + quantity);
				if (item.quantity <= 0) {
					this.items.splice (i, 1);
				}
			}
		}

		// new item, add now
		if (!found) {
			var item = new cartItem (id, name, price, quantity);
			this.items.push (item);
		}

		// save changes
		this.saveItems ();
	}
}

// get the total price for all items currently in the cart
myCart.prototype.getTotalPrice = function (id) {
	var total = 0;
	for (var i = 0; i < this.items.length; i++) {
		var item = this.items[i];
		if (id == null || item.sku == id) {
			total += this.toNumber (item.quantity * item.price);
		}
	}
	return total;
}

// get the total price for all items currently in the cart
myCart.prototype.getTotalCount = function (id) {
	var count = 0;
	for (var i = 0; i < this.items.length; i++) {
		var item = this.items[i];
		if (id == null || item.id == id) {
			count += this.toNumber (item.quantity);
		}
	}
	return count;
}

// clear the cart
shoppingCart.prototype.clearItems = function () {
	this.items = [];
	this.saveItems ();
}


myCart.prototype.toNumber = function (value) {
	value = value * 1;
	return isNaN (value) ? 0 : value;
}


//----------------------------------------------------------------
// items in the cart
//
function cartItem (id, name, price, quantity) {
	this.id = id;
	this.name = name;
	this.price = price * 1;
	this.quantity = quantity * 1;
}



