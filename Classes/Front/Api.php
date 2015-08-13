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



		//init settings and connection before doing anything
		function __construct(){

			$this->setConnection();

		}


		/*=============================================================*/
		/**             Methods                                        */
		/*=============================================================*/


		/**
		 * Subscribe a user
		 * 
		 * @param  array $data
		 * @return bool
		 */
		public function subscribeUser( $data ){

			return $this->gateway->call('lists/subscribe', $data );

		}


		/**
		 * Returns an array of lists
		 * 
		 * @return array of mailchimp lists
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


			$this->apiKey = Settings::get( 'apiKey' );

			if( $this->apiKey ){

				$this->gateway = new MailChimp( $this->apiKey );

			}else{

				//log an error

			}

		}


	}
