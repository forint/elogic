define([
    'underscore',
    'Magento_Ui/js/grid/columns/select'
], function (_, Element) {
    'use strict';

    console.log('--------------- Calling Custom Select ---------------');
    return Element.extend({
        defaults: {
            additionalCustomClass: '',
            customClasses: {
                0: 'red',
                1: 'green'
            },
            bodyTmpl: 'Elogic_Divine/grid/cells/text'
        },
        getCustomCss: function(row) {
            var customClass = this.customClasses[row.status] || '';
            return customClass + ' ' + this.additionalCustomClass;
        }
    });
});
