(function() {
    var config = {
        paths:{
            "helper_main":"M2_Frontend/helper_main"
        }
    };

    alert("Done");
    require.config(config);
})();

/*
var config = {
    paths:{
        "jquery.cookie":"Package_Module/path/to/jquery.cookie.min"
    },
    shim:{ //'shim' -> Make sure you’ve completely loaded the jquery module first.
           // http://requirejs.org/docs/api.html#config-shim
        'jquery.cookie':{
            'deps':['jquery']
        }
    }
};
 */
