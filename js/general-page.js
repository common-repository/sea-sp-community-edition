jQuery(document).ready(function(){
    jQuery('[data-toggle="popover"]').popover();
    jQuery('[data-toggle="tooltip"]').tooltip();
});

(function($) {
    $("#postLoadDelay").val(postLoadDelay).trigger("change");
    $(document).on("change", "#postLoadDelay", function(){
        var BTT_CSP_FREE_CSP_Delay = $(this).val();
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {
                action:'Blue_Triangle_Automated_CSP_Free_Csp_Delay',
                BTT_CSP_FREE_CSP_Delay:BTT_CSP_FREE_CSP_Delay,
            },
            success: function(response) {
                
            }
        });
    });
    $(document).on("change", ".activate-csp-button", function(){
        var BTT_CSP_FREE_CSP_MODE = ($(this).prop("checked")==true)?"true":"false";
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {
                action:'Blue_Triangle_Automated_CSP_Free_Csp_Mode',
                BTT_CSP_FREE_CSP_MODE:BTT_CSP_FREE_CSP_MODE,
            },
            success: function(response) {
                $("#cspOutPut").val(response)
            }
        });
    });

    $(document).on("change", ".activate-error-button", function(){
        var BTT_CSP_ERROR_COLLECT = ($(this).prop("checked")==true)?"true":"false";
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {
                action:'Blue_Triangle_Automated_CSP_Free_Csp_Error_Mode',
                BTT_CSP_ERROR_COLLECT:BTT_CSP_ERROR_COLLECT,
            },
            success: function(response) {

            }
        });
    });

})( jQuery );