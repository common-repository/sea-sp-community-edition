<?php
/**
 * Plugin Name: Sea SP Community Edition 
 * Plugin URI: https://bluetrianglemarketing.github.io/SeaSP-Community-Edition/
 * Description: Sea SP is a Content Security Policy manager that automates manual processes of building a good CSP for your site.  
 * Version: 1.8.3
 * Author: Blue Triangle
 * Author URI: http://www.bluetriangle.com
 */

defined( 'ABSPATH' ) or die( 'Direct access to this plugin is prohibited.' );
define('SEASP_COMMUNITY_PLUGIN_DIR', \plugin_dir_path(__FILE__));

require_once( 'src/controllers/ViewFunctions.php' );
require_once( 'src/controllers/Ajax.php' );

define("SEASP_COMMUNITY_PLUGIN_VER", '1.8.3');

register_activation_hook( __FILE__, 'Blue_Triangle_Automated_Free_CSP_install' );
function Blue_Triangle_Automated_Free_CSP_install() {
    /*************************************************************
    *       site level tables
    **************************************************************/
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        //verified created
        $sql = "CREATE TABLE " . $wpdb->prefix."seasp_violation_log (
            id int(9) NOT NULL AUTO_INCREMENT,
            site_id int(9) NOT NULL,
            report_epoch int(13) NOT NULL,
            violating_directive varchar(55) DEFAULT '' NOT NULL,
            domain varchar(55) DEFAULT '' NOT NULL,
            extension varchar(55) DEFAULT '' NOT NULL,
            referrer varchar(55) DEFAULT '' NOT NULL,
            violating_file varchar(55) DEFAULT '',
            approved varchar(55) DEFAULT '',
            subdomain varchar(55) DEFAULT '',
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $dbOutput = dbDelta( $sql , true);

        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        //verified created 
        $sql = "CREATE TABLE " . $wpdb->prefix."seasp_subdomain_log (
            id int(9) NOT NULL AUTO_INCREMENT,
            site_id int(9) NOT NULL,
            report_epoch int(13) NOT NULL,
            violating_directive varchar(55) DEFAULT '' NOT NULL,
            domain varchar(55) DEFAULT '' NOT NULL,
            subdomain_name varchar(55) DEFAULT '' NOT NULL,
            approved varchar(55) DEFAULT '',
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $dbOutput = dbDelta( $sql , true);

        //verified created
        $sql = "CREATE TABLE " .$wpdb->prefix."seasp_directive_settings (
            id int(9) NOT NULL AUTO_INCREMENT,
            site_id int(9) NOT NULL,
            directive_name varchar(55) DEFAULT '' NOT NULL,
            option_name varchar(55) DEFAULT '' NOT NULL,
            option_value varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";
        $dbOutput = dbDelta( $sql , true);
        // "sandbox"=>[
        //     "fileType"=>"sandbox",
        //     "type"=>"Document",
        //     "desc"=>"Enables a sandbox for the requested resource similar to the iframe sandbox attribute.",
        //     "options"=>false,

        // ],
        //verified created
        $sql = "CREATE TABLE " . $wpdb->prefix."seasp_sand_box_urls (
            id int(9) NOT NULL AUTO_INCREMENT,
            site_id int(9) NOT NULL,
            sand_boxed_url varchar(55) DEFAULT '' NOT NULL,
            sand_box_option_name varchar(55) DEFAULT '' NOT NULL,
            sand_box_option_value varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";
        $dbOutput = dbDelta( $sql , true);

        // "object-src"=>[
        //     "fileType"=>"object",
        //     "type"=>"Fetch",
        //     "desc"=>"Specifies valid sources for the object, embed, and applet elements.
        //     Elements controlled by object-src are perhaps coincidentally considered legacy HTML elements and are not receiving new standardized features (such as the security attributes sandbox or allow for iframe). Therefore it is recommended to restrict this fetch-directive (e.g., explicitly set object-src 'none' if possible).",
        //     "options"=>true,
        //     "subDirective"=>[
        //         "plugin-types"=>[
        //             "fileType"=>"plugin",
        //             "type"=>"Document",
        //             "desc"=>"Restricts the set of plugins that can be embedded into a document by limiting the types of resources which can be loaded.To disallow all plugins, the object-src directive should be set to 'none' which will disallow plugins. The plugin-types directive is only used if you are allowing plugins with object-src at all.",
        //             "options"=>false,
        //         ],
        //     ],
        // ],
        //verified created
        $sql = "CREATE TABLE " . $wpdb->prefix."seasp_allowed_plugins (
            id int(9) NOT NULL AUTO_INCREMENT,
            plugin_type varchar(55) DEFAULT '' NOT NULL,
            plugin_src varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";
        $dbOutput = dbDelta( $sql , true);
        //verified create
        $sql = "CREATE TABLE " . $wpdb->prefix."seasp_csp (
            id int(9) NOT NULL AUTO_INCREMENT,
            site_id int(9) NOT NULL,
            csp_url varchar(55) DEFAULT '' NOT NULL,
            csp LONGTEXT NOT NULL,
            blocking int(9) NOT NULL,
            version_number int(9) NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";
        $dbOutput = dbDelta( $sql , true);
        //verified create
        $sql = "CREATE TABLE " . $wpdb->prefix."seasp_site_settings (
            id int(9) NOT NULL AUTO_INCREMENT,
            site_id int(9) NOT NULL,
            setting_name varchar(55) DEFAULT '' NOT NULL,
            setting_value LONGTEXT NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";
        $dbOutput = dbDelta( $sql , true);

    /**************************************************************
     *      network wide tables 
     **************************************************************/
        //verified create
        $sql = "CREATE TABLE " . $wpdb->prefix . "seasp_directives (
            id int(9) NOT NULL AUTO_INCREMENT,
            directive_name varchar(55) DEFAULT '' NOT NULL,
            file_type varchar(55) DEFAULT '' NOT NULL,
            directive_type varchar(55) DEFAULT '' NOT NULL,
            directive_desc varchar(512) DEFAULT '' NOT NULL,
            has_options varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";
        $dbOutput = dbDelta( $sql , true);
        //verified create
        $sql = "CREATE TABLE " . $wpdb->prefix . "seasp_directive_options (
            id int(9) NOT NULL AUTO_INCREMENT,
            option_type varchar(55) DEFAULT '' NOT NULL,
            option_name varchar(55) DEFAULT '' NOT NULL,
            option_dec varchar(55) DEFAULT '' NOT NULL,
            option_directive varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";
        $dbOutput = dbDelta( $sql , true);

    /*************************************************************
     *      fill in the tables with starting data 
     *************************************************************/
    Blue_Triangle_Automated_CSP_Free_Build_Directive_Data();
    Blue_Triangle_Automated_CSP_Free_Build_Option_Data();

    if ( is_multisite()) { 

        foreach (get_sites(['fields'=>'ids']) as $siteID) {
            Blue_Triangle_Automated_CSP_Free_Build_Site_Data($siteID);
        } 

    } else {
        //run in single site context
        $siteID = get_current_blog_id();
        Blue_Triangle_Automated_CSP_Free_Build_Site_Data($siteID);
    }
}

function Blue_Triangle_Automated_CSP_Free_Build_Option_Data(){
    $directiveOptions = [

        "host-source"=>[
            "http:"=>[
                "desc"=>"A scheme such as http: or https:.",
            ],
            "https:"=>[
                "desc"=>"A scheme such as http: or https:.",
            ],
            "wss:"=>[
                "desc"=>"Web sockets scheme.",
            ],
        ],
        "scheme-source"=>[
            "data:"=>[
                "desc"=>"You can also specify data schemes (not recommended).
                data: Allows data: URIs to be used as a content source. This is insecure; an attacker can also inject arbitrary data: URIs. Use this sparingly and definitely not for scripts.",
            ],
            "mediastream:"=>[
                "desc"=>"mediastream: Allows mediastream: URIs to be used as a content source.",
            ],
            "blob:"=>[
                "desc"=>"blob: Allows blob: URIs to be used as a content source.",
            ],
            "filesystem:"=>[
                "desc"=>"filesystem: Allows filesystem: URIs to be used as a content source.",
            ],
        ],
        "other"=>[
            "'self'"=>[
                "desc"=>"Refers to the origin from which the protected document is being served, including the same URL scheme and port number. You must include the single quotes. Some browsers specifically exclude blob and filesystem from source directives. Sites needing to allow these content types can specify them using the Data attribute.",
            ],
            "'unsafe-eval'"=>[
                "desc"=>"Allows the use of eval() and similar methods for creating code from strings. You must include the single quotes.",
            ],
            "'wasm-eval'"=>[
                "desc"=>"Currently 'unsafe-eval' allows WebAssembly and all of the other things that fall under 'unsafe-eval'. The goal for 'wasm-eval' is to allow WebAssembly without allowing JS eval().Basically, 'unsafe-eval' implies 'wasm-eval', but 'wasm-eval' does not imply 'unsafe-eval'.",
            ],
            "'unsafe-hashes'"=>[
                "desc"=>"Allows enabling specific inline event handlers. If you only need to allow inline event handlers and not inline script elements or javascript: URLs, this is a safer method than using the unsafe-inline expression.",
            ],
            "'unsafe-inline'"=>[
                "desc"=>"Allows the use of inline resources, such as inline script elements, javascript: URLs, inline event handlers, and inline style elements. The single quotes are required.",
            ],
            "'none'"=>[
                "desc"=>"Refers to the empty set; that is, no URLs match. The single quotes are required.",
            ],
            // "'nonce-base64-value'"=>[
            //     "desc"=>"An allow-list for specific inline scripts using a cryptographic nonce (number used once). The server must generate a unique nonce value each time it transmits a policy. It is critical to provide an unguessable nonce, as bypassing a resource’s policy is otherwise trivial. See unsafe inline script for an example. Specifying nonce makes a modern browser ignore 'unsafe-inline' which could still be set for older browsers without nonce support.",
            // ],
            "'strict-dynamic'"=>[
                "desc"=>"The strict-dynamic source expression specifies that the trust explicitly given to a script present in the markup, by accompanying it with a nonce or a hash, shall be propagated to all the scripts loaded by that root script. At the same time, any allow-list or source expressions such as 'self' or 'unsafe-inline' are ignored. See script-src for an example.",
            ],
        ],
        "sandbox"=>[
            "allow-downloads-without-user-activation"=>[
                "desc"=>"Allows for downloads to occur without a gesture from the user.",
            ],
            "allow-forms"=>[
                "desc"=>"Allows the page to submit forms. If this keyword is not used, this operation is not allowed.",
            ],
            "allow-modals"=>[
                "desc"=>"Allows the page to open modal windows.",
            ],
            "allow-orientation-lock"=>[
                "desc"=>"Allows the page to disable the ability to lock the screen orientation.",
            ],
            "allow-pointer-lock"=>[
                "desc"=>"Allows the page to use the Pointer Lock API.",
            ],
            "allow-popups"=>[
                "desc"=>"Allows popups (like from window.open, target='_blank', showModalDialog). If this keyword is not used, that functionality will silently fail.",
            ],
            "allow-popups-to-escape-sandbox"=>[
                "desc"=>"Allows a sandboxed document to open new windows without forcing the sandboxing flags upon them. This will allow, for example, a third-party advertisement to be safely sandboxed without forcing the same restrictions upon a landing page.
                ",
            ],
            "allow-presentation"=>[
                "desc"=>"Allows embedders to have control over whether an iframe can start a presentation session.",
            ],

            "allow-same-origin"=>[
                "desc"=>"Allows the content to be treated as being from its normal origin. If this keyword is not used, the embedded content is treated as being from a unique origin.",
            ],
            "allow-scripts"=>[
                "desc"=>"Allows the page to run scripts (but not create pop-up windows). If this keyword is not used, this operation is not allowed.",
            ],
            "allow-storage-access-by-user-activation "=>[
                "desc"=>"Lets the resource request access to the parent's storage capabilities with the Storage Access API.",
            ],
            "allow-top-navigation"=>[
                "desc"=>"Allows the page to navigate (load) content to the top-level browsing context. If this keyword is not used, this operation is not allowed.",
            ],
            "allow-top-navigation-by-user-activation"=>[
                "desc"=>"Lets the resource navigate the top-level browsing context, but only if initiated by a user gesture."
            ],
        ]
       
    ];
    //verified inserts to table 
    global $wpdb;
    
    foreach($directiveOptions as $optionType => $options){
        foreach($options as $optionName => $desc){
            $optionDirective = ($optionType == "sandbox")?"sandbox":"all";
            $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_directive_options`(`option_type`,`option_name`,`option_dec`,`option_directive`) values ';
            $insertStatement .="(%s,%s,%s,%s)";
            $wpdb->query($wpdb->prepare($insertStatement, [$optionType,$optionName,$desc,$optionDirective]));
            if($wpdb->last_error !== '') {
                $report = $wpdb->last_error .' failed to insert into `seasp_directive_options`' ;
                print_r($report);
            }
        }
    }
}

function Blue_Triangle_Automated_CSP_Free_Build_Directive_Data(){
    $directives = [
        "default-src"=>[
            "fileType"=>"any",
            "type"=>"Fetch",
            "desc"=>"Serves as a fallback for the other fetch directives.",
            "options"=>true,
        ],
        "child-src" =>[
            "fileType" =>"nested-webworker",
            "type"=>"Fetch",
            "desc"=>"Defines the valid sources for web workers and nested browsing contexts loaded using elements such as frame and iframe. Instead of child-src, if you want to regulate nested browsing contexts and workers, you should use the frame-src and worker-src directives, respectively.",
            "options"=>true,
        ],
        "connect-src"=>[
            "fileType"=>"script",
            "type"=>"Fetch",
            "desc"=>"Restricts the URLs which can be loaded using script interfaces",
            "options"=>true,
        ],
        "font-src"=>[
            "fileType"=>"font",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for fonts loaded using @font-face.",
            "options"=>true,
        ],
        "frame-src"=>[
            "fileType"=>"iframe",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for nested browsing contexts loading using elements such as frame and iframe.",
            "options"=>true,
        ],
        "img-src"=>[
            "fileType"=>"image",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources of images and favicons.",
            "options"=>true,
        ],
        "manifest-src"=>[
            "fileType"=>"manifest",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources of application manifest files.",
            "options"=>true,
        ],
        "media-src"=>[
            "fileType"=>"media",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for loading media using the audio , video and track elements.",
            "options"=>true,
        ],

        "prefetch-src"=>[
            "fileType"=>"any",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources to be prefetched or prerendered.",
            "options"=>true,
        ],
        "script-src"=>[
            "fileType"=>"js",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for JavaScript.",
            "options"=>true,
        ],
        "script-src-elem"=>[
            "fileType"=>"js",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for JavaScript script elements.",
            "options"=>true,
        ],
        "script-src-attr"=>[
            "fileType"=>"js",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for JavaScript inline event handlers.",
            "options"=>true,
        ],
        "style-src"=>[
            "fileType"=>"css",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for stylesheets.",
            "options"=>true,
        ],
        "style-src-elem"=>[
            "fileType"=>"css",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for stylesheets style elements and link elements with rel='stylesheet'.",
            "options"=>true,
        ],
        "style-src-attr"=>[
            "fileType"=>"css",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for inline styles applied to individual DOM elements.",
            "options"=>true,
        ],
        "worker-src"=>[
            "fileType"=>"worker",
            "type"=>"Fetch",
            "desc"=>"Specifies valid sources for Worker, SharedWorker, or ServiceWorker scripts.",
            "options"=>true,
        ],
        "base-uri"=>[
            "fileType"=>"base-file",
            "type"=>"Document",
            "desc"=>"Restricts the URLs which can be used in a document's base element.",
            "options"=>true,
        ],
        "form-action"=>[
            "fileType"=>"plugin",
            "type"=>"Navigation",
            "desc"=>"Restricts the URLs which can be used as the target of a form submissions from a given context.",
            "options"=>true,
        ],
        "frame-ancestors"=>[
            "fileType"=>"parents",
            "type"=>"Navigation",
            "desc"=>"Specifies valid parents that may embed a page using frame, iframe, object, embed, or applet.",
            "options"=>true,
        ],
        "navigate-to"=>[
            "fileType"=>"URL",
            "type"=>"Navigation",
            "desc"=>"Restricts the URLs to which a document can initiate navigation by any means, including form (if form-action is not specified), a, window.location, window.open, etc.",
            "options"=>true,
        ],
        "block-all-mixed-content"=>[
            "fileType"=>"asset",
            "type"=>"Other",
            "desc"=>"Prevents loading any assets using HTTP when the page is loaded using HTTPS.",
            "options"=>false,
        ],
        'upgrade-insecure-requests'=>[
            "fileType"=>"XXS Sink",
            "type"=>"Other",
            "desc"=>"Instructs user agents to treat all of a site's insecure URLs (those served over HTTP) as though they have been replaced with secure URLs (those served over HTTPS). This directive is intended for web sites with large numbers of insecure legacy URLs that need to be rewritten.",
            "options"=>false,
        ],

    ];
    //verified inserts to table 
    foreach($directives as $directiveName => $directiveData){
        global $wpdb;
        
        $fileType = $directiveData['fileType'];
        $type = $directiveData['type'];
        $desc = $directiveData['desc'];
        $options = $directiveData['options'];
    
        $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_directives`(`directive_name`,`file_type`,`directive_type`,`directive_desc`,`has_options`) values ';
        $insertStatement .="(%s,%s,%s,%s,%s)";
        $wpdb->query($wpdb->prepare($insertStatement, [$directiveName,$fileType,$type,$desc,$options]));
        if($wpdb->last_error !== '') {
            $report = $wpdb->last_error .' failed to insert into `seasp_directives`' ;
            print_r($report);
        }
    }
}

function Blue_Triangle_Automated_CSP_Free_Build_Site_Data($siteID){

    //verified insert into table 
    global $wpdb;
    
    $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_directive_settings`(`site_id`,`directive_name`,`option_name`,`option_value`) values ';
    $insertStatement .="(%s,'default-src','self',%s)";
    $wpdb->query($wpdb->prepare($insertStatement, [$siteID,"'self'"]));
    if($wpdb->last_error !== '') {
        $report = $wpdb->last_error .' failed to insert into `seasp_directive_settings`' ;
        print_r($report);
    }
    //verified insert into table 
    $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_site_settings`(`site_id`,`setting_name`,`setting_value`) values ';
    $insertStatement .="(%s,'error_collection','true')";
    $wpdb->query($wpdb->prepare($insertStatement, [$siteID]));
    if($wpdb->last_error !== '') {
        $report = $wpdb->last_error .' failed to insert into `seasp_site_settings`' ;
        print_r($report);
    }
    //verified insert into table 
    $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_site_settings`(`site_id`,`setting_name`,`setting_value`) values ';
    $insertStatement .="(%s,'nonce_enabled','false')";
    $wpdb->query($wpdb->prepare($insertStatement, [$siteID]));
    if($wpdb->last_error !== '') {
        $report = $wpdb->last_error .' failed to insert into `seasp_site_settings`' ;
        print_r($report);
    }
    //verified insert into table 
    $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_site_settings`(`site_id`,`setting_name`,`setting_value`) values ';
    $insertStatement .="(%s, 'plugin_version', %s)";
    $wpdb->query($wpdb->prepare($insertStatement, [$siteID, SEASP_COMMUNITY_PLUGIN_VER]));
    if($wpdb->last_error !== '') {
        $report = $wpdb->last_error .' failed to insert into `seasp_site_settings`' ;
        print_r($report);
    }
    //verified insert into table 
    $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_site_settings`(`site_id`,`setting_name`,`setting_value`) values ';
    $insertStatement .="(%s,'post_load_delay','2000')";
    $wpdb->query($wpdb->prepare($insertStatement, [$siteID]));
    if($wpdb->last_error !== '') {
        $report = $wpdb->last_error .' failed to insert into `seasp_site_settings`' ;
        print_r($report);
    }
    //verified insert into table 
    $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_site_settings`(`site_id`,`setting_name`,`setting_value`) values ';
    $insertStatement .="(%s,'usage_collection','false')";
    $wpdb->query($wpdb->prepare($insertStatement, [$siteID]));
    if($wpdb->last_error !== '') {
        $report = $wpdb->last_error .' failed to insert into `seasp_site_settings`' ;
        print_r($report);
    }
    Blue_Triangle_Automated_CSP_Free_Build_CSP($siteID,"default",false,false);

}

function Blue_Triangle_Automated_CSP_Free_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=blue-triangle-free-csp' ) ) );
    }
}
add_action( 'activated_plugin', 'Blue_Triangle_Automated_CSP_Free_redirect' );

register_uninstall_hook( __FILE__, 'Blue_Triangle_Automated_Free_CSP_deactivate' );
function Blue_Triangle_Automated_Free_CSP_deactivate() {
    //verified removal of these tables 
    global $wpdb;
    

    $wpdb->query("DROP TABLE IF EXISTS `seasp_violation_log`;");
    $wpdb->query("DROP TABLE IF EXISTS `seasp_directive_settings`;");
    $wpdb->query("DROP TABLE IF EXISTS `seasp_allowed_plugins`;");
    $wpdb->query("DROP TABLE IF EXISTS `seasp_csp`;");
    $wpdb->query("DROP TABLE IF EXISTS `seasp_directives`;");
    $wpdb->query("DROP TABLE IF EXISTS `seasp_directive_options`;");
    $wpdb->query("DROP TABLE IF EXISTS `seasp_site_settings`;");
    $wpdb->query("DROP TABLE IF EXISTS `seasp_sand_box_urls`;");

    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_violation_log`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_directive_settings`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_allowed_plugins`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_csp`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_directives`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_directive_options`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_site_settings`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_sand_box_urls`;");
    $wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."seasp_subdomain_log`;");

    delete_option( 'Blue_Triangle_Automated_CSP_Free_Directives');
    delete_option( 'Blue_Triangle_Automated_CSP_Free_Directive_Options');
    delete_option( 'Blue_Triangle_Automated_CSP_Free_Errors');
    delete_option( 'Blue_Triangle_Automated_CSP_Free_Report_Mode');
    delete_option( 'Blue_Triangle_Automated_CSP_Free_CSP');
    delete_option( 'Blue_Triangle_Automated_CSP_Free_Version');
}

add_action( 'send_headers', 'Blue_Triangle_Automated_CSP_Free_Inject_CSP' );
function Blue_Triangle_Automated_CSP_Free_Inject_CSP() {
    $siteID = get_current_blog_id();
    $nonceEnabled = Blue_Triangle_Automated_CSP_Free_Get_Setting("nonce_enabled",$siteID);
    if($nonceEnabled == "true"){
        $BTAC_CSP = Blue_Triangle_Automated_CSP_Free_Build_CSP($siteID,"default",true,true);
    }else{
        $BTAC_CSP = Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID);
        $BTAC_CSP = $BTAC_CSP[0];
    }
    
    header($BTAC_CSP,TRUE);
}

add_action('wp_head', 'Blue_Triangle_Automated_CSP_Free_Inject_Tag');
function Blue_Triangle_Automated_CSP_Free_Inject_Tag() {
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'sea-sp-community-edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_collector_js', $pluginDirectory . 'js/collector.js', array( 'jquery' ), "1.0", false );

    $nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Nonce");
    $adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
    $siteID = get_current_blog_id();
    $errorCollectionEnabled = Blue_Triangle_Automated_CSP_Free_Get_Setting("error_collection",$siteID);
    if($errorCollectionEnabled !== "true"){
        echo '';
    }
    $postLoadDelay = Blue_Triangle_Automated_CSP_Free_Get_Setting("post_load_delay",$siteID);
    $errorCollector = '
    <script>
    var BTT_CSP_postLoadDelay = ' . $postLoadDelay . ';
    var adminURL= "'.$adminURL.'";
    var _BTT_CSP_FREE_ERROR = [];
    window.addEventListener("securitypolicyviolation",function(e){
        _BTT_CSP_FREE_ERROR.push(
            {
                domain: e.blockedURI,   
                sourceFile: e.sourceFile,
                referrer: e.referrer,
                documentURI: e.documentURI,
                violatedDirective: e.violatedDirective,
                "type":"csp",
            }
        );
    });
    </script>
    ';
    echo $errorCollector;
}

function Blue_Triangle_Automated_CSP_Free_themes_page() {

    $page_title = "Blue Triangle SeaSP - Community Edition";
    $menu_title = "Blue Triangle SeaSP"; 
    $capability = apply_filters("Blue_Triangle_Automated_CSP_Free_options_capability", "edit_theme_options");
    $menu_slug = "blue-triangle-free-csp";
    $svg = "PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIxOC4xMDE3IiB2aWV3Qm94PSIwIDAgMjAgMTguMTAxNyI+PHRpdGxlPkJULWF2YXRhci13cDwvdGl0bGU+PHBvbHlnb24gcG9pbnRzPSIxMy43ODkgMTQuODQ1IDUuMjMzIDAgOS4xNzcgMTIuOTIyIDUuNTYzIDEzLjg4MiA3LjUgMTAuNTA4IDYuNDE1IDYuOTU1IDAgMTguMTAyIDEzLjc4OSAxNC44NDUiIGZpbGw9IiNlZWUiLz48cG9seWdvbiBwb2ludHM9IjE1LjIwMiAxNS40NTcgNC4wMDEgMTguMTAyIDIwIDE4LjEwMiAxMC4wMDEgMC43MjMgOC4zNTUgMy41ODEgMTUuMjAyIDE1LjQ1NyIgZmlsbD0iI2VlZSIvPjwvc3ZnPg==";
    $icon_url = "data:image/svg+xml;base64," . $svg;
    $space = "Blue_Triangle_Automated_CSP_Free";
    $page = add_menu_page( __($page_title,$space), __($menu_title,$space), $capability, $menu_slug, "Blue_Triangle_Automated_CSP_Free_Dashboard", $icon_url);

    $tabs = apply_filters("Blue_Triangle_Automated_CSP_menu_tabs", array(
        'general-settings' => [__("General Settings", $space),"Blue_Triangle_Automated_CSP_Free_General_Page"],
        'csp-violations' => [__("Current Violations", $space),"Blue_Triangle_Automated_CSP_Free_Violations"],
        'directive-settings' => [__("Directive Settings", $space),"Blue_Triangle_Automated_CSP_Free_Directives_Page"],
        'usage-settings' => [__("Usage Data Settings", $space),"Blue_Triangle_Automated_CSP_Free_Usage_Page"],
        'help-center' => [__("Help Center", $space),"Blue_Triangle_Automated_CSP_Free_Help_Center"],
    ));

    foreach ( $tabs as $key => $settings ) {
        $title = $settings[0];
        $functionName = $settings[1];
        $subMenuSlug = $menu_slug ."-".$key;
        add_submenu_page( 'blue-triangle-free-csp', __('Blue Triangle Menu', 'Blue_Triangle_Automated_CSP_Free') . ' - ' . $title, $title, $capability, $subMenuSlug, $functionName );

    }

}
add_action( 'admin_menu', 'Blue_Triangle_Automated_CSP_Free_themes_page');

function Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID){

    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
    SELECT 
    csp,
    blocking
    FROM   ".$wpdb->prefix."seasp_csp
    WHERE  version_number = (SELECT MAX(version_number) FROM ".$wpdb->prefix."seasp_csp WHERE site_id = %s)
    AND site_id = %s AND csp_url = 'default' ;
    ",[
        $siteID,
        $siteID
        ]
    );

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    return [$results[0]["csp"],$results[0]["blocking"]];

}

function Blue_Triangle_Automated_CSP_Free_Get_Setting($settingName,$siteID){
    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
    SELECT 
    setting_value
    FROM ".$wpdb->prefix."seasp_site_settings
    WHERE site_id = %s AND setting_name = %s
    ",[
        $siteID,
        $settingName
        ]
    );

    //execute the query
    try {
        $results = $wpdb->get_results($selectStatement,ARRAY_A);
    }
    catch (Exception $e) {}
    
    if ($wpdb->last_error !== "") {
        return "No site prefix";
    }

    return (isset($results[0]))?$results[0]["setting_value"]:false;
}

function Blue_Triangle_Automated_CSP_Free_Update_Setting($SettingName,$settingValue,$siteID){
    /* Setting Value for Plugin Version must be in MAJOR.MINOR (ex: 1.5) */
    global $wpdb;
    
    $updateStatement = $wpdb->prepare("  
    UPDATE ".$wpdb->prefix."seasp_site_settings
    SET setting_value = %s
    WHERE  setting_name = %s
    AND site_id = %s;
    ",[
        $settingValue,
        $SettingName,
        $siteID
        ]
    );
    //execute the query
    $wpdb->query($updateStatement);
    if($wpdb->last_error !== '') {
       return false;
    }
    return true;
}

function Blue_Triangle_Automated_CSP_Free_Get_Directive_Settings($siteID,$asArray){

    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
    SELECT 
    *
    FROM ".$wpdb->prefix."seasp_directive_settings
    WHERE site_id = %s
    ",[
        $siteID,
        ]
    );
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    $directiveSettings = [];
    if($asArray){
        foreach($results as $recordNumber => $recordData){
            $directiveSettings[$recordData["directive_name"]][$recordData["option_name"]]=$recordData["option_value"];
        }
    }else{
        foreach($results as $recordNumber => $recordData){
            if(isset($directiveSettings[$recordData["directive_name"]])){
                $directiveSettings[$recordData["directive_name"]].=$recordData["option_value"]." ";
            }else{
                $directiveSettings[$recordData["directive_name"]]=$recordData["option_value"]." ";
            }
        }
    }

    return $directiveSettings;
}

function Blue_Triangle_Automated_CSP_Free_Get_Violations($siteID,$approved){

    $whereStatement = ($approved)?"WHERE site_id = %s AND approved = 'true'":"WHERE site_id = %s";
    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
    SELECT 
    *
    FROM ".$wpdb->prefix."seasp_violation_log
    ".$whereStatement,[
        $siteID,
        ]
    );

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    return $results;
}

function Blue_Triangle_Automated_CSP_Free_Get_Approved_Domains($siteID,$approved){

    $whereStatement = ($approved)?"WHERE (site_id = %s AND approved = 'true') OR (site_id = %s AND subdomain = 'true')":"WHERE site_id = %s";
    $arguments = ($approved)?[$siteID,$siteID]:[$siteID];
    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
    SELECT 
    *
    FROM ".$wpdb->prefix."seasp_violation_log
    ".$whereStatement,$arguments 
    );

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    $approvedDomains = [];
    foreach($results as $recordNumber => $recordData){
        if ($approved == false) {
            if (!isset($approvedDomains[$recordData["violating_directive"]])) {
                $approvedDomains[$recordData["violating_directive"]] = [];
            }
            $approvedDomains[$recordData["violating_directive"]][] = $recordData["domain"];
            if($recordData["subdomain"]=="true"){
                $approvedDomains[$recordData["violating_directive"]][] = "*.".$recordData["domain"];
            }
        }
        else if(isset($approvedDomains[$recordData["violating_directive"]])){
            if($recordData["approved"]=="true"){
                $approvedDomains[$recordData["violating_directive"]] .= $recordData["domain"]." ";
            }
            if($recordData["subdomain"]=="true"){
                $approvedDomains[$recordData["violating_directive"]] .= "*.".$recordData["domain"]." ";
            }
        }else{
            if($recordData["approved"]=="true" && $recordData["subdomain"]=="true"){
                $approvedDomains[$recordData["violating_directive"]] = $recordData["domain"]." ";
                $approvedDomains[$recordData["violating_directive"]] .= "*.".$recordData["domain"]." ";
            }
            else if($recordData["subdomain"]=="true"){
                $approvedDomains[$recordData["violating_directive"]] = "*.".$recordData["domain"]." ";
            }
            else if($recordData["approved"]=="true"){
                $approvedDomains[$recordData["violating_directive"]] = $recordData["domain"]." ";
            }
        }

    }
    return $approvedDomains;

}

function Blue_Triangle_Automated_CSP_Free_Get_Directives(){

    global $wpdb;
    
    $selectStatement = "
    SELECT 
    directive_name,
    file_type,
    directive_type,
    directive_desc,
    has_options
    FROM ".$wpdb->prefix."seasp_directives
    ";

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    $directives = [];
    foreach($results as $recordNumber => $recordData){
        $directives[$recordData["directive_name"]] = $recordData;
    }
    return $directives;

}

function Blue_Triangle_Automated_CSP_Free_Get_subdomains_from_domain($siteID,$domain){

    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
    SELECT 
    subdomain_name,
    violating_directive
    FROM ".$wpdb->prefix."seasp_subdomain_log
    WHERE site_id = %s AND domain = %s
    ",[
        $siteID,
        $domain
    ]);

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    $directives = [];
    foreach($results as $recordNumber => $recordData){
        $directives[$recordData["violating_directive"]] []= $recordData["subdomain_name"];
    }
    return $directives;

}

function Blue_Triangle_Automated_CSP_Free_Get_Directive_Options(){
    global $wpdb;
    
    $selectStatement = "
    SELECT 
    option_type,
    option_name,
    option_dec,
    option_directive
    FROM ".$wpdb->prefix."seasp_directive_options
    WHERE option_type <> 'sandbox'
    ";

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    $options = [];
    foreach ($results as $recordNumber=>$data){
        $options[$data["option_type"]][$data["option_name"]]= $data;
    }
    return $options;
}

function Blue_Triangle_Automated_CSP_Free_Get_Latest_Version_Number($siteID){
    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
    SELECT 
    version_number
    FROM   ".$wpdb->prefix."seasp_csp
    WHERE  version_number = (SELECT MAX(version_number) FROM ".$wpdb->prefix."seasp_csp WHERE site_id = %s)
    AND site_id = %s AND csp_url = 'default' ;
    ",[
        $siteID,
        $siteID
        ]
    );

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    return $results[0]["version_number"];
}

function Blue_Triangle_Automated_CSP_Free_Build_CSP($siteID,$url,$blocking,$nonce){
    $directiveSettings = Blue_Triangle_Automated_CSP_Free_Get_Directive_Settings($siteID,false);
    $approvedDomains = Blue_Triangle_Automated_CSP_Free_Get_Approved_Domains($siteID,true);
    $approvedSubdomains = Blue_Triangle_Automated_CSP_Free_Get_Approved_Subdomains($siteID);
    $directives = Blue_Triangle_Automated_CSP_Free_Get_Directives();
    $versionNumber = Blue_Triangle_Automated_CSP_Free_Get_Latest_Version_Number($siteID);
    $newVersionNumber = (int)$versionNumber +1;
   
    $CSP = (!$blocking)? "Content-Security-Policy-Report-Only: ":"Content-Security-Policy: ";
    $userNonce = ($nonce)?wp_create_nonce("Blue_Triangle_Automated_CSP_Free_User_Nonce"):"";

    foreach($directives as $directive=>$directiveInfo){
        $hasOptions = ($directiveInfo["has_options"]=="1")?true:false;
        if(!isset($directiveSettings[$directive]) && !isset($approvedDomains[$directive]) && !isset($approvedSubdomains[$directive])){
            continue;
        }
        $CSP.=$directive." ";
        if(isset($directiveSettings[$directive])){
            $CSP.= $directiveSettings[$directive]. " ";
            if($nonce && $hasOptions){
                $CSP.="nonce-".$userNonce." ";
            }
        }
        if(isset($approvedDomains[$directive])){
            $CSP.= $approvedDomains[$directive] . " ";
        }

        if (isset($approvedSubdomains[$directive])) {
            $CSP .=  $approvedSubdomains[$directive] . " ";
        }
        $CSP = trim($CSP);
        $CSP.="; ";
    }

    if($nonce){
        return $CSP;
    }else{
        global $wpdb;
        
        $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_csp`(`site_id`,`csp_url`,`csp`,`blocking`,`version_number`) values ';
        $insertStatement .="(%s,%s,%s,%d,%d)";
        $wpdb->query($wpdb->prepare($insertStatement, 
        [
            $siteID,
            $url,
            $CSP,
            $blocking,
            $newVersionNumber
        ]));
        if($wpdb->last_error !== '') {
            $report = $wpdb->last_error .' failed to insert into `seasp_directive_settings`' ;
            print_r($report);
        }
    }
    
}

function Blue_Triangle_Automated_CSP_Free_Violations_Notice(){
    global $pagenow;
    $siteID = get_current_blog_id();
    $errorCollectionEnabled = Blue_Triangle_Automated_CSP_Free_Get_Setting("error_collection",$siteID);
    $usageCollectionEnabled = Blue_Triangle_Automated_CSP_Free_Get_Setting("usage_collection",$siteID);
    $Blue_Triangle_Automated_CSP_Free_Errors = Blue_Triangle_Automated_CSP_Free_Get_Violations($siteID,false);
    $CSP_Blocking = Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID);
    $blocking = $CSP_Blocking[1];
    $unapprovedCount = 0;
    foreach($Blue_Triangle_Automated_CSP_Free_Errors as $index =>$directiveData){        
        if($directiveData["approved"]!="true"){
            $unapprovedCount ++;
        }
    }

    if($unapprovedCount>0 || $errorCollectionEnabled !== "true" || $blocking == "0" || $usageCollectionEnabled == "false"){
        echo '
        <div class="notice notice-warning is-dismissible"> 
            <p><strong>SeaSP Insights</strong></p>
        ';
        if($unapprovedCount>0){
            echo '
            <p>You have '.$unapprovedCount .' domains to review <a href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-csp-violations' ).'">click here</a> to review them now</p>
            ';
        }
        if($blocking == "0"){
            echo '
            <p>Your CSP is currently in report only mode <a href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-general-settings' ).'">click here</a> to enable your CSP</p>
            ';
        }
        if($errorCollectionEnabled == "true"){
            echo '
            <p>Your SeaSP is currently collecting violations data to change this <a href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-general-settings' ).'">click here</a> </p>
            ';
        }
        if($usageCollectionEnabled == "false"){
            echo '
            <p>Please help support this plugin by turning on usage reporting <a href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-usage-settings' ).'">click here to learn more</a> </p>
            ';
        }
            
        echo '
        </div>
        ';
    }
        
    
}
add_action('admin_notices', 'Blue_Triangle_Automated_CSP_Free_Violations_Notice');

function Blue_Triangle_Automated_CSP_Free_Cron_Activate() {

    if( !wp_next_scheduled( 'Blue_Triangle_Automated_CSP_Free_Cron_Update' ) ) {  
       wp_schedule_event( time(), 'daily' , 'Blue_Triangle_Automated_CSP_Free_Cron_Update' );  
    }
}
register_activation_hook( __FILE__, 'Blue_Triangle_Automated_CSP_Free_Cron_Activate' );

function Blue_Triangle_Automated_CSP_Free_Cron_Job(){
    $siteID = get_current_blog_id();
    $usageCollectionEnabled = Blue_Triangle_Automated_CSP_Free_Get_Setting("usage_collection",$siteID);
    if($usageCollectionEnabled == "true"){
        global $wp_version;
        $isMultisite = (is_multisite())?"true":"false";
        $isDebug = (WP_DEBUG ==1)?"true":"false";
        $body = [
            "wp_version" => $wp_version,
            "wp_debug" => $isDebug,
            "wp_multi_site" => $isMultisite,
            "site_url" => $_SERVER['SERVER_NAME'],
            "createTime"=> time()
        
        ];
        $url = 'https://ks.bluetriangle.com/usages';
        $headers = array( 
                'Content-type' => 'application/json',
                'X-BTT-JWT'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InNlYXNwZmVlZGJhY2siLCJlbWFpbCI6IlNlYVNQQGJsdWV0cmlhbmdsZS5jb20iLCJjcmVhdGVUaW1lIjoxNjE2MDkzNzYyLCJsYXN0VmlzaXQiOjE2MTYwOTM3NjIsInN1cGVydXNlciI6MCwic3RhdHVzIjoxNjE4Njg1NzYyLCJjb21wYW55SUQiOjEsInByaXZpbGVnZSI6InVzYWdlIn0.lzSVkRVN61OUEshAKrKPRVveWKILQSyfw-KntzKmc3M',
                );
       
        $payLoad = array(
            'method' => 'POST',
            'timeout' => 60,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => $headers,
            'body' =>  json_encode($body)
            );
        
        $response = wp_remote_post($url, $payLoad);

    }
}
add_action( 'Blue_Triangle_Automated_CSP_Free_Cron_Update', 'Blue_Triangle_Automated_CSP_Free_Cron_Job');

//verified update process
function Blue_Triangle_Automated_CSP_Free_update_db_check() {
    $siteID = get_current_blog_id();
    $pluginVersion = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    $siteID = get_current_blog_id();
    global $wpdb;
    
    if ($pluginVersion == false) {
        //if there was no previous plugin version update schema to current version 
        delete_option( 'Blue_Triangle_Automated_CSP_Free_Directives');
        delete_option( 'Blue_Triangle_Automated_CSP_Free_Directive_Options');
        delete_option( 'Blue_Triangle_Automated_CSP_Free_Errors');
        delete_option( 'Blue_Triangle_Automated_CSP_Free_Report_Mode');
        delete_option( 'Blue_Triangle_Automated_CSP_Free_CSP');
        delete_option( 'Blue_Triangle_Automated_CSP_Free_Version');
        Blue_Triangle_Automated_Free_CSP_install();
    }
    if ($pluginVersion == 'No site prefix') {
        $wpdb->query("ALTER TABLE `seasp_site_settings` RENAME TO `".$wpdb->prefix."seasp_site_settings`");
        $pluginVersion = Blue_Triangle_Automated_CSP_Free_Get_Setting("plugin_version",$siteID);
    }

    $pluginVersion = (float)$pluginVersion;
    if($pluginVersion < 1.5){
        Blue_Triangle_Automated_CSP_Free_Update_Setting("plugin_version","1.5",$siteID);
        
        $insertStatement = 'insert into `'.$wpdb->prefix.'seasp_site_settings`(`site_id`,`setting_name`,`setting_value`) values ';
        $insertStatement .="(%s,'usage_collection','false')";
        $wpdb->query($wpdb->prepare($insertStatement, [$siteID]));
        if($wpdb->last_error !== '') {
            $report = $wpdb->last_error .' failed to insert into `'.$wpdb->prefix.'seasp_site_settings`' ;
            print_r($report);
        }
    }
    if($pluginVersion < 1.8){        
        $charset_collate = $wpdb->get_charset_collate();
        //verified created 
        $sql = "CREATE TABLE " . $wpdb->prefix."seasp_subdomain_log (
            id int(9) NOT NULL AUTO_INCREMENT,
            site_id int(9) NOT NULL,
            report_epoch int(13) NOT NULL,
            violating_directive varchar(55) DEFAULT '' NOT NULL,
            domain varchar(55) DEFAULT '' NOT NULL,
            subdomain_name varchar(55) DEFAULT '' NOT NULL,
            approved varchar(55) DEFAULT '',
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $dbOutput = dbDelta($sql , true);

        $oldTables = $wpdb->query('SHOW TABLES LIKE "seasp_%"');

        // rename old tables to include user-defined table prefixes
        if ($oldTables != 0) {
            $wpdb->query("ALTER TABLE `seasp_allowed_plugins` RENAME TO `".$wpdb->prefix."seasp_allowed_plugins`");
            $wpdb->query("ALTER TABLE `seasp_csp` RENAME TO `".$wpdb->prefix."seasp_csp`");
            $wpdb->query("ALTER TABLE `seasp_directives` RENAME TO `".$wpdb->prefix."seasp_directives`");
            $wpdb->query("ALTER TABLE `seasp_directive_options` RENAME TO `".$wpdb->prefix."seasp_directive_options`");
            $wpdb->query("ALTER TABLE `seasp_directive_settings` RENAME TO `".$wpdb->prefix."seasp_directive_settings`");
            $wpdb->query("ALTER TABLE `seasp_sand_box_urls` RENAME TO `".$wpdb->prefix."seasp_sand_box_urls`");
            $wpdb->query("ALTER TABLE `seasp_violation_log` RENAME TO `".$wpdb->prefix."seasp_violation_log`");
        }

        Blue_Triangle_Automated_CSP_Free_Update_Setting("plugin_version","1.8",$siteID);
    }
}
add_action( 'plugins_loaded', 'Blue_Triangle_Automated_CSP_Free_update_db_check' );

function Blue_Triangle_Automated_CSP_Free_Get_Approved_Subdomains ($siteID) {
    global $wpdb;
    
    $selectStatement = $wpdb->prepare("
        SELECT 
        sd.violating_directive, sd.subdomain_name, sd.domain
        FROM ".$wpdb->prefix."seasp_subdomain_log sd
        LEFT JOIN ".$wpdb->prefix."seasp_violation_log d
        ON sd.site_id = d.site_id
        AND sd.domain = d.domain
        WHERE sd.site_id = %s
        AND sd.approved = 'true'
        AND d.subdomain = 'false'
        ",
        [$siteID]
    );

    //execute the query
    $results = $wpdb->get_results($selectStatement,ARRAY_A);
    if($wpdb->last_error !== '') {
        print_r($wpdb->last_error);
    }
    $approvedDomains = [];
    foreach($results as $recordNumber => $recordData){
        if(isset($approvedDomains[$recordData["violating_directive"]])){
            $approvedDomains[$recordData["violating_directive"]] .= $recordData["subdomain_name"] . "." . $recordData["domain"]." ";
        }
        else {
            $approvedDomains[$recordData["violating_directive"]] = $recordData["subdomain_name"] . "." . $recordData["domain"]." ";
        }
    }
    return $approvedDomains;
}
