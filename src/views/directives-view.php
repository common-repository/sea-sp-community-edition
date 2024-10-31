<?php
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$siteID = get_current_blog_id();
$directives = Blue_Triangle_Automated_CSP_Free_Get_Directives();
$directiveOptions = Blue_Triangle_Automated_CSP_Free_Get_Directive_Options();
$cspData = Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID);
$CSP = $cspData[0];
$reportMode = $cspData[1];
$directiveSettings = Blue_Triangle_Automated_CSP_Free_Get_Directive_Settings($siteID,true);
$nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Directive_Nonce");
$adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
$plusSVG = '
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="20" height="20" viewBox="0 0 266.514 266.514" style="enable-background:new 0 0 266.514 266.514;" xml:space="preserve">
	<g>
		<g>
			<path style="fill:#010002;" d="M133.257,266.514C59.775,266.514,0,206.733,0,133.257S59.775,0,133.257,0     s133.257,59.781,133.257,133.257S206.739,266.514,133.257,266.514z M133.257,10.878c-67.477,0-122.379,54.896-122.379,122.379     S65.78,255.636,133.257,255.636s122.379-54.896,122.379-122.379S200.734,10.878,133.257,10.878z"/>
		</g>
		<path style="fill:#010002;" d="M210.35,127.818h-71.654V56.164c0-3.002-2.431-5.439-5.439-5.439c-3.008,0-5.439,2.437-5.439,5.439    v71.654H56.164c-3.002,0-5.439,2.437-5.439,5.439c0,3.002,2.437,5.439,5.439,5.439h71.654v71.649c0,3.002,2.431,5.439,5.439,5.439    c3.008,0,5.439-2.437,5.439-5.439v-71.649h71.654c3.002,0,5.439-2.437,5.439-5.439    C215.789,130.255,213.353,127.818,210.35,127.818z"/>
	</g>
</svg>
';
$directiveCardMarkUp='
<script>
var adminURL= "'.$adminURL.'";
var CSP_Directives = '.json_encode($directives).'
</script>
<div class="container-fluid">
  <div class="row mb-3 mt-3">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">SeaSP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp' ).'">Dashboard </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-general-settings' ).'">General Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-csp-violations' ).'">Current Violations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-directive-settings' ).'">Directive Settings<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-usage-settings' ).'">Usage Data Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-help-center' ).'">Help/Support</a>
            </li>
            </ul>
        </div>
        </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-lg-6 mb-2">
            <div class="card sea-sp-green text-white">
                <img class="card-img" alt="Blue Triangle Logo" src="'.$pluginDirectory.'img/seaSPIcon.png">
                <div class="card-img-overlay" style="top: auto; position: absolute; bottom: 0; right: 0; background-color: rgb(45 33 33 / 46%);height: 160px;">
                    <h6 class="card-title">SeaSP - Community Edition</h6>
                    <p class="card-text">Automated CSP Manger</p>
                    <p class="card-text">Version '.$versionNumber.' <br>Powered By: <a target="_blank" href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">

            <h3 class="mt-3">Directive Settings</h3>
            <h4>CSPs are made up of directives.</h4>
            <p>You can configure the directives for your CSP here.</p>
        </div>
        <div class="col-xl-3 col-md-12">
            <div style="background: #efefef; padding: 20px; height: 100%;" class="text-center">
            <img style="width: 100px; height: auto; float: left; margin-right: 10px;" src="'.$pluginDirectory.'img/starfish.png">
                <h5 class="text-left mt-2">We would love your feedback!</h5>

                <p class="mt-5">We are working to grow SeaSP and we would love feedback.</p>
                <p>Have a suggestion? <a target="_blank" href="https://wordpress.org/support/plugin/sea-sp-community-edition/" class="pink-text">We are all ears!</a></p>
                <p>If you like SeaSP, please leave us a review:</p><a target="_blank" href="https://wordpress.org/plugins/sea-sp-community-edition/#reviews" class="btn btn-warning">Leave a Review</a>
            </div>
      </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row mt-3">
    <div class="col-md-12">
<div id="accordion">
';

$cardCount = 0;
foreach($directives as $directive=>$info){
    if($info["has_options"] !=="1"){
        continue;
    }
    $showClass = ($cardCount==0)?"show":'';
    $currentDirectiveOptions = (isset($directiveSettings[$directive]))?$directiveSettings[$directive]:[];
    $directiveCardMarkUp.='
        <div class="card mb-2">
            <div class="card-header" id="heading'.$cardCount.'">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse'.$cardCount.'" aria-expanded="false" aria-controls="collapse-'.$cardCount.'">
                    '.$plusSVG.$directive.'
                    </button>
                </h5>
            </div>
            <div id="collapse'.$cardCount.'" class="collapse '.$showClass.' aria-labelledby="heading'.$cardCount.'" data-parent="#accordion">
                <div class="card-body">
                    <p class="card-text">'.$info["directive_desc"].'</p>
                    <div class="row">
                    ';
                    foreach($directiveOptions as $category=>$directiveOpts){
                        $directiveCardMarkUp.='
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">'.$category.'</h5>
                        ';

                        foreach($directiveOpts as $optName=>$optInfo){
                            $optionValue = (in_array($optName,$currentDirectiveOptions))?"checked":"";
                            $directiveCardMarkUp.='
                            <div class="form-check mt-2 mb-2">
                            <input type="checkbox" '.$optionValue.' 
                            id="dir-opt-'.$directive.'-'.$optName.'"
                            class="add-directive-option"
                            data-directive="'.$directive.'"
                            data-value="'.$optName.'"
                            data-toggle="toggle"
                            data-on="on" 
                            data-off="off" 
                            data-onstyle="success" 
                            data-offstyle="danger"
                            data-size="small"
                            >
                            <label class="form-check-label" for="dir-opt-'.$directive.'-'.$optName.'" data-toggle="tooltip" data-placement="right" title="'.$optInfo["option_dec"].'">
                                '.$optName.'
                            </label>
                            </div>
                            ';
                        }
                        $directiveCardMarkUp.='
                                </div>
                            </div>
                        </div>
                        ';
                    }
                    $directiveCardMarkUp.='</div>';//this end the row 
                
    $directiveCardMarkUp.='

                </div>
            </div>
        </div>
';

    $cardCount++;
}
$directiveCardMarkUp.='</div>';
echo $directiveCardMarkUp;

