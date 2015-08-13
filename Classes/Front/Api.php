<?php

	namespace ChefMailchimp\Front;

	use Drewm\MailChimp;

	class Api {

		/**
		 * The api key
		 * 
		 * @var string
		 */
		var $apiKey = false;

		/**
		 * The live connection
		 * 
		 * @var Mailchimp\Client
		 */
		var $gateway;


		/**
		 * An array holding all api-settings
		 * 
		 * @var array
		 */
		var $settings;


		//init settings and connection before doing anything
		function __construct(){

			$this->setSettings();
			$this->setConnection();

		}


		/*=============================================================*/
		/**             Methods                                        */
		/*=============================================================*/


		/**
		 * Returns an array of lists
		 * 
		 * @return [type] [description]
		 */
		public function getLists(){

			return $this->gateway->call( 'lists/list' );

		}



		/*=============================================================*/
		/**             Settings & Connection                          */
		/*=============================================================*/


		/**
		 * Set the api-connection
		 *
		 * @return mixed
		 */
		private function setConnection(){

			if( $this->apiKey ){

				$this->gateway = new MailChimp( $this->apiKey );

			}else{

				//log an error

			}

		}



		/**
		 * Set the settings object first
		 *
		 * @return void
		 */
		private function setSettings(){

			$defaults = array(

						'api_key'	=>	'641b0c128527e6ff414e420207f72b96-us3'

			);

			$this->settings = get_option( 'mailchimp_settings', $defaults );

			if( isset( $this->settings['api_key'] ) )
				$this->apiKey = $this->settings['api_key'];

		}


	}
