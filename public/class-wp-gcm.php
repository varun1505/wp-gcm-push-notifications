<?php
/**
 * WP GCM
 *
 * @package   WP_GCM
 * @author    Varun Srinivas <me@varun1505.com>
 * @license   GPL-2.0+
 * @link      http://varun1505.com
 * @copyright 2013 SudoSaints
 */

class WP_GCM {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 * @var      string
	 */
	protected $plugin_slug = 'wp-gcm';

	/**
	 * Instance of this class.
	 * @since    1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		
		// Load public-facing style sheet and JavaScript.
		/* add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) ); */
		
		add_filter ( 'query_vars', array($this,'wp_gcm_query_vars' ));
		
		add_action ( 'parse_request', array($this,'wp_gcm_parse_request' ));
		
		add_action ( 'generate_rewrite_rules', array($this, 'wp_gcm_rewrite_rules' ));

	}

	/**
	 * Return the plugin slug.
	 * @since    1.0.0
	 *@return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 * @since     1.0.0
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 * @since    1.0.0s
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		global $wpdb;
		
		$sql = '
		  CREATE TABLE '.$wpdb->prefix.'gcm_push (
			id int(11) NOT NULL auto_increment,
			gcm_id varchar(255) NOT NULL,
			PRIMARY KEY  (id)
		  )';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		//TODO: delete tables
	}

	/**
	 * Load the plugin text domain for translation.
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
	}
	
	function wp_gcm_query_vars($vars) {
		$new_vars = array (
				'gcm','action','gcm_id'
		);
		$vars = $new_vars + $vars;
		return $vars;
	}
	
	function wp_gcm_parse_request($wp) {
		global $wpdb;
		
		if (array_key_exists ( 'action', $wp->query_vars ) ){
			$action = $wp->query_vars['action'];
			$response = new Response();
			switch($action) {
				case 'register': 
						//Add device into the database
						$data = array('gcm_id' => $wp->query_vars['gcm_id']);
						$wpdb->insert($wpdb->prefix.'gcm_push', $data);
						$id = $wpdb->insert_id;
						$response->setSuccess(true);
						$response->setData(array(
								'id' => $id, 
								'gcm_id' => $wp->query_vars['gcm_id'],
								'message' => 'Device registered successfully.'
							));
					break;
				case 'unregister':
					$data = array('gcm_id' => $wp->query_vars['gcm_id']);
					$wpdb->delete($wpdb->prefix.'gcm_push', $data);
					$response->setSuccess(true);
					$response->setData(array(
							'gcm_id' => $wp->query_vars['gcm_id'],
							'message' => 'Device with GCM ID "' . $wp->query_vars['gcm_id'] . '" unregistered successfully.'
					));
					break;
				case 'invalid':
				default: 	
						$response->setSuccess(false);
						$response->setError(array('error'=>'Invalid Action'));
						$response->setData(array());
					break;
			}
			$response->respond();
			die();
		}
	}
	
	function wp_gcm_rewrite_rules($wp_rewrite) {
		$new_rules = array (
				"gcm/([^/]+)/([^/]+)" => "index.php?action=".$wp_rewrite->preg_index(1)."&gcm_id=".$wp_rewrite->preg_index(2),
				"gcm/([^/]+)" => "index.php?action=invalid"
		);
		$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
	}
}
