<?php

	class qa_wp_widget {
		
		function allow_template($template)
		{
			return ($template!='admin');
		}

		
		function allow_region($region)
		{
			$allow=false;
			
			switch ($region)
			{
				case 'main':
				case 'side':
				case 'full':
					$allow=true;
					break;
			}
			
			return $allow;
		}

		
		function admin_form(&$qa_content)
		{
			$saved=false;
			
			if (qa_clicked('adsense_save_button')) {	
				$trimchars="=;\"\' \t\r\n"; // prevent common errors by copying and pasting from Javascript
				qa_opt('adsense_publisher_id', trim(qa_post_text('adsense_publisher_id_field'), $trimchars));
				$saved=true;
			}
			
			return array(
				'ok' => $saved ? 'AdSense settings saved' : null,
				
				'fields' => array(
					array(
						'label' => 'AdSense Publisher ID:',
						'value' => qa_html(qa_opt('adsense_publisher_id')),
						'tags' => 'name="adsense_publisher_id_field"',
						'note' => 'Example: <i>pub-1234567890123456</i>',
					),
				),
				
				'buttons' => array(
					array(
						'label' => 'Save Changes',
						'tags' => 'name="adsense_save_button"',
					),
				),
			);
		}


		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
			$themeobject->output('<div class="qa-wp-form-widget">');
			If( qa_is_logged_in() )
				$themeobject->nav('user');
			else{
			
				wp_login_form(array('redirect' =>  $_SERVER['REQUEST_URI'] ));
				$themeobject->output('<a href="'. wp_registration_url() . '&redirect_to=' . $_SERVER['REQUEST_URI'] . '">Register</a> | ' . '<a href="'. wp_lostpassword_url(  $_SERVER['REQUEST_URI'] ) . '">Forgot Password</a>' );
			}
			$themeobject->output('</div>');
		}
	
	}
	

/*
	Omit PHP closing tag to help avoid accidental output
*/