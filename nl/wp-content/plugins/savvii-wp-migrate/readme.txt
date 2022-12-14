=== Savvii WP Migrate ===
Contributors: blogvault, akshatc
Tags: savvii, migration
Requires at least: 4.0
Tested up to: 6.0
Requires PHP: 5.4.0
Stable tag: 4.78
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Migrating your site(s) to the Savvii WordPress Hosting platform has never been so easy. 

== Description ==

The Savvii WP Migrate plugin makes it very easy for you to migrate your site(s) to the Savvii Managed WordPress Hosting platform. The plugin takes care of everything, from copying all the data to transforming config files and importing this to the Savvii server. Just start the migration and the plugin will do all the heavy work!

[youtube https://www.youtube.com/watch?v=joKfuSmCmLw]
The above video will guide you through the migration process.

== Installation ==

= There are two ways to install the Savvii WP Migrate plugin: =

1. Download the plugin through the ‘Plugins’ menu in your WordPress admin panel.
2. Upload the savvii-wp-migrate folder to the /wp-content/plugins/ directory through sFTP.

After installing you need to activate the plugin.

== Frequently Asked Questions ==

You'll find the FAQ in the [Savvii Knowledge Base](https://support.savvii.com/support/solutions/articles/1000212596-faq-savvii-wp-migrate).

== Changelog ==
= 4.78 =
* Better handling for plugin, theme infos
* Sync Improvements

= 4.69 =
* Improved network call efficiency for site info callbacks.

= 4.68 =
* Removing use of constants for arrays for PHP 5.4 support.
* Post type fetch improvement.

= 4.65 =
* Robust handling of requests params.
* Callback wing versioning.

= 4.62 =
* MultiTable Sync in single callback functionality added.
* Improved host info
* Fixed services data fetch bug
* Fixed account listing bug in wp-admin

= 4.58 =
* Better Handling of error message from Server on signup

= 4.54 =
* Added Support for Multi Table Callbacks

= 4.4 =
* Updating Form UI

= 4.35 =
* Improved scanfiles and filelist api

= 4.31 =
* Fetching Mysql Version
* Robust data fetch APIs
* Core plugin changes
* Sanitizing incoming params

= 3.4 =
* Plugin branding fixes

= 3.2 =
* Updating account authentication struture

= 3.1 =
* Adding params validation
* Adding support for custom user tables

= 2.1 =
* Restructuring classes

= 1.88 =
* Callback improvements

= 1.86 =
* Updating tested upto 5.1

= 1.84 =
* Disable form on submit

= 1.82 =
* Updating tested upto 5.0

= 1.77 =
* Adding function_exists for getmyuid and get_current_user functions 

= 1.76 =
* Removing create_funtion for PHP 7.2 compatibility

= 1.72 =
* Adding Misc Callback

= 1.71 =
* Adding logout functionality in the plugin

= 1.69 =
* Adding support for chunked base64 encoding

= 1.68 =
* Updating upload rows

= 1.66 =
* Updating TOS and privacy policies

= 1.64 =
* Bug fixes for lp and fw

= 1.62 =
* SSL support in plugin for API calls
* Adding support for plugin branding

= 1.44 =
* Removed bv_manage_site
* Updated asym_key

= 1.41 =
* Better integrity checking
* Woo Commerce Dynamic sync support

= 1.40 =
* Manage sites straight from BlogVault dashboard

= 1.31 =
* Changing dynamic backups to be pull-based

= 1.30 =
* Using dbsig based authenticatation

= 1.22 =
* Adding support for GLOB based directory listings

= 1.21 =
* Adding support for PHP 5 style constructors

= 1.20 =
* Adding DB Signature and Server Signature to uniquely identify a site
* Adding the stats api to the WordPress Backup plugin.
* Sending tablename/rcount as part of the callback

= 1.17 =
* First release of Savvii Migration Plugin
