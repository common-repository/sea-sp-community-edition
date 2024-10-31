<?php

function Blue_Triangle_Automated_CSP_Free_Dashboard(){
    $siteID = get_current_blog_id();
    $versionNumber = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'sea-sp-community-edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    require_once( SEASP_COMMUNITY_PLUGIN_DIR .'src/views/dashboard-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_General_Page(){
    $siteID = get_current_blog_id();
    $versionNumber = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'sea-sp-community-edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_general_js', $pluginDirectory . 'js/general-page.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle_js', $pluginDirectory . 'bootstrap/bootstrap-toggle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle',  $pluginDirectory. 'bootstrap/bootstrap-toggle.min.css' );
    require_once(  SEASP_COMMUNITY_PLUGIN_DIR.'src/views/general-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_Violations(){
    $siteID = get_current_blog_id();
    $versionNumber = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'sea-sp-community-edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_approval_js', $pluginDirectory . 'js/approval-page.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle_js', $pluginDirectory . 'bootstrap/bootstrap-toggle.min.js', array( 'jquery' ), "1.0", false );
   
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle',  $pluginDirectory. 'bootstrap/bootstrap-toggle.min.css' );
    require_once( SEASP_COMMUNITY_PLUGIN_DIR.'src/views/violations-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_Directives_Page(){
    $siteID = get_current_blog_id();
    $versionNumber = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    $directiveOptions = get_option( 'Blue_Triangle_Automated_CSP_Free_Directive_Options');
    if(!isset($directiveOptions["host-source"]["wss:"])){
        $directiveOptions["host-source"]["wss:"]= [
            "desc"=>"Web sockets scheme.",
        ];
        update_option( 'Blue_Triangle_Automated_CSP_Free_Directive_Options', $directiveOptions);
    }
    if(!isset($directiveOptions["other"]["'wasm-eval'"])){
        $directiveOptions["other"]["'wasm-eval'"]=[
            "desc"=>"Currently 'unsafe-eval' allows WebAssembly and all of the other things that fall under 'unsafe-eval'. The goal for 'wasm-eval' is to allow WebAssembly without allowing JS eval().Basically, 'unsafe-eval' implies 'wasm-eval', but 'wasm-eval' does not imply 'unsafe-eval'.",
        ];
        update_option( 'Blue_Triangle_Automated_CSP_Free_Directive_Options', $directiveOptions);
    }
    if(isset($directiveOptions["other"]["'nonce-base64-value'"])){
        unset($directiveOptions["other"]["'nonce-base64-value'"]);
        update_option( 'Blue_Triangle_Automated_CSP_Free_Directive_Options', $directiveOptions);
    }
    
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'sea-sp-community-edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_directives_js', $pluginDirectory . 'js/directives-page.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle_js', $pluginDirectory . 'bootstrap/bootstrap-toggle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle',  $pluginDirectory. 'bootstrap/bootstrap-toggle.min.css' );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    require_once(  SEASP_COMMUNITY_PLUGIN_DIR.'src/views/directives-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_Help_Center(){
    $siteID = get_current_blog_id();
    $versionNumber = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'sea-sp-community-edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    require_once(  SEASP_COMMUNITY_PLUGIN_DIR.'src/views/help-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_Usage_Page(){
    $siteID = get_current_blog_id();
    $versionNumber = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'sea-sp-community-edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_usage_js', $pluginDirectory . 'js/usage-page.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle_js', $pluginDirectory . 'bootstrap/bootstrap-toggle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle',  $pluginDirectory. 'bootstrap/bootstrap-toggle.min.css' );
    require_once(  SEASP_COMMUNITY_PLUGIN_DIR.'src/views/usage-view.php' );
}