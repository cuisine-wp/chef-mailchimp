<?php

	namespace ChefMailchimp\Admin;

	use \Cuisine\Utilities\Url;
	use \Cuisine\Utilities\Sort;
	use \Cuisine\Utilities\Session;
	use \Cuisine\Wrappers\Field;
	use \Cuisine\Wrappers\SettingsPage;
	use \ChefForms\Wrappers\FormPanel;
	use \ChefMailchimp\Wrappers\Api;
	use \ChefMailchimp\Front\Settings;
	use \ChefMailchimp\Wrappers\StaticInstance;

	class SettingsPageBuilder extends StaticInstance{

		/**
		 * Init admin events & vars
		 */
		function __construct(){

			$this->settingsPage();

		}


		/**
		 * The settingspage used by this plugin
		 * 
		 * @return void
		 */
		private function settingsPage(){


			$fields = $this->getSettingsFields();
			$options = array(
				'parent'		=> 'form',
				'menu_title'	=> 'Mailchimp'
			);
	
	
			SettingsPage::make(
	
				'Mailchimp instellingen', 
				'mc-settings', 
				$options
	
			)->set( $fields );

		}



		/**
		 * Return all fields for the Mailchimp settings page:
		 * 
		 * @return array
		 */
		private function getSettingsFields(){

			//get the mailchimp lists:
			$lists = Api::getListArray();

			//create the fields array:
			$fields = array(

				0 => Field::text(
					'apiKey',
					'Api Key',
					array(
						'defaultValue'	=> Settings::get( 'apiKey' )
					)
				),


				2 => Field::checkbox(
					'doubleOptIn',
					'Double opt in?',
					array(
						'defaultValue'	=> Settings::get( 'doubleOptIn' )
					)
				),

				3 => Field::checkbox(
					'sendWelcome',
					'Send welcome message?',
					array(
						'defaultValue'	=> Settings::get( 'sendWelcome' )
					)
				)
			);

			//only add the list-selector if there are actually lists:
			if( !empty( $lists ) ){

				$fields[1] = Field::select(
					'defaultList',
					'Standaard Lijst',
					$lists,
					array(
						'defaultValue'	=> Settings::get( 'defaultList' )
					)
				);
			}

			ksort( $fields );
			return $fields;

		}

	



	}

	if( is_admin() )
		\ChefMailchimp\Admin\SettingsPageBuilder::getInstance();
