## === SeaSP Community Edition ===
Contributors: bluetriangle
Donate link: https://www.patreon.com/bluetriangle
Tags: csp, content security policy, security, http headers
Requires at least: 5.1
Tested up to: 5.8
Requires PHP: 7.0
Stable tag: 1.8.3
License: GPLv3 
License URI: https://choosealicense.com/licenses/gpl-3.0/
 
## == Description ==


SeaSP Community Edition is an automated **Content Security Policy Manager**. SeaSP allows you to create, configure, manage, and deploy a Content Security Policy for your site.

The WordPress SeaSP Community Edition plugin catalogs the domains that appear on your site. Categorize and filter out unwanted domains. Add a layer of WordPress security site from Magecart and other cross-site scripting attacks to keep your WordPress site safe.

SeaSP installs a strict non-blocking CSP to collect violation data and provide a violation report. Violation data flows into the WordPress database as a PHP option within the plugin options schema. Violations can be approved by domains and categorized by directives (CSS, fonts, images, JS, etc.). You can also approve base domains and subdomains. The SeaSP UI helps users by explaining what each directive does, and how to use them to create a CSP.

After configuring the domain and directive settings switch the CSP to blocking mode. Once the CSP goes into blocking mode, the site's protected from any unrecognized code. SeaSP Community Edition helps secure your site.

## == Installation ==

You can install this plugin directly from the WordPress Plugins menu. Otherwise, follow the instructions below:
1. Download and unzip the contents into the plugins folder of your WordPress instance.
2. Rename the folder from SeaSP-Community-Edition to sea-sp-community-edition if it is not already named so.
3. In the Admin Dashboard of WordPress click on the Plugins menu item on the left side.
4. Find SeaSP - Community Edition in the list of plugins and click activate. 
5. After activation there will be a new admin menu item with a white triangle that says SeaSP

Watch the walk through video [here](https://youtu.be/XdJNh6LEKJw) for more directions. 

## == Frequently Asked Questions ==
### What  is a Content Security Policy?
 
A Content Security Policy (CSP) is a browser security standard that controls the domains, subdomains, and types of resources a browser can load on a given web page. CSPs go into a special Content Security Policy header, or it can go on a web page using a meta tag. CSPs are compatible with all modern desktop and mobile browsers, including Chrome, Firefox, Internet Explorer, Edge, and Safari. CSPs detect and prevent certain types of attacks including form jacking and cross-site scripting, browser hijacking and ad injection, as well as unauthorized piggyback tags. 

SeaSP is an extra layer of security that protects your WordPress site from malicious attacks by blocking unauthorized scripts and content.

### What's next after my WordPress installation?

Once the plugin is installed, a strict non-blocking CSP will be automatically added onto your site. Visit each page of your site to collect CSP violations. The Current Violations page of the plugin collects domains that violate CSP directives and see what content is loading on your site.

Review the domains and click the toggle to approve and include it in the CSP. Check for misspellings of common domains like adobee.com instead of adobe.com. This is a common way hackers inject content into your site.

To review the subdomains, click the Manage button.

After this process, you might still see CSP violations for inline scripts, inline styles, blobs, or data. To allow this type of content navigate to the Directive Settings page and toggle the appropriate options (connect src, media src, child src, object src, frame ancestors, unsafe inline, etc.) Each option has a tooltip explaining what the directive allows in your CSP.

Once you are satisfied with your CSP, toggle the CSP to blocking mode under General Settings to secure your site.

### Is there a tutorial?

A walkthough of this plugin can be found [here](https://youtu.be/XdJNh6LEKJw)

### How does the plugin collect CSP violations?
The plugin inserts a small JavaScript code in the body of your site as a script tag. As the page loads, violations are collected and sent to the plugin via ajax using a nonce. These errors are parsed for the domains and directives they have violated. This data is stored in your WordPress database, prefixed. This data never leaves your site.

## == Screenshots ==

1. Current Violations page is where you review all the domains that have violated your CSP to add them to the policy for the given directive 
2. Directive Settings page is where you set source settings for each directive of your policy 

## == Changelog ==
 
# = 1.0 =
* Users can collect CSP violation data and approve violating domains to add them to their CSP
* All CSP terminology has been defined with tool tips 
* Users can set source settings for each of the directives of the CSP 

# = 1.1 =
* Fixed a bug where we misnamed a folder and cause bootstrap and other UI files to break
* Added a navigation menu to the top of the plugin for ease of use 
* After activation the plugin now directs to the landing page for more instructions 

# = 1.2 =
* Fixed broken images
* Cleaned up UI - spacing issues
* Edited text in the top for clearer instructions on how to use the plugin

# = 1.3 =
* Fixed problem with saving CSP data on a multi-site wordpress install
* Fixed incorrect version label on SeaSP plugin pages 

# = 1.4 =
* We completely changed the way we save data to the word press database so that our solution is more stable
* Instead of using the options table provided by Wordpress we add the following tables
*   seasp_violation_log - holds all the csp violations
*   seasp_directive_settings - holds all the csp directive settings 
*   seasp_allowed_plugins - this is for future support of object-src 
*   seasp_csp - this holds the actual CSP for versioning purposes 
*   seasp_directives - this is a definitions table for all the directives
*   seasp_directive_options - this is a definitions table for all directive options 
*   seasp_site_settings - this is a general settings table for things like post load delay 
*   seasp_sand_box_urls - this is for future support of the sand box directive 
* Multi-site Wordpress instances are now fully supported with the new database schema
* Added the ability to change the post load delay to capture more errors after page load 
* Added the ability to turn on and off error collection independent of placing the CSP in blocking mode

# = 1.4.1 =
* This update is a hotfix for a problem observed on a Safari Browser where directives did not fall back on default-src directive for https: setting
* To remedy this when ever a directive setting is changed https is automatically selected for you 

# = 1.4.2 =
* This update is to clarify copy and images on the WordPress.org SeaSP Plugin page.

# = 1.5.0 =
* Added an admin notice to alert how many unapproved domains are left to approve 
* Added admin notice to inform user that the CSP in in report only mode 
* Added admin notice to inform user SeaSP is collecting violation data 
* Fixed a bug where domains like  google.co.in were not getting added correctly 
* Began usage tracking to see how many people are using the plugin
* Fixed a bug were version number was not showing up on the plugin pages 

# = 1.8.0 =
* Fix a bug were tables did not use user defined table prefix
* Implemented the build in php function parse_url to parse violation URL's for domains 
* Created a new table to manage subdomains 
* Made a subdomain manager so that users can choose which sub domains to add to a directive
* Fixed a bug that would not let you set *.mydomain.com with out having mydomain.com
* Fixed a wordpress 5.7.1 jQuery load issue
* Improved error collection by placing the collection code in the footer

# = 1.8.1 =
* Fixed a type conversion issue
* Fixed an issue with duplicate entries in the violations log

# = 1.8.2 =
* Fixed issue where tables are dropped on deactivate instead of uninstall
* Added a check to prevent a SQL error when dropping tables on uninstall

# = 1.8.3 =
* Compatibility check for WordPress version 5.8
* Updated text contents
* Fixed an issue where the directive details would get cut off after 55 characters
* Fixed an issue where turning off directives doesn't update the directives table properly
* Fixed an issue where toggling off https: directive doesn't change the switch
* Fixed an issue where duplicate 'self' origins were showing up for default-src

## == Upgrade Notice for 1.4 only==
* When you install this version you will need to rebuild your CSP

## == Usage ==

Once installed, a strict non-blocking report-only CSP is implemented on your site. Visit each page of your site to collect CSP violations.
Visit the Current Violations page of the plugin to review domains that have violated a directive in the CSP.
Review each of the domains carefully and check for misspellings of common domains like adobee.com instead of adobe.com as this is a common way hackers inject content into your site.
If you feel confident that the domain belongs on your site and it should be serving the file type stated, click the toggle to approve the domain to include it in the CSP.
If you want to allow subdomains of that domain to be able to serve that type of content, click the Manage subdomains button to view the subdomains.
After this process, you might still see CSP violations regarding inline scripts, inline styles, blobs, or data.
To allow these this type of content in the community version you must navigate to the Directive Settings page, find the offending directive, then toggle the appropriate option.
For convenience, each option has a tooltip explaining what it allows in your CSP.

## == Walk Through ==
A walk through video can be found on YouTube [here](https://youtu.be/XdJNh6LEKJw).

https://youtu.be/XdJNh6LEKJw

## == Contributing ==
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
This project has been tested on WordPress up to version 5.8 on both single and multi-site instances.
The project can be found on [github](https://github.com/blue-triangle-tech/sea-sp-community-edition).
This project is sponsored by [Blue Triangle](www.bluetriangle.com).

## Third Party Libraries 
We use [Bootstrap](https://getbootstrap.com/) for the UI of our plugin to make the interface clean and simple.
Bootstraps license can be found [here](https://github.com/twbs/bootstrap/blob/main/LICENSE)

We use [bootstrap toggle](https://www.bootstraptoggle.com/) because simple check boxes can be confusing and we wanted our CSP mangers UI to feel easy. This code was developed for The New York Times by [Min Hur](https://github.com/minhur) and is licensed under [MIT](https://opensource.org/licenses/MIT)

## == License ==
[GNU](https://choosealicense.com/licenses/gpl-3.0/)

## == Opt In usage data collection ==

As of version 1.5 users will be able to opt-in for data collection to help us determine how many people are using our plugin and what features we should be working on in future version. This can be managed in the Usage Data Settings page. We collect and send the following data:
1. wordpress version
2. wordpress debug mode 
3. wordpress multisite 
4. the base url that the plugin is on ex; www.bluetriangle.com
This data is only accessible to the Blue Triangle organization and will be used to determine our user base and feature planning.