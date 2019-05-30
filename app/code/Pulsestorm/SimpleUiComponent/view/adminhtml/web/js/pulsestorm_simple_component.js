define(['uiElement','ko'], function(Element, ko){
    viewModelConstructor = Element.extend({
        defaults: {
            template: 'Pulsestorm_SimpleUiComponent/pulsestorm_simple_template'
        },
        message: ko.observable("Misty Clouds")
    });

    return viewModelConstructor;
});