=== Android Push Notifications (GCM) ===
Contributors: varun1505
Donate link: http://varun1505.com/
Tags: push notifications, posts, publish posts
Requires at least: 3.5.1
Tested up to: 3.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin pushes a notification to all the registered devices when a new post is published.

== Description ==

This plugin pushes a notification to all the registered devices when a new post is published.
Whenever a new post is published, the plugin sends a push notification to all the registered Android Devices.
A device can be registered by the app developer using the API provided by the plugin.

Here's a link to the plugin on [GitHub](https://github.com/varun1505/wp-gcm-push-notifications "WP GCM Push Notificaions").

== Installation ==
Install it like any other wordpress plugin.
1. Download and install the plugin
1. Activate it from your WP-Admin Dashboard
1. Go to *Settings -> GCM Settings* and enter the API Key  (Sender ID) that you obtained from the Google API's console.
1. Thats it! You are good to go! Whenever you publish a post, a notification will be sent to registered devices


== Frequently Asked Questions ==

= How to register a device? =

You'll have to request the API to register the device as below
1. Obtain the Device ID for the device.
1. Send device id as follows: 
		*http://yourwebsite.com/gcm/register/&lt;your-device-id&gt;*
1. Now your device is registered.

= How to un-register a device? =

To un-register a device, send the device-id as follows:
http://yourwebsite.com/gcm/unregister/<your-device-id>


== Screenshots ==

1. The API Key (Sender Id) Needs to be entered in the Wp Admin Dashboard.

== Changelog ==

= 1.0 =
* First Version

== Upgrade Notice ==
* Nothing for now.