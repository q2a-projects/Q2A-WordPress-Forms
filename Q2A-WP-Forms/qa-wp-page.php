<?php

	class qa_wp_page {
		
		var $directory;
		var $urltoroot;
		

		function load_module($directory, $urltoroot)
		{
			$this->directory=$directory;
			$this->urltoroot=$urltoroot;
		}

		
		function suggest_requests() // for display in admin interface
		{
			if (! qa_opt('qa_wp_login_form_page_on'))
				return array();
				
			$login_form_url = qa_opt('qa_wp_login_form_page_link_url');
			if(empty($login_form_url))
				$login_form_url = 'user_login';
			return array(
				array(
					'title' => 'WP Login page',
					'request' => $login_form_url,
					'nav' => null, // 'M'=main, 'F'=footer, 'B'=before main, 'O'=opposite main, null=none
				),
			);
		}

		
		function match_request($request)
		{
			$login_form_url = qa_opt('qa_wp_login_form_page_link_url');
			if(empty($login_form_url))
				$login_form_url = 'user_login';
				
			if ($request==$login_form_url)
				return true;

			return false;
		}

		
		function process_request($request)
		{
			$qa_content=qa_content_prepare();

			$qa_content['title']=qa_lang_html('example_page/page_title');
			//$qa_content['error']='An example error';
			var_dump($_SERVER);
			$form = wp_login_form( array(
					'echo'           => false,
					'redirect'       => $_SERVER['HTTP_REFERER'], //site_url( $_SERVER['REQUEST_URI'] ), 
					//'form_id'        => 'loginform',
					//'label_username' => __( 'Username' ),
					//'label_password' => __( 'Password' ),
					//'label_remember' => __( 'Remember Me' ),
					//'label_log_in'   => __( 'Log In' ),
					//'id_username'    => 'user_login',
					//'id_password'    => 'user_pass',
					//'id_remember'    => 'rememberme',
					//'id_submit'      => 'wp-submit',
					//'remember'       => true,
					//'value_username' => NULL,
					//'value_remember' => false
				)
			);
			$qa_content['custom'] = $form;

			return $qa_content;
		}

		
		function option_default($option)
		{
			if ($option=='qa_wp_login_form_page_link_url')
				return 'user_login';
			if ($option=='qa_wp_login_form_page_link_url')
				return 'user_login';
		}

		function admin_form(&$qa_content)
		{
			$saved=false;
			
			if (qa_clicked('qa_wp_login_form_save_button')) {
				qa_opt('qa_wp_login_form_page_on', (int)qa_post_text('qa_wp_login_form_page_on'));
				qa_opt('qa_wp_login_form_page_link', (int)qa_post_text('qa_wp_login_form_page_link'));
				qa_opt('qa_wp_login_form_page_link_url', qa_post_text('qa_wp_login_form_page_link_url'));
				qa_opt('qa_wp_login_form_nav', (int)qa_post_text('qa_wp_login_form_nav'));
				$saved=true;
			}
			
			qa_set_display_rules($qa_content, array(
				'qa_wp_login_form_change_link' => 'qa_wp_login_form_page_on',
				'qa_wp_login_form_link_url' => 'qa_wp_login_form_page_on',
			));
			
			return array(
				'ok' => $saved ? 'Settings saved' : null,
				
				'fields' => array(
					array(
						'label' => 'Enable Login Page in Q2A',
						'type' => 'checkbox',
						'value' => qa_opt('qa_wp_login_form_page_on'),
						'tags' => 'name="qa_wp_login_form_page_on" id="qa_wp_login_form_page_on"',
					),
					array(
						'id' => 'qa_wp_login_form_change_link',
						'label' => 'Replace default login link with new page\'s link',
						'type' => 'checkbox',
						'value' => (int)qa_opt('qa_wp_login_form_page_link'),
						'tags' => 'name="qa_wp_login_form_page_link"',
					),
					array(
						'id' => 'qa_wp_login_form_link_url',
						'label' => 'Replace default login link with new page\'s link',
						'value' => qa_opt('qa_wp_login_form_page_link_url'),
						'tags' => 'placeholder="user_login" name="qa_wp_login_form_page_link_url"',
					),
					
					array(
						'id' => 'qa_wp_login_form_nav',
						'label' => 'Add WordPress\'s login form to default User Navigation',
						'type' => 'checkbox',
						'value' => qa_opt('qa_wp_login_form_nav'),
						'tags' => 'placeholder="login" name="qa_wp_login_form_nav"',
					),
				),
				
				'buttons' => array(
					array(
						'label' => 'Save Changes',
						'tags' => 'name="qa_wp_login_form_save_button"',
					),
				),
			);
		}
	}
	

/*
	Omit PHP closing tag to help avoid accidental output
*/