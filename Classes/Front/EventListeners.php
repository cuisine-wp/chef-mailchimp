<?php

	namespace ChefMailchimp\Front;

	use \Cuisine\Utilities\Url;
	use \Cuisine\Wrappers\Route;
	use \Cuisine\Wrappers\PostType;
	use \ChefMailchimp\Wrappers\StaticInstance;

	class EventListeners extends StaticInstance{


		/**
		 * Init events & vars
		 */
		function __construct(){

			$this->listen();

		}


		/**
		 * Listen to front-end events
		 * 
		 * @return void
		 */
		private function listen(){

			add_action( 'form_submitted', function( $form, $entry ){

				Subscription::make( $form, $entry );

			}, 100, 2 );


			//register the field-types:
			add_filter( 'chef_forms_field_types', function( $types ){

				$types['mc_checkbox'] = array(
						'name'	=> 'Nieuwsbrief check',
						'class' => 'ChefMailchimp\\Hooks\\CheckboxField',
						'icon'      => 'dashicons-yes'
				);

				$types['mc_select'] = array(
						'name'	=> 'Nieuwsbrief lijst-select',
						'class' => 'ChefMailchimp\\Hooks\\SelectField',
						'icon'      => 'dashicons-arrow-down'
				);

				return $types;

			});

			//add the field types to the advanced metabox:
			add_filter( 'chef_forms_advanced_fields', function( $fields ){

				$fields[] = 'mc_checkbox';
				$fields[] = 'mc_select';

				return $fields;

			});




		}

	}

	\ChefMailchimp\Front\EventListeners::getInstance();
