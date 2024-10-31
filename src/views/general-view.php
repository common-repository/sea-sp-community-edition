<?php
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Approve_Nonce");
$adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
$siteID = get_current_blog_id();
$cspData = Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID);
$CSP = $cspData[0];
$reportMode = $cspData[1];
$cspActiveValue = ($reportMode =="1")?"checked":"";
$cspCollectionValue = Blue_Triangle_Automated_CSP_Free_Get_Setting("error_collection",$siteID);
$postLoadDelay = Blue_Triangle_Automated_CSP_Free_Get_Setting("post_load_delay",$siteID);
$cspCollectionValue = ($cspCollectionValue =="true")?"checked":"";
$directiveCardMarkUp='
<script>
var adminURL= "'.$adminURL.'";
var postLoadDelay= "'.$postLoadDelay.'";
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
                <a class="nav-link active" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-general-settings' ).'">General Settings<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-csp-violations' ).'">Current Violations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-directive-settings' ).'">Directive Settings</a>
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
                  <p class="card-text">Version '.$versionNumber.'<br>Powered By: <a target="_blank" href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
              </div>
          </div>
      </div>
      <div class="col-xl-6 col-lg-6">
          <h3 class="mt-3">General Settings</h3>
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
  <div class="row mt-3">
      <div class="col-md-12">
          <div class="form-check">
              <input type="checkbox" '.$cspActiveValue.' 
              id="cspActivation"
              class="activate-csp-button"
              data-toggle="toggle"
              data-on="Blocking" 
              data-off="Report only" 
              data-onstyle="success" 
              data-offstyle="info"
              data-size="large"
              >
              <label class="form-check-label" for="cspActivation" data-toggle="tooltip" data-placement="right" title="To Activate your CSP choose blocking mode. To collect more violation data choose report only.">
                  Click This toggle when your ready to place your CSP in blocking mode or to change it back to report only.
              </label>
          </div>
          <br>
          <div class="form-check">
              <input type="checkbox" '.$cspCollectionValue.' 
              id="cspErrorCollection"
              class="activate-error-button"
              data-toggle="toggle"
              data-on="Error Collection On" 
              data-off="Error Collection Off" 
              data-onstyle="success" 
              data-offstyle="info"
              data-size="large"
              >
              <label class="form-check-label" for="cspActivation" data-toggle="tooltip" data-placement="right" title="To Activate your CSP choose blocking mode. To collect more violation data choose report only.">
                  Click This toggle to turn on and off CSP Violation Collection.
              </label>
          </div>
          <br>
          <div class="form-group">
          <label for="postLoadDelay">Post Load Delay (how long to wait after page load to send CSP violations)</label>
          <select class="form-control" id="postLoadDelay" name="postLoadDelay">
            <option value="1000">1 sec.</option>
            <option value="2000">2 sec.</option>
            <option value="3000">3 sec.</option>
            <option value="4000">4 sec.</option>
            <option value="5000">5 sec.</option>
          </select>
        </div>
        <br>
          <div class="form-group">
              <label for="cspOutPut"><h4>Current CSP</h4></label>
              <textarea class="form-control" id="cspOutPut" rows="10">
              '.$CSP.'
              </textarea>
          </div>
      </div>
  </div>
</div>
';

echo $directiveCardMarkUp;