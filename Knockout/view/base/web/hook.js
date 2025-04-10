define([], function () {
    'use strict';

    console.log("Called this Hook.");

    return function (targetModule) {
        targetModule.crazyPropertyAddedHere = 'yes';

        return targetModule;
    };
    /*
            //if targetModule is a uiClass based object
            return targetModule.extend({
                someMethod:function()
                {
                    var result = this._super(); //call parent method

                    //do your new stuff

                    return result;
                }
            });

     */

});
