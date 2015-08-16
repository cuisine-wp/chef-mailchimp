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

		/**
		 * Return key-value pairs of list ID's and names
		 * 
		 * @return array of mailchimp lists
		 */
		public function getListArray(){

			$lists = Api::getLists();
			if( $lists ){
			
				$lists = $lists['data'];
				$lists = array_combine( 
								Sort::pluck( $lists, 'id' ),
								Sort::pluck( $lists, 'name' )
				);

				return $lists;
			
			}
			
			return array();
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
