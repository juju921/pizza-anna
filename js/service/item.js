'use strict';
app.factory('CartItems', function ($rootScope, $log) {

    var item = function (nom, prix) {
        this.setNom(nom);
        this.setPrix(prix);
    };

    item.prototype.setNom = function (nom) {
        if (nom)  this._nom = nom;
        else {
            $log.error('A name must be provided');
        }
    };

    item.prototype.setPrix = function (prix) {
        if (price) {
            if (price <= 0) {
                $log.error('A price must be over 0');
            } else {
                this._prix = (prix);
            }
        } else {
            $log.error('A price must be provided');
        }
    };
    
})
