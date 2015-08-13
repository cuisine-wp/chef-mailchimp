<?php

	namespace ChefMailchimp\Admin;

	use \Cuisine\Utilities\Url;
	use \Cuisine\Wrappers\Field;
	use \ChefMailchimp\Wrappers\Api;
	use \ChefMailchimp\Wrappers\StaticInstance;

	class EventListeners extends StaticInstance{

		/**
		 * Init admin events & vars
		 */
		function __construct(){

			$this->listen();

		//	$this->settingsPage();

		}

		/**
		 * Listen for admin events
		 * 
		 * @return void
		 */
		private function listen(){


			add_action( 'admin_init', function(){
				
				//do something

				cuisine_dump( Api::getLists() );
				die();


			});

		}


		/**
		 * The settingspage used by this plugin
		 * 
		 * @return void
		 */
		private function settingsPage(){
/*
			$options = array(
				'parent'		=> 'form',
				'menu_title'	=> 'Mailchimp'
			);

			$fields = array(

				Field::text(
					'apikey',
					'Api Key',
					array(
						'defaultValue'	=> ''
					)
				),

				Field::checkbox(
					'double_opt_in',
					'Double opt in?',
					array(
						'defaultValue'	=> 'true'
					)
				),

				Field::checkbox(
					'send_welcome',
					'Send welcome message?',
					array(
						'defaultValue'	=> 'true'
					)
				)
			);

			SettingsPage::make(

				'Mailchimp instellingen', 
				'mc-settings', 
				$options

			)->set( $fields );
*/
		}



	}

	if( is_admin() )
		\ChefMailchimp\Admin\EventListeners::getInstance();
