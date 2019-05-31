/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'underscore',
    'uiComponent',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
    'MageUtils'
], function (
    $,
    _,
    Component,
    ko,
    stepNavigator,
    $t,
    utils
) {
    'use strict';

    return Component.extend({
        defaults: {
            customers: [],
            listens: {
                responseData: 'updateCustomersList',
                request: 'searchRequest'
            }
        },
        visible: ko.observable(!quote.isVirtual()),

        /**
         * @return {exports}
         */
        initialize: function () {

            this._super();

            if (!quote.isVirtual()) {
                stepNavigator.registerStep(
                    'customer',
                    null,
                    $t('Customer'),
                    this.visible,
                    _.bind(this.navigate, this),
                    10
                );
            }

            var self = this;
            this.initCustomerList();
            /*this.responseData.subscribe(function(data){
                self.customers(data.customers);
            });*/

            return this;
        },

        initCustomerList: function(data){
            data = data || {};
            utils.ajaxSubmit({
                url: this.customersListUrl,
                data: data
            }, {
                ajaxSaveType: 'default',
                response: {
                    data: this.responseData,
                    status: this.responseStatus
                }
            });
        },
        initObservable: function() {
           return this._super()
               .observe([
                   'responseData',
                   'responseStatus',
                   'customers',
                   'request'
               ]);
        },
        updateCustomersList: function(data) {
            debugger;
            this.customers(data.customers);
        },
        chooseCustomer: function(customer) {
            console.log('------- Customer ID --------');
            console.log(customer.id);
            console.log('------- Customer ID --------');
        },
        searchRequest: function(request) {
            this.initCustomerList({q:request});
        },
        /**
         * Navigator change hash handler.
         *
         * @param {Object} step - navigation step
         */
        navigate: function (step) {
            step && step.isVisible(true);
        }
    });
});
