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

		}

	}

	\ChefMailchimp\Front\EventListeners::getInstance();
