<?php
// Initialize wordpress core and the plugin
require_once(dirname(__FILE__) . '/../../../wp-config.php');
require_once(dirname(__FILE__) . '/wp-mpdf2.php');

// Disable timeout
set_time_limit(0);

// Run cron execution
$classname =  'Fkr\\WPMpdf2\\Admin\\Cron';
new $classname();
