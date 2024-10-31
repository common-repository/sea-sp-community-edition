<?php
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Usage_Nonce");
$schedules = wp_get_schedules();
$adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
$siteID = get_current_blog_id();
$usageCollectionEnabled = Blue_Triangle_Automated_CSP_Free_Get_Setting("usage_collection",$siteID);
$cspUsageValue = ($usageCollectionEnabled =="true")?"checked":"";
$isMultisite = (is_multisite())?"true":"false";
global $wp_version;
$usageCardMarkUp='
<script>
var adminURL= "'.$adminURL.'";
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
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-general-settings' ).'">General Settings<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-csp-violations' ).'">Current Violations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-directive-settings' ).'">Directive Settings</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-usage-settings' ).'">Usage Data Settings</a>
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
                  <p class="card-text">Version '.$versionNumber.'<br>Powered By: <a target="_blank" href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
              </div>
          </div>
      </div>
      <div class="col-xl-6 col-lg-6">
          <h3 class="mt-3">Usage Settings</h3>
          <div class="col-md-12">
          <div class="form-check">
              <input type="checkbox" '.$cspUsageValue.' 
              id="cspUsage"
              class="usage-button"
              data-toggle="toggle"
              data-on="usage data on" 
              data-off="usage data off" 
              data-onstyle="success" 
              data-offstyle="info"
              data-size="large"
              >
              <label class="form-check-label" for="cspActivation" data-toggle="tooltip" data-placement="right" title="To send usage data to blue triangle so that we can keep plugin development going.">
                  Click This toggle to support this plugin and send usage data to Blue Triangle to keep development going.<br>
                  Data sent to Blue Triangle includes the following:<br>
                  <strong>
                  WordPress Version: '.$wp_version.'<br>
                  WordPress Debug Mode: '.WP_DEBUG.'<br>
                  WordPress Multi Site Enabled: '.$isMultisite.'<br>
                  WordPress site url: '.$_SERVER['SERVER_NAME'].'<br>
                  Time Stamp: '.time().'<br>
                  Data will be sent once a day via WordPress chron that sends this data as a post to Blue Triangle.<br>
                  This data will be used to help us understand how many users we have and what kind of features we should develop. <br>
                  Thank You - Blue Triangle SeaSP Team
                  </strong>
              </label>
          </div>
        </div> 
      </div>
      <div class="col-xl-3 col-md-12">
        <div style="background: #efefef; padding: 20px;height: 100%;" class="text-center">
          <img style="width: 100px; height: auto; float: left; margin-right: 10px;" src="'.$pluginDirectory.'img/starfish.png">
          <h5 class="text-left mt-2">We would love your feedback!</h5>
            <p class="mt-5">We are working to grow SeaSP and we would love feedback.</p>
            <p>Have a suggestion? <a target="_blank" href="https://wordpress.org/support/plugin/sea-sp-community-edition/" class="pink-text">We are all ears!</a></p>
            <p>If you like SeaSP, please leave us a review:</p><a target="_blank" href="https://wordpress.org/plugins/sea-sp-community-edition/#reviews" class="btn btn-warning">Leave a Review</a>
          </div>
      </div>
  </div>

</div>
';

echo $usageCardMarkUp;