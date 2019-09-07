<?php
/*
Plugin Name: My WP Add-on WPS Hide Login
Plugin URI: https://mywpcustomize.com/add_ons/my-wp-add-on-wps-hide-login/‎
Description: My WP Add-on WPS Hide Login is apply to login general customize for My WP.
Version: 1.0
Author: gqevu6bsiz
Author URI: http://gqevu6bsiz.chicappa.jp/
Text Domain: mywp-wps-hide-login
Domain Path: /languages
My WP Test working: 1.12
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! class_exists( 'MywpWPSHideLogin' ) ) :

final class MywpWPSHideLogin {

  private static $instance;

  private function __construct() {}

  public static function get_instance() {

    if ( !isset( self::$instance ) ) {

      self::$instance = new self();

    }

    return self::$instance;

  }

  private function __clone() {}

  private function __wakeup() {}

  public static function init() {

    self::define_constants();

    add_action( 'mywp_start' , array( __CLASS__ , 'mywp_start' ) );

  }

  private static function define_constants() {

    define( 'MYWP_WPS_HIDE_LOGIN_NAME' , 'My WP Add-On WPS Hide Login' );
    define( 'MYWP_WPS_HIDE_LOGIN_VERSION' , '1.0' );
    define( 'MYWP_WPS_HIDE_LOGIN_PLUGIN_FILE' , __FILE__ );
    define( 'MYWP_WPS_HIDE_LOGIN_PLUGIN_BASENAME' , plugin_basename( MYWP_WPS_HIDE_LOGIN_PLUGIN_FILE ) );
    define( 'MYWP_WPS_HIDE_LOGIN_PLUGIN_DIRNAME' , dirname( MYWP_WPS_HIDE_LOGIN_PLUGIN_BASENAME ) );
    define( 'MYWP_WPS_HIDE_LOGIN_PLUGIN_PATH' , plugin_dir_path( MYWP_WPS_HIDE_LOGIN_PLUGIN_FILE ) );
    define( 'MYWP_WPS_HIDE_LOGIN_PLUGIN_URL' , plugin_dir_url( MYWP_WPS_HIDE_LOGIN_PLUGIN_FILE ) );

  }

  public static function mywp_start() {

    add_action( 'mywp_plugins_loaded', array( __CLASS__ , 'mywp_plugins_loaded' ) );

    add_action( 'init' , array( __CLASS__ , 'wp_init' ) );

  }

  public static function mywp_plugins_loaded() {

    add_filter( 'mywp_thirdparty_plugins_loaded_include_modules' , array( __CLASS__ , 'mywp_thirdparty_plugins_loaded_include_modules' ) );

  }

  public static function wp_init() {

    load_plugin_textdomain( 'mywp-wps-hide-login' , false , MYWP_WPS_HIDE_LOGIN_PLUGIN_DIRNAME . '/languages' );

  }

  public static function mywp_thirdparty_plugins_loaded_include_modules( $includes ) {

    $dir = MYWP_WPS_HIDE_LOGIN_PLUGIN_PATH . 'thirdparty/modules/';

    $includes['wps_hide_login'] = $dir . 'wps-hide-login.php';

    return $includes;

  }

}

MywpWPSHideLogin::init();

endif;
