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
              <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp' )?>">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-general-settings' )?>">General Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-csp-violations' )?>">Current Violations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-directive-settings' )?>">Directive Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-usage-settings' )?>">Usage Data Settings</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-help-center' )?>">Help/Support <span class="sr-only">(current)</span></a>
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
              <img class="card-img" alt="Blue Triangle Logo" src="<?=$pluginDirectory?>img/seaSPIcon.png">
              <div class="card-img-overlay" style="top: auto; position: absolute; bottom: 0; right: 0; background-color: rgb(45 33 33 / 46%);height: 160px;">
                  <h6 class="card-title">SeaSP - Community Edition</h6>
                  <p class="card-text">Automated CSP Manger</p>
                  <p class="card-text">Version <?=$versionNumber?> <br>Powered By: <a target="_blank" href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
              </div>
          </div>
      </div>
      <div class="col-xl-6 col-lg-6">
          <h3 class="mt-3">Sea SP Community Edition </h3>
            <p>SeaSP Community Edition is an automated CSP manger that first installs a strict non-blocking CSP to collect violation data. Once violation data is collected it is stored in the WordPress database as a php object in the plugin options schema.</p>
            <p>SeaSP Community Edition then allows you to review each of the violations and approve domains for each directive that has been violated. Choose to either approve the base domain or subdomains or both.</p>
            <p>Other features include the ability to set sources of content for each directive of the CSP such as only allowing HTTP or HTTPS domains, or allowing inline scripts only for style sources.</p>
            <p>The UI gives the user tips on what each directive does and how it should be used to protect their site.
            Once domain and directive settings are done being configured, the CSP can switched to blocking mode to protect the site.
            </p>
      </div>
      <div class="col-xl-3 col-md-12">
        <div style="background: #efefef; padding: 20px; height: 100%;" class="text-center">
        <img style="width: 100px; height: auto; float: left; margin-right: 10px;" src="<?=$pluginDirectory?>img/starfish.png">
            <h5 class="text-left mt-2">We would love your feedback!</h5>

            <p class="mt-5">We're working to grow SeaSP and we would love feedback.</p>
            <p>Have a suggestion? <a target="_blank" href="https://wordpress.org/support/plugin/sea-sp-community-edition/" class="pink-text">We're all ears!</a></p>
              <p>If you like SeaSP, please leave us a review:</p><a target="_blank" href="https://wordpress.org/plugins/sea-sp-community-edition/#reviews" class="btn btn-warning">Leave a Review</a>
          </div>
      </div>
  </div>
<div class="row">
  <div class="col-xl-6 col-lg-8 col-md-12">
    <h3 class="mt-5">Walk Through</h3>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/XdJNh6LEKJw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
  </div>
    <div class="col-xl-6 col-lg-4 col-md-12">
      <h3 class="mt-5">Installation</h3>
          <ul>
            <li>Download and unzip the contents into the plugins folder of your WordPress instance.</li>
            <li>In the Admin Dashboard of WordPress click on the Plugins menu item on teh left side.</li>
            <li>Find Blue Triangle Free CSP in the list of plugins and click activate.</li>
          </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

      <h3 class="mt-5">Usage</h3>
      <p>Once installed a strict non-blocking CSP is implemented on your site visit each page of your site to collect CSP violations for each of those pages.</p>
      <p>Visit the Current Violations page of the plugin to review domains that have violated a directive in the CSP. Review each of the domains carefully and check for misspellings of common domains like adobee.com instead of adobe.com as this is a common way hackers inject content into your site.</p>
      <p>If you feel confident that the domain belongs on your site and it should be serving the file type stated click the toggle to approve the domain and include it in the CSP. If you want to allow subdomains of that domain to be able to serve that type of content click the include subdomains toggle.To learn more about the directive that was violated click the blue Directive button.</p>
      <p>After this process you might still see CSP violations regarding inline scripts, inline styles, blobs, or data. To allow these ths type of content in the community version you must navigate to the Directive Settings page, find the offending directive and toggle the appropriate option. For convenience, each option has a tool tip explaining what it allows in your CSP. Once domain and directive settings are done being configured the CSP can then be turned to blocking mode to protect the site.</p>

      <h3>Contributing</h3>
      <p>Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.</p>
      <p>The project can be found on github <a href="https://bluetrianglemarketing.github.io/SeaSP-Community-Edition/">SeaSP-Community-Edition</a>

      <h3>License</h3>
      <p><a href="https://choosealicense.com/licenses/gpl-3.0/">GNU General Public License v3.0</a></p>
    </div>
  </div>

</div>
</div>