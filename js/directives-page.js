 jQuery(document).ready(function(){
    jQuery('[data-toggle="popover"]').popover();
    jQuery('[data-toggle="tooltip"]').tooltip();
});

(function($) {
    $(document).on("change", ".add-directive-option", function(){
        var BTT_CSP_FREE_DIRECTIVE = $(this).attr("data-directive");
        var BTT_CSP_FREE_DIRECTIVE_OPTION_TOGGLE = ($(this).prop("checked")==true)?"true":"false";
        var BTT_CSP_FREE_DIRECTIVE_OPTION = $(this).attr("data-value");
        // var BTT_CSP_FREE_HTTPS_TOGGLE=$('.add-directive-option[data-directive="'+BTT_CSP_FREE_DIRECTIVE+'"][data-value="https:"]');
        // if(BTT_CSP_FREE_HTTPS_TOGGLE.prop('checked')==false){
        //     BTT_CSP_FREE_HTTPS_TOGGLE.bootstrapToggle('on')
        // }
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {
                action:'Blue_Triangle_Automated_CSP_Free_Directive_Options',
                BTT_CSP_FREE_DIRECTIVE_OPTION_TOGGLE:BTT_CSP_FREE_DIRECTIVE_OPTION_TOGGLE,
                BTT_CSP_FREE_DIRECTIVE:BTT_CSP_FREE_DIRECTIVE,
                BTT_CSP_FREE_DIRECTIVE_OPTION:BTT_CSP_FREE_DIRECTIVE_OPTION,
            },
            success: function(response) {

            }
        });
    });

})( jQuery );