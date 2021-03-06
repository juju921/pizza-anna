'use strict';


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

app.service('ngCart', ['$rootScope', '$window', 'ngCartItem', 'store', function ($rootScope, $window, ngCartItem, store) {

	this.init = function () {
		this.$cart = {
			items: []
		};
	};

	this.addItem = function (id, name, price, quantity, q, data) {
		var inCart = this.getItemById(id);
		if (typeof inCart === 'object') {
			//Update quantity of an item if it's already in the cart
			inCart.setQuantity(quantity, false);
			$rootScope.$broadcast('ngCart:itemUpdated', inCart);
		} else {
			var newItem = new ngCartItem(id, name, price, quantity, data);
			this.$cart.items.push(newItem);
			console.log(newItem);
			$rootScope.$broadcast('ngCart:itemAdded', newItem);
		}

		$rootScope.$broadcast('ngCart:change', {});
	};

	this.getItemById = function (itemId) {
		var items = this.getCart().items;
		var build = false;

		angular.forEach(items, function (item) {

			if (item.getId() === itemId) {
				build = item;
			}
		});
		return build;
	};


	this.setCart = function (cart) {
		this.$cart = cart;
		return this.getCart();
	};

	this.getCart = function () {
		return this.$cart;
	};

	this.getItems = function () {
		return this.getCart().items;
	};

	this.getTotalItems = function () {
		var count = 0;
		var items = this.getItems();
		angular.forEach(items, function (item) {
			count += item.getQuantity();
		});
		return count;

	};

	this.getTotalUniqueItems = function () {
		return this.getCart().items.length;
	};

	this.getSubTotal = function () {
		var total = 0;
		angular.forEach(this.getCart().items, function (item) {
			total += item.getTotal();
		});
		return +parseFloat(total).toFixed(2);
	};

	this.totalCost = function () {
		return +parseFloat(this.getSubTotal()).toFixed(2);
	};

	this.removeItem = function (index) {
		var item = this.$cart.items.splice(index, 1)[0] || {};
		$rootScope.$broadcast('ngCart:itemRemoved', item);
		$rootScope.$broadcast('ngCart:change', {});

	};

	this.removeItemById = function (id) {
		var item;
		var cart = this.getCart();
		angular.forEach(cart.items, function (item, index) {
			if (item.getId() === id) {
				item = cart.items.splice(index, 1)[0] || {};
			}
		});
		this.setCart(cart);
		$rootScope.$broadcast('ngCart:itemRemoved', item);
		$rootScope.$broadcast('ngCart:change', {});
	};

	this.empty = function () {

		$rootScope.$broadcast('ngCart:change', {});
		this.$cart.items = [];
		$window.localStorage.removeItem('cart');
	};

	this.isEmpty = function () {

		return (this.$cart.items.length > 0 ? false : true);

	};

	this.toObject = function () {

		if (this.getItems().length === 0) return false;

		var items = [];
		angular.forEach(this.getItems(), function (item) {
			items.push(item.toObject());
		});

		return {
			subTotal: this.getSubTotal(),
			totalCost: this.totalCost(),
			items: items
		}
	};


	this.$restore = function (storedCart) {
		var _self = this;
		_self.init();


		angular.forEach(storedCart.items, function (item) {
			_self.$cart.items.push(new ngCartItem(item._id, item._name, item._price, item._quantity, item._data));
		});
		this.$save();
	};

	this.$save = function () {
		return store.set('cart', JSON.stringify(this.getCart()));
	}

}])

app.factory('ngCartItem', ['$rootScope', '$log', function ($rootScope, $log) {

	var item = function (id, name, price, quantity, data) {
		this.setId(id);
		this.setName(name);
		this.setPrice(price);
		this.setQuantity(quantity);
		this.setData(data);
	};


	item.prototype.setId = function (id) {
		if (id)  this._id = id;
		else {
			$log.error('An ID must be provided');
		}
	};

	item.prototype.getId = function () {
		return this._id;
	};


	item.prototype.setName = function (name) {
		if (name)  this._name = name;
		else {
			$log.error('A name must be provided');
		}
	};
	item.prototype.getName = function () {
		return this._name;
	};

	item.prototype.setPrice = function (price) {
		var priceFloat = parseFloat(price);
		if (priceFloat) {
			if (priceFloat <= 0) {
				$log.error('A price must be over 0');
			} else {
				this._price = (priceFloat);
			}
		} else {
			$log.error('A price must be provided');
		}
	};
	item.prototype.getPrice = function () {
		return this._price;
	};


	item.prototype.setQuantity = function (quantity, relative) {

		var quantityInt = parseInt(quantity);

		if (quantityInt % 1 === 0) {
			if (relative === true) {
				this._quantity += quantityInt;
			} else {
				this._quantity = quantityInt;
			}
			if (this._quantity < 1) this._quantity = 1;

		} else {
			this._quantity = 1;
			$log.info('Quantity must be an integer and was defaulted to 1');
		}

	};

	item.prototype.getQuantity = function () {
		return this._quantity;
	};

	item.prototype.setData = function (data) {
		if (data) this._data = data;
	};

	item.prototype.getData = function () {
		if (this._data) return this._data;
		else $log.info('This item has no data');
	};


	item.prototype.getTotal = function () {
		return +parseFloat(this.getQuantity() * this.getPrice()).toFixed(2);
	};

	item.prototype.toObject = function () {
		return {
			id: this.getId(),
			name: this.getName(),
			price: this.getPrice(),
			quantity: this.getQuantity(),
			data: this.getData(),
			total: this.getTotal()
		}
	};

	return item;

}])

app.service('store', ['$window', function ($window) {

	return {

		get: function (key) {
			if ($window.localStorage.getItem(key)) {
				var cart = angular.fromJson($window.localStorage.getItem(key));
				return JSON.parse(cart);
			}
			return false;

		},


		set: function (key, val) {

			if (val === undefined) {
				$window.localStorage.removeItem(key);
			} else {
				$window.localStorage.setItem(key, angular.toJson(val));
			}
			return $window.localStorage.getItem(key);

		}

	}
}])

  