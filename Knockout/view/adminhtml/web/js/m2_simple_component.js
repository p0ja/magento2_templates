define([
        'uiElement',
        'ko'
    ],
    function (Element, ko) {

        viewModelConstructor = Element.extend({
            defaults: {
                template: 'M2_Knockout/m2_simple_template'
            }
        });

        return viewModelConstructor;
    });
