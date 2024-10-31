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
            <li class="nav-item active">
                <a class="nav-link" href="<?=admin_url( 'admin.php?page=blue-triangle-free-csp' )?>">Dashboard <span class="sr-only">(current)</span></a>
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
<div class="row">
    <div class="col-xl-3 col-lg-6 mb-2">
        <div class="card sea-sp-green text-white">
            <img class="card-img" alt="Blue Triangle Logo" src="<?=$pluginDirectory?>img/seaSPIcon.png">
            <div class="card-img-overlay"style="top: auto; position: absolute; bottom: 0; right: 0; background-color: rgb(45 33 33 / 46%);height: 160px;">
                <h6 class="card-title">SeaSP - Community Edition</h6>
                <p class="card-text">Automated CSP Manger</p>
                <p class="card-text">Version <?=$versionNumber?> <br>Powered By: <a href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="">
                <!--<h4 class="card-text">Upgrade your Arrr'senal to protect your booty!<a href="https://www.bluetriangle.com/blue-triangles-csp-wordpress-plugin-seasp/" class="btn btn-warning">Upgrade Your SeaSP today!</a></h4>-->
                <div class="card-body">
                    <h3 class="mt-3">Dashboard</h3>
                <h5 class="card-title">Thank you for securing your site with Blue Triangle's SeaSP Content Security Policy Manager. </h5>
                <p class="card-subtitle mb-2 text-muted">This Content Security Policy or CSP protects your site from hackers by adding an additional layer of security.</h3>
                <p class="card-text">This layer helps keep you and your customers safe by detecting and mitigating certain types of attacks, including Cross Site Scripting (XSS) and data injection attacks.</p>
                <p class="card-text">Implementing a Content Security Policy (CSP) can be a tedius task, so Blue Triangle's SeaSP automates the process for you into three easy steps!</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-12">
        <div style="background: #efefef; padding: 20px; height: 100%;" class="text-center">
        <img style="width: 100px; height: auto; float: left; margin-right: 10px;" src="<?=$pluginDirectory?>img/starfish.png">
            <h5 class="text-left mt-2">We would love your feedback!</h5>

            <p class="mt-5">We're working to grow SeaSP and we would love your feedback.</p>
            <p>Have a suggestion? <a target="_blank" href="https://wordpress.org/support/plugin/sea-sp-community-edition/" class="pink-text">We're all ears!</a></p>
              <p>If you like SeaSP, please leave us a review:</p><a target="_blank" href="https://wordpress.org/plugins/sea-sp-community-edition/#reviews" class="btn btn-warning">Leave a Review</a>
          </div>
      </div>
</div>
<div class="container-fluid">
<div class="row mt-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card three-steps">
                <div class="d-flex flex-row card-head">
                    <img class="card-img-top" style="height: 50px; width: 55px; float: left;" src="<?=$pluginDirectory?>img/Fish-net.png" alt="Card image cap">
                    <p class="card-title" style="float: left; display: inline;">Step 1: Capture</p>
                </div>
                <div class="card-body">
                    <p class="card-text">By using report-only mode, the plugin captures violation data necessary to build your CSP.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1. Visit each page of your site to collect violations.</li>
                    <li class="list-group-item">2. Violations are automatically captured and saved.</li>
                    <li class="list-group-item">Report-only mode will keep your site working while you build your CSP. Use this for testing or initial setups.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card three-steps">
                <div class="d-flex flex-row card-head">
                    <img class="card-img-top" style="height: 50px; width: 30px; float: left;" src="<?=$pluginDirectory?>img/Ink-and-quill.png" alt="Card image cap">
                    <p class="card-title" style="float: left; display: inline;">Step 2: Create</p>
                </div>
                <div class="card-body">
                    <p class="card-text">We create a Current Violations report with the violations that appeared during the capture phase. The report will give you the details on each violation and allow you to decide what to allow or block.</p>
                    <a href="<?=admin_url();?>admin.php?page=blue-triangle-free-csp-csp-violations" class="card-link">View your Current Violation report here.</a>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1. Collected violations will be added to the report where it is available for review.</li>
                    <li class="list-group-item">2. You can whitelist the base domain and/or its subdomains.</li>
                    <li class="list-group-item">3. Each domain is only approved/blocked for the directive it violated. The same domains may appear but for different directives.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card three-steps">
                <div class="d-flex flex-row card-head">
                    <img class="card-img-top" style="height: 50px; width: 30px; float: left;" src="<?=$pluginDirectory?>img/Parrot.png" alt="Card image cap">
                    <p class="card-title" style="float: left; display: inline;">Step 3: Automate</p>
                </div>
                <div class="card-body">
                    <p class="card-text">SeaSP automatically generates the CSP from these reports and continually updates itself to keep your site safe.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1. Your site's CSP is automatically generated each time a new violation is collected, you approve a domain, or modify a directive.</li>
                    <li class="list-group-item">2. Once you are satisfied with your security policy, you can change the mode from report-only to blocking in <a href="<?=admin_url();?>admin.php?page=blue-triangle-free-csp-general-settings" class="card-link">General Settings</a>.</li>
                    <li class="list-group-item">3. Your site is now secure! You can switch back and forth between report-only and blocking at any time.</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Blogs:</h3>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card">
                <img class="card-img-top" src="<?=$pluginDirectory?>img/blog-images/blog-01.png" alt="What Kinds of Hacking Can a Content Security Policy Stop?">
                <div class="card-body">
                    <h5 class="card-title">What Kinds of Hacking Can a Content Security Policy Stop?</h5>
                    <p class="card-text">Myths and legends surround and sometimes obscure what a content security policy (CSP) is and how it can protect your website. The power of a CSP is noteworthy, but it is not an end-all...</p>
                    <a rel="noopener noreferrer" target="_blank" href="https://blog.bluetriangle.com/what-kinds-of-hacking-can-a-content-security-policy-stop" class="btn btn-primary">Continue Reading</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card">
                <img class="card-img-top" src="<?=$pluginDirectory?>img/blog-images/blog-02.png" alt="How to find out if a Site has a Content Security Policy (CSP) deployed">
                <div class="card-body">
                    <h5 class="card-title">How to find out if a Site has a Content Security Policy (CSP) deployed</h5>
                    <p class="card-text">How to Find Out If a Site Has a Content Security Policy (CSP) Deployed</p>
                    <a rel="noopener noreferrer" target="_blank" href="https://blog.bluetriangle.com/how-to-find-out-if-a-site-has-a-content-security-policy-csp-deployed" class="btn btn-primary">Continue Reading</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
            <div class="card">
            <img class="card-img-top" src="<?=$pluginDirectory?>img/blog-images/blog-03.png" alt="Legal and Operational Risks of Piggyback Tags, Part 1: What the Heck Are They and Why Should I Care?">
                <div class="card-body">
                    <h5 class="card-title">Legal and Operational Risks of Piggyback Tags, Part 1: What the Heck Are They and Why Should I Care?</h5>
                    <p class="card-text">What Are Tags? Every business website has “Tags” – they are the pixel or code mechanisms that facilitate the collection and sharing of data between your website and the services you rely...</p>
                    <a rel="noopener noreferrer" target="_blank"  href="https://blog.bluetriangle.com/piggyback-tags-legal-and-operational-risks-part-1" class="btn btn-primary">Continue Reading</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
            <div class="card" >
                <img class="card-img-top" src="<?=$pluginDirectory?>img/BT-blog.png" alt="View More Blue Triangle Blogs">
                <div class="card-body">
                    <h5 class="card-title">More Blogs</h5>
                    <p class="card-text">View more free blogs about security and performance here.</p>
                    <a rel="noopener noreferrer" target="_blank" href="https://blog.bluetriangle.com/" class="btn btn-primary">View More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3>Webinars:</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
            <div class="card" >
                <img class="card-img-top" src="<?=$pluginDirectory?>img/webinar/web-01.png" alt="Unlocking the Myths and Mysteries of Content Security Policies (CSPs)">
                <div class="card-body">
                    <h5 class="card-title">Unlocking the Myths and Mysteries of Content Security Policies </h5>
                    <p class="card-text">Advanced level discussions into the protections, false assumptions, misunderstandings and misconceptions of a Content Security Policy. An open dialogue on the benefits, limitations and cautions of utilizing a CSP in protecting your site from supply chain attacks like Magecart.</p>
                    <a rel="noopener noreferrer" target="_blank" href="https://www.bluetriangle.com/resources/webinars/myths-mysteries-csp/" class="btn btn-primary">Continue Reading</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
            <div class="card">
                <img class="card-img-top" src="<?=$pluginDirectory?>img/webinar/web-02.png" alt="Defend Your Site Against Cross Site Scripting and Other Supply Chain Attacks During COVID-19 Featuring F5">
                <div class="card-body">
                    <h5 class="card-title">Defend Your Site Against Cross Site Scripting and Other Supply Chain Attacks During COVID-19 Featuring F5</h5>
                    <p class="card-text">About the Webinar The second part in a four-part webinar series on tag governance. With more business than ever transacting online, cyber criminals are seizing the opportunity to capitalize. In this webinar industry experts discuss how</p>
                    <a rel="noopener noreferrer" target="_blank" href="https://www.bluetriangle.com/resources/webinars/cybercriminals-covid/" class="btn btn-primary">Continue Reading</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
            <div class="card">
            <img class="card-img-top" src="<?=$pluginDirectory?>img/webinar/web-03.png" alt="Office Hours with Blue Triangle: Coffee and Content Security Policies">
                <div class="card-body">
                    <h5 class="card-title">Office Hours with Blue Triangle: Coffee and Content Security Policies</h5>
                    <p class="card-text">Join Blue Triangle as we have an open discussion on protections around Magecart and other Supply Chain attacks.</p>
                    <a rel="noopener noreferrer" target="_blank"  href="https://www.bluetriangle.com/resources/webinars/office-hours-coffee-and-csp/" class="btn btn-primary">Continue Reading</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
            <div class="card">
                <img class="card-img-top" src="<?=$pluginDirectory?>img/BT-Webinars.png" alt="View More Blue Triangle Webinars">
                <div class="card-body">
                    <h5 class="card-title">More Webinars</h5>
                    <p class="card-text">View more free Webinars about security and performance here.</p>
                    <a rel="noopener noreferrer" target="_blank" href="https://www.bluetriangle.com/resources/webinars/" class="btn btn-primary">View More</a>
                </div>
            </div>
        </div>
    </div>
</div>