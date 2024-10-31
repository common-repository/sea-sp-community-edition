window.addEventListener("load", function(e){ 
    setTimeout(function() {
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {action:"Blue_Triangle_Automated_CSP_Free_Send_CSP",BTT_CSP_FREE_ERROR:JSON.stringify(_BTT_CSP_FREE_ERROR)},
            success: function(response) {
            },
            error: function(XHR, TEXT, Error){
    
            },
        });
    }, BTT_CSP_postLoadDelay);
});