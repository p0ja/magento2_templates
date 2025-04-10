define(['jquery'], function (jQuery) {
    return function (originalWidget) {

        alert("Our mixin is hooked up.");
        console.log("Our mixin is hooked up");

        jQuery.widget(
            'mage.dropdownDialog',              //named widget we're redefining

            //jQuery.mage.dropdownDialog
            jQuery['mage']['dropdownDialog'],   //widget definition to use as
            //a "parent" definition -- in
            //this case the original widget
            //definition, accessed using
            //bracket syntax instead of
            //dot syntax

            {                                   //the new methods
                open: function () {
                    //new code here
                    console.log("I opened a dropdown!");

                    //call parent open for original functionality
                    return this._super();

                }
            });

        return originalWidget;
    };
});
