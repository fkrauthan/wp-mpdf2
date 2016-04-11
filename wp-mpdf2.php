<?php
/*
Plugin Name: wp-mpdf
Plugin URI: http://fkrauthan.de/projects/php/wp-mpdf2.html
Description: Print a wordpress page as PDF.
Version: 1.0.0
Author: Florian 'fkrauthan' Krauthan
Author URI: http://fkrauthan.de
Text Domain: wp-mpdf2
Domain Path: /languages/

Copyright 2016  Florian Krauthan
*/

if (!defined('ABSPATH')) {
  header('Status: 403 Forbidden');
  header('HTTP/1.1 403 Forbidden');
  exit;
}

// Define plugin version
define('WPMPDF2_VERSION', '1.0.0');
define('WPMPDF2_DB_VERSION', '1');

// Define some static infos
if (!defined('WP_MPDF2_POSTS_TABLE'))
  define('WP_MPDF2_POSTS_TABLE', 'wp_mpdf2_posts');
}

// Remap mpdf tmp folders
define('_MPDF_TEMP_PATH', dirname(__FILE__) . '/tmp/');
define('_MPDF_TTFONTDATAPATH', dirname(__FILE__) . '/tmp/');

/**
 * @return Fkr\WPMpdf2\Plugin
 */
function wp_mpdf2() {
  static $instance;

  if(is_null($instance)) {
    $classname =  'Fkr\\WPMpdf2\\Plugin';
		$id = 0;
		$file = __FILE__;
		$dir = __DIR__;
		$name = 'wp-mpdf2';
		$version = WPMPDF2_VERSION;

    $instance = new $classname(
			$id,
			$name,
			$version,
			$file,
			$dir
		);
  }

  return $instance;
}

// wrapper function to move out of global namespace
function __load_wp_mpdf2() {
  // load autoloader & init plugin
	require dirname(__FILE__) . '/vendor/autoload.php';

  // fetch instance and store in global
	$GLOBALS['wp_mpdf2'] = wp_mpdf2();

	// register activation hook
	register_activation_hook(__FILE__, array( 'Fkr\\WPMpdf2\\Admin\\Installer', 'run'));
}

function __load_wp_mpdf2_fallback() {
	// load php 5.2 fallback
	require dirname(__FILE__) . '/fallback.php';

	new WPMPHPFallback('wp-mpdf2', plugin_basename(__FILE__));
}

if(version_compare(PHP_VERSION, '5.3', '>=')) {
	__load_wp_mpdf2();
} else {
	__load_wp_mpdf2_fallback();
}
