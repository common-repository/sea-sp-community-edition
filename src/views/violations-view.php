<?php
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$directives = Blue_Triangle_Automated_CSP_Free_Get_Directives();
$siteID = get_current_blog_id();
$Blue_Triangle_Automated_CSP_Free_Errors = Blue_Triangle_Automated_CSP_Free_Get_Violations($siteID,false);
$nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Approve_Nonce");
$adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
?>
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
              <li class="nav-item active">
                <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-csp-violations' )?>">Current Violations <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-directive-settings' )?>">Directive Settings</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-usage-settings' )?>">Usage Data Settings</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp-help-center' )?>">Help/Support</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row mb-4">
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
            <h3 class="mt-3">Current Violations</h3>
            <p>This report lists domains that have violated directives in your content security policy. Review each domain carefully to make sure it 
            a) belongs on your site and
            b) is allowed to serve up the type of content of the directive it has violated.</p>
            <p><b>Example:  </b><i>www.example.com violated script-src directive</i></p>
            <p>Ask yourself: does www.example.com belong on my site? If so, do I need it to put JavaScript on my site? If yes, you may approve the domain.</p>
            <p>The same method applies to the subdomains. You may treat the subdomains separately from the base domain and its other subdomains.</p>   
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
  <div class="col-md-12">
<?php
$tableMarkUp = '
<script>
var adminURL= "'.$adminURL.'";
var CSP_Directives = '.json_encode($directives).'
</script>
<table class="table table-striped table-dark" id="domain-approval-table">
<thead>
<tr>
    <th scope="col">Domain</th>
    <th scope="col">Status</th>
    <th scope="col">Subdomains</th>
    <th scope="col">Reported</th>
    <th scope="col">Directive</th>
    <th scope="col">Type</th>
    <th scope="col">File Name</th>
</tr>
</thead>
<tbody>
';

foreach($Blue_Triangle_Automated_CSP_Free_Errors as $index =>$directiveData){        
  $subDomainsEnabled = ($directiveData["subdomain"]=="true")?"checked":"";
  $domainsEnabled = ($directiveData["approved"]=="true")?"checked":"";
  $domain = $directiveData["domain"];
  $directive = $directiveData["violating_directive"];
  $tableMarkUp .='<tr>';
  $tableMarkUp .='<td>'.$domain."</td>";
  $tableMarkUp .='<td><input type="checkbox" '.$domainsEnabled.' 
  class="approve-domain-toggle"
  id="domain-tog-'.str_replace (".","",$domain).'-'.$directive.'"
  data-domain="'.$domain.'" 
  data-directive="'.$directive.'" 
  data-toggle="toggle"
  data-on="Approved" 
  data-off="Blocked" 
  data-onstyle="success" 
  data-offstyle="danger"
  data-size="small"
  ></td>';
  $tableMarkUp .='<td>
  <button id="subdomain-manage-'.str_replace (".","",$domain).'-'.$directive.'" data-toggle="modal" data-target="#subDomainModal" data-stardot="'.$subDomainsEnabled.'" data-domain="'.$domain.'" data-directive="'.$directive.'" class="btn btn-primary btn-sm managSubDomainButton">Manage</button>
  </td>';
  $tableMarkUp .='<td>'.date('m/d/Y', $directiveData["report_epoch"])."</td>";
  $tableMarkUp .='<td><button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Directive Insights" data-content="'.$directives[$directive]["directive_desc"].'">'.$directive.'</button></td>';
  $tableMarkUp .='<td>'.$directiveData["extension"]."</td>";
  $tableMarkUp .='<td>'.$directiveData["violating_file"]."</td>";
  $tableMarkUp .='</tr>';
    
}
$tableMarkUp .='</tbody>';
$tableMarkUp .='</table>';

$modalMarkup = '
<div class="modal fade" id="subDomainModal" tabindex="-1" role="dialog" aria-labelledby="subDomainModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title" id="exampleModalLabel">Manage subdomains for <span class="font-weight-bold" id="domainLabel"></span> violating <span class="font-weight-bold" id="directiveLabel"></span> directive</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="subdomainModalBody">
        Loading...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
';
echo $tableMarkUp.$modalMarkup;
?>
</div>
</div>