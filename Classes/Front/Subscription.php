<?php

	namespace ChefMailchimp\Front;

	use \ChefMailchimp\Wrappers\Api as McApi;

	class Subscription {

	
		/**
		 * Make a new subscription
		 * 
		 * @param  Object $form
		 * @param  Object $entry
		 * 
		 * @return mixed ( true or json-error object)
		 */
		public static function make( $form, $entry ){

			$mc_enabled = get_post_meta( $form->id, 'mc_to_mailchimp', true );

			if( !$mc_enabled || $mc_enabled == 'false' )
				$mc_enabled = self::getCheck( $form, $entry );


			if( $mc_enabled == 'true' || $mc_enabled == true ){

				//get the values out of this entry:
				$entry_val = self::getEntryValues( $form, $entry );

				//don't send if the email-var is empty:
				if( $entry_val['email'] !== '' ){

					//build the data array
					$data = array(
						'id'			=> $entry_val['list_id'],
						'email'			=> array( 'email' => $entry_val['email'] ),
						'merge_vars'	=> array(
												'FNAME'=> $entry_val['fname'], 
												'LNAME'=> $entry_val['lname']
											),
						'double_optin'      => Settings::get( 'doubleOptIn' ),
						'update_existing'   => false,
						'replace_interests' => false,
						'send_welcome'      => Settings::get( 'sendWelcome' ),
					);


					//subscribe:
					$response = McApi::subscribeUser( $data );

					//errorhandeling if stuff goes sour:
					if( !isset( $response['euid'] ) )
						$form->message = self::getError( 'mailchimp' );


				}else{

					$form->message = self::getError( 'email' );

				}
				
			}

		}


		/**
		 * Get the checkbox-field to check if a mailchimp subscription needs to be made
		 * 
		 * @param  Object $form  
		 * @param  Object $entry 
		 * @return bool       
		 */
		public static function getCheck( $form, $entry ){

			//check for the original field and get the ID:



			return false;

		}



		/**
		 * Get various error-messages while posting
		 * 
		 * @param  string $type
		 * @return error json
		 */
		public static function getError( $type ){


			switch( $type ){


				case 'mailchimp':

					return array(

							'error'		=> 	true,
							'message'	=> 	'Nieuwsbrief inschrijving mislukt.'
					);

				break;



				case 'email':

					return array(

						'error'		=> 	true,
						'message'	=> 	'De inschrijving voor de nieuwsbrief is niet gelukt omdat je geen geldig e-mailadres hebt ingevuld.'
					);

				break;



				case 'fname':


					return array(

						'error'		=> 	true,
						'message'	=> 	'De inschrijving voor de nieuwsbrief is niet gelukt omdat je geen voornaam hebt ingevuld.'
					);


				break;


				case 'list':


					return array(

						'error'		=> 	true,
						'message'	=> 	'De inschrijving voor de nieuwsbrief is niet gelukt omdat de gebruikerslijst niet bestaat.'
					);

				break;


			}


		}


		/**
		 * Get the values from an entry
		 * 
		 * @param  Object $form
		 * @param  Object $entry
		 * @return array
		 */
		public static function getEntryValues( $form, $entry ){

			// Get all values:
			$prefix = 'field_'.$form->id.'_';
			$email_id = get_post_meta( $form->id, 'mc_email', true );
			$first_name_id = get_post_meta( $form->id, 'mc_first_name', true );
			$last_name_id = get_post_meta( $form->id, 'mc_last_name', true );
			$list_id = get_post_meta( $form->id, 'mc_list', true );

			if( !$list_id || $list_id == 'none' )
				$list_id = Settings::get( 'defaultList' );



			$email = '';
			$fname = '';
			$lname = '';

			foreach( $entry as $field ){

				$id = str_replace( $prefix, '', $field['name'] );

				switch( $id ){

					case $email_id:
						$email = $field['value'];
					break;

					case $first_name_id:
						$fname = $field['value'];
					break;

					case $last_name_id:
						$lname = $field['value'];
					break;
				}
			}


			if( $list_id == '' )
				$form->message = self::getError( 'list' );


			return array(
						'email'		=> $email,
						'fname'		=> $fname,
						'lname'		=> $lname,
						'list_id'	=> $list_id

			);

		}


	}
