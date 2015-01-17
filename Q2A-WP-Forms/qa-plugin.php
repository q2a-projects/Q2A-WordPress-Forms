<?php

/*
	Plugin Name: Q2A-WordPress Forms
	Plugin URI: 
	Plugin Description: WordPress login forms in Question2Answer
	Plugin Version: 1.0.0
	Plugin Date: 2015-1-16
	Plugin Author: QA-Themes.com
	Plugin Author URI: http://QA-Themes.com/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI: 
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}


	qa_register_plugin_layer('qa-wp-layer.php', 'q2a wp login form layer');
	qa_register_plugin_module('widget', 'qa-wp-widget.php', 'qa_wp_widget', 'WordPress login form widget');
	qa_register_plugin_module('page', 'qa-wp-page.php', 'qa_wp_page', 'WordPress login form page');


/*
	Omit PHP closing tag to help avoid accidental output
*/