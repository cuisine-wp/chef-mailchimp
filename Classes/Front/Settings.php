<?php

	namespace ChefMailchimp\Front;

	class Settings{


		/**
		 * Get a setting
		 * 
		 * @param  string $key
		 * @return mixed
		 */
		public static function get( $key ){

			$settings = self::findSettings();

			if( isset( $settings[ $key ] ) )
				return $settings[ $key ];

			return false;

		}



		/**
		 * Get the settings
		 * 
		 * @return array
		 */
		private static function findSettings(){

			$defaults = array(

						'apiKey'		=>	false,
						'defaultList'	=> 	false,
						'doubleOptIn'	=>  'true',
						'sendWelcome'	=>  'true'

			);


			return get_option( 'mc-settings', $defaults );

		}



	}

