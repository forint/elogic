define([
    'uiElement'
], function (Component) {
    'use strict';

    var checkoutConfig = window.checkoutConfig;

    return Component.extend({

        defaults: {
            template: 'Elogic_Divine/testcheckoutcomponent',
            totala:12,
            tracks:{totala:true}
        },

        initialize: function () {
            this._super();
        },

        isActive:function(){
            return true;
        }

    });
});