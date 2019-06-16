/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'underscore',
    'Magento_UI/js/form/form',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
    'mageUtils'
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
        visible: ko.observable(false),
        /**
         * @return {Boolean}
         */
        isVisible: function () {
            return this.visible;
        },
        /**
         * @return {exports}
         */
        initialize: function () {

            this._super();

            stepNavigator.registerStep(
                'confirm',
                null,
                $t('Confirm'),
                this.visible,
                _.bind(this.navigate, this),
                30
            );

            var self = this;
            /*this.responseData.subscribe(function(data){
                self.customers(data.customers);
            });*/

            return this;
        },

        initObservable: function() {
            return this._super();
        },
        /**
         * Navigator change hash handler.
         *
         * @param {Object} step - navigation step
         */
        navigate: function (step) {
            step && step.isVisible(true);
        },
        nextAction: function() {
            stepNavigator.next();
        }
    });
});
