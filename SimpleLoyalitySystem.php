<?php
/**
 * Plugin Name: SimpleLoyalitySystem
 * Plugin URI: https://woocommerce.com/
 * Description: Plugin for woocommerce adding SimpleLoyality System.
 * Version: 1.0.0
 * Author: JasiuWordpress
 * Author URI: https://woocommerce.com
 * Text Domain: simpleloyality
 * Domain Path: /i18n/languages/
 * Requires at least: 6.6
 * Requires PHP: 7.4
 *
 */

require_once plugin_dir_path(__FILE__) . 'adminpanel.php';


add_action('admin_enqueue_scripts', 'SimpleLoyalty_enqueue_admin_scripts');

