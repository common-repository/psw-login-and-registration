<?php
if (file_exists(plugin_dir_path( __FILE__ ) . 'vendor/autoload.php')) {
    require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
}
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.prositeweb.ca/
 * @since             1.0.0
 * @package           Prositegeneralfeatures
 *
 * @wordpress-plugin
 * Plugin Name:       PSW - Login and registration
 * Plugin URI:        https://www.prositeweb.ca/creation-de-compte-et-connexion-via-les-pages-du-sites-web/
 * Description:       PSW  - Login and registration is a plugin that will enable you to login or register on a wordPress website from the front-end. Enable the PSW - Login and register to improve security of your website
 * Version:           1.10
 * Author:            Prositeweb Inc.
 * Author URI:        https://www.prositeweb.ca/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prositegeneralfeatures
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PROSITEGENERALFEATURES_VERSION', '1.10' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-prositegeneralfeatures-activator.php
 */
function activate_prositegeneralfeatures() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prositegeneralfeatures-activator.php';
	Prositegeneralfeatures_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-prositegeneralfeatures-deactivator.php
 */
function deactivate_prositegeneralfeatures() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prositegeneralfeatures-deactivator.php';
	Prositegeneralfeatures_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_prositegeneralfeatures' );
register_deactivation_hook( __FILE__, 'deactivate_prositegeneralfeatures' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
 require plugin_dir_path( __FILE__ ) . 'admin/plugin_setting.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-prositegeneralfeatures.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_prositegeneralfeatures() {

	$plugin = new Prositegeneralfeatures();
	$plugin->run();

}
run_prositegeneralfeatures();

add_action('init', 'psw_register_rewrite_rules');
function psw_register_rewrite_rules() {
    add_rewrite_rule('^pswcallback$', 'index.php?pswcallback=1', 'top');
     add_rewrite_rule('^pswfbcallback$', 'index.php?pswfbcallback=1', 'top');
}

// Add a query var to capture the callback request
add_filter('query_vars', 'psw_add_query_vars');
function psw_add_query_vars($vars) {
    $vars[] = 'pswcallback';
     $vars[] = 'pswfbcallback';
    return $vars;
}

// Flush rewrite rules on plugin activation
register_activation_hook(__FILE__, 'psw_flush_rewrite_rules');
function psw_flush_rewrite_rules() {
    psw_register_rewrite_rules();
    flush_rewrite_rules();
}


