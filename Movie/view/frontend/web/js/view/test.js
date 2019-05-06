define([
    'jquery',
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
], function ($, ko, Component, urlBuilder,storage) {
    'use strict';
    var id=1;

    return Component.extend({

        defaults: {
            template: 'Magenest_Movie/test',
        },

        productList: ko.observableArray([]),

        getProduct: function () {
            var self = this;
            var serviceUrl = urlBuilder.build('movie/test/product?id='+id);
            id ++;
            return storage.post(
                serviceUrl,
                ''
            ).done(
                function (response) {
                    if (!$.isEmptyObject(response))
                        self.productList.push(JSON.parse(response));
                }
            ).fail(
                function (response) {
                }
            );
        },

    });
});