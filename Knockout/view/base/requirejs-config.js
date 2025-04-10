/*
any page which uses the Magento_Customer/js/view/customer RequireJS module

> module = requirejs('Magento_Customer/js/view/customer');
> console.log(module.crazyPropertyAddedHere)
"yes"

 */

var config = {
    'config': {
        'mixins': {
            "mage/dropdown": {
                'M2_Knockout/js/dropdown-mixin': true
            }
            // 'Magento_Customer/js/view/customer': {
            //     'M2_Knockout/hook':true
            // }
        }
    }
};
