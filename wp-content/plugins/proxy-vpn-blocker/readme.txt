=== Proxy & VPN Blocker ===
Contributors: rickstermuk
Tags: security, proxy blocker, vpn blocker, proxy, vpn, proxycheck, login, signup, comment, anti spam, spam, anti-spam
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=me%40ricksterm%2enet&lc=GB&item_name=WordPress%20Proxy%20%26%20VPN%20Blocker%20Plugin%20Donations&currency_code=USD&bn=PP%2dDonationsBF%3appbutton%2epng%3aNonHosted
Requires at least: 4.9.0
Tested up to: 4.9.5
Requires PHP: 5.6
Stable tag: 1.3.1
License: GPLv2

This plugin will stop Proxies and VPN's accessing your site login page or making comments on pages & posts using the proxycheck.io API.

== Description ==
Using the [proxycheck.io](https://proxycheck.io) API this plugin will prevent Proxies and optionally VPN's accessing your WordPress site's Login & Registration pages and also prevent them from making comments on your pages and posts. This will also help to prevent spammers as many of them use Proxies to hide their true location.

The plugin supports caching of known good IP addresses so they don't have to be rechecked for 30 minutes this will help with site speed, especially if blocking on all pages is enabled. Proxy and VPN IP addresses wil not be cached and will be checked every time they visit, this is to enable accurate information on blocked proxies and VPN's in your proxycheck.io statistics.

This plugin can be used without a proxycheck.io API key, however it would be limited to 100 daily queries. You can get a free API key from proxycheck.io that allows for 1000 free daily queries, ideal for small WordPress sites!

Please see below how the API plans work.

Free Users without an API Key = 100 Daily Queries
Free Users with an API Key = 1000 Daily Queries
Paid Users with an API Key = 10,000 to 10.24 Million+ Daily Queries

Disclaimer: This plugin is *not* made by proxycheck.io despite being recommended by the company, if you need support with the Proxy & VPN Blocker plugin please use the WordPress Support page for this plugin and not proxycheck.io support on their website, unless you have a query relating to the proxycheck.io API, service or your account. Likewise the plugin developer does not provide support for issues relating to your proxycheck.io account or the API. The plugin developer and proxycheck.io are not the same entity. Logo used with express permission.

== Installation ==
Installing "Proxy & VPN Blocker" can be done either by searching for "Proxy & VPN Blocker" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
=What is Proxy & VPN Blocker for?=

This plugin is designed to make integrating proxycheck.io Proxy and VPN detection with WordPress really simple. Otherwise integration would require editing core WordPress files.

=What is proxycheck.io?=

Proxycheck.io is a simple, accurate and reliable API for the detection and blocking of Proxy & VPN servers.

=Blocking Proxies and VPN's on all pages?=

Although this plugin now has an option to block Proxies & VPN's on all pages, this option is not generally recommended due to significantly higher query usage, but was added on user request.

It is important to note that if you are using a WordPress caching plugin (eg WP Super Cache, WP Rocket, W3 Total Cache and many others), these will prevent the Proxy or VPN from being blocked if you are using 'Block on all pages' as the caching plugin will likely serve the visitor a static cached version of your website pages. As the cached pages are served by the caching plugin in static HTML, the code for proxy detection will not run on these cached pages. This won't affect the normal protections this plugin provides for Log-in, Registration and commenting.

=I accidently locked myself out by blocking my own country, what do I do?=
The fix is simple, upload a .txt file called disablepvb.txt to your wordpress root directory, PVB looks for this file when the proxy and VPN checks are made, if the file exists it will prevent the plugin from contacting the proxycheck.io API. You will now be able to log in and remove your country in the PVB Settings.

Remember: If you ever have to do this, delete the disablepvb.txt file after you are done! If you don't remove it, the plugin wont be protecting your site.

== Screenshots ==
1. Options UI
2. Error message shown when a proxy or vpn is intercepted, this can be changed in the options.
3. API Key Stats page.

== Changelog ==

= 1.3.1 =
* 2018-05-16
* fixed an issue where the plugin was not setting its new version number to the database on update.
* fixed a minor issue with percentages not being rounded on the information page.

= 1.3.0 =
* 2018-05-15
* Added the ability to block entire countries if desired, this uses the proxycheck.io data to determine location of the visitor, but note that this will not show up in your statistics due to this check being done within the plugin.
* Altered the API Key Information page to display key, proxycheck.io plan, Queries remaining today, and 30 days stats in a line graph.
* Fixed a minor issue effecting PHP versions prior to v5.6 on the API key Information page, although the plugin is made for PHP v5.6+ this fixes the bug on prior versions on this page.

= 1.2.1 =
* 2018-05-01
* Known good IP addresses will now get cached for 30 minutes this is to reduce API Queries and site latency on rechecks for legitimate users. Proxy and VPN IP's will not get cached and will be rechecked every time they attempt to visit protected pages.
* Fixed caching issue where Denied pages could potentially be served to other people using the site when 'block on all pages' is enabled while using a Cache Plugin.
* Added warning about Block On All Pages and the use of page caching plugins, please see the FAQ.
* Improved the styling of the settings pages further.

= 1.2.0 =
* 2018-04-17
* Added IP country to stats page
* Extended stats page to show positive detections from the last 100 queries instead of 50
* Added toggle to block Proxies/VPN's on all pages (Note this is at the expense of significantly higher query usage)
* Added slider that enables setting the amount of days from 1 to 60 (default 7) that an IP will be checked for Proxy/VPN history so that you can set your level of security.

= 1.1.0 =
* 2018-01-12
* Updated plugin to support the new proxycheck.io v2 API
* Fixed a bug that caused an error when enabling the Cloudflare option but not having Cloudflare enabled for the domain
* Improved plugin options panel UI
* Added a toggle to disable querying the proxycheck.io API without having to deactivate the plugin
* Added a API Key statistics page that uses data from the proxycheck.io dashboard API if you specify an API Key (This does not use your queries!)

= 1.0.2 =
* 2017-12-28
* Added support for WooCommerce Login Forms for aesthetic reasons
* improved access denied page
* removed unecessary scripts

= 1.0.1 =
* 2017-12-25
* Fixed an issue with site login
* Switched from cURL to official WordPress HTTP API for querying the proxycheck.io API

= 1.0 =
* 2017-12-22
* Initial release