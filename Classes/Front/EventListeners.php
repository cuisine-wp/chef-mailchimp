<?php

	namespace ChefMailchimp\Frontend;

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

		}



	}

	\ChefMailchimp\Frontend\EventListeners::getInstance();
