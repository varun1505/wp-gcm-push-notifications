<h1>Push notifications for WordPress blogs</h1>
<p>This plugin pushes a notification to all the registered devices when a new post is published.</p>

<h2>How to use?</h2>
<p>You have to use it just like any other wordpress plugin</p>
<ol>
	<li>Download and install the plugin</li>
	<li>Activate it from your WP-Admin Dashboard</li>
	<li>Go to <i>Settings -> GCM Settings</i> and enter the API Key  (Sender ID) that you obtained from the Google API's console. </li>
	<li>Thats it! You are good to go! Whenever you publish a post, a notification will be sent to registered devices</li>
</ol>

<h2>How to Register a device?</h2>
<p>You'll have to request the API to register the device as below</p>
<ol>
	<li>Obtain the Device ID for the device.</li>
	<li>
		Send device id as follows: <br/>
		<b>http://yourwebsite.com/gcm/register/&lt;your-device-id&gt; </b>
	</li>
	<li>Now your device is registered.</li>
</ol>

<h2>How to un-register a device?</h2>
<p> To un-register a device, send the device-id as follows: <br/>
<b>http://yourwebsite.com/gcm/unregister/&lt;your-device-id&lt; </b>

<h2>What else is coming to this plugin?</h2>
<ol>
	<li>Customizing the message that is sent to the device.</li>
	<li>Selecting post types from custom post types.</li>
	<li>Options for enabling push-notifications for more user-actions like new user added, comments, etc.</li>
</ol>