<?php

class qa_html_theme_layer extends qa_html_theme_base {
	function doctype()
	{
		qa_html_theme_base::doctype(); // call back through to the default function
		if(qa_opt('qa_wp_login_form_page_on') && qa_opt('qa_wp_login_form_page_link')){
			$login_form_url = qa_opt('qa_wp_login_form_page_link_url');
			if(empty($login_form_url))
				$login_form_url = 'user_login';
			
			//$topath=qa_get('to');
			//global $qa_request;
			//if(! isset($topath))
			//	$topath = qa_path($qa_request, $_GET, '');
			$this->content['navigation']['user']['login']['url'] = qa_path_html($login_form_url); //. '&to=' . $topath;
		}
	}
	function nav_user_search() // outputs login form if user not logged in
	{
		if(defined('QA_WORDPRESS_INTEGRATE_PATH') && qa_opt('qa_wp_login_form_nav') && (! qa_is_logged_in()) ){
			$this->output('<div class="wp-login-holder">');
			wp_login_form(array('redirect' =>  $_SERVER['REQUEST_URI'] ));
			$this->output('<a href="'. wp_registration_url() . '&redirect_to=' . $_SERVER['REQUEST_URI'] . '">Register</a> | ' . '<a href="'. wp_lostpassword_url(  $_SERVER['REQUEST_URI'] ) . '">Forgot Password</a>' );
			$this->output('</div>');
			unset($this->content['navigation']['user']['login']);
			unset($this->content['navigation']['user']['register']);
		}else
			qa_html_theme_base::nav_user_search();		
	}
}

/*
	Omit PHP closing tag to help avoid accidental output
*/