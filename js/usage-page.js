(function($) {
    $(document).on("change", ".usage-button", function(){
        var BTT_CSP_USAGE_MODE = ($(this).prop("checked")==true)?"true":"false";
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {
                action:'Blue_Triangle_Automated_CSP_Free_Csp_Usage_Update',
                BTT_CSP_USAGE_MODE:BTT_CSP_USAGE_MODE,
            },
            success: function(response) {
                console.log(response);
            }
        });
    });

})( jQuery );