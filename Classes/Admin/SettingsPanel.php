<?php

	namespace ChefMailchimp\Admin;

	use \Cuisine\Utilities\Url;
	use \Cuisine\Utilities\Sort;
	use \Cuisine\Utilities\Session;
	use \Cuisine\Wrappers\Field;
	use \Cuisine\Wrappers\SettingsPage;
	use \ChefForms\Wrappers\SettingsPanel;
	use \ChefMailchimp\Wrappers\Api;
	use \ChefMailchimp\Front\Settings;
	use \ChefMailchimp\Wrappers\StaticInstance;

	class SettingsPanelBuilder extends StaticInstance{

		/**
		 * Init admin events & vars
		 */
		function __construct(){

			$this->formPanel();

		}


		/**
		 * Listen for admin events
		 * 
		 * @return void
		 */
		private function formPanel(){

			if( Settings::get( 'apiKey' ) ){

				$icon = Url::plugin( 'chef-mailchimp/Assets/images/icon.png', false );
				$fields = $this->getPanelFields();
				$options = array(
	
					'icon' => $icon,
					'content' => 'Stel hier de opties voor je Mailchimp koppeling in.'

				);
		
				SettingsPanel::make( 'mailchimp', 'Mailchimp', $options )->set( $fields );	
			}

		}


		/**
		 * Get all settings-fields for mailchimp
		 * 
		 * @return void
		 */
		private function getPanelFields(){


			//get the mailchimp lists:
			$lists = $this->getLists();

			return array(

				Field::checkbox( 
					'mc_to_mailchimp',
					'Meld inzending aan bij mailchimp',
					array(
						'defaultValue'	=> 'false'
					)
				),

				Field::mapper(
					'mc_email',
					'In welk veld staat het E-mailadres?',
					array(
						'included_types' => array( 'email' ),
						'required'	=> true,
						'form_id'	=> Session::postId()
					)
				),

				Field::mapper(
					'mc_name',
					'In welk veld staat de Naam?',
					array(
						'form_id'	=> Session::postId()
					)
				),

				Field::mapper(
					'mc_first_name',
					'In welk veld staat de Voornaam?',
					array(
						'form_id'	=> Session::postId(),
						'defaultValue'	=> 'none'
					)

				),
				Field::mapper(
					'mc_last_name',
					'In welk veld staat de Achternaam?',
					array(
						'form_id'	=> Session::postId(),
						'defaultValue'	=> 'none'
					)
				),

				Field::select(
					'mc_to_list',
					'Onder welke lijst?',
					$lists,
					array(
						'defaultValue'	=> Settings::get( 'defaultList' )
					)
				)



			);

		}


		/**
		 * Returns a list of active mailchimp mailinglists
		 * 
		 * @return array
		 */
		private function getLists(){

			$lists = Api::getLists();
			if( $lists ){
			
				$lists = $lists['data'];
				$lists = array_combine( 
								Sort::pluck( $lists, 'id' ),
								Sort::pluck( $lists, 'name' )
				);
			}
			
			return $lists;

		}



	}

	if( is_admin() )
		\ChefMailchimp\Admin\SettingsPanelBuilder::getInstance();
