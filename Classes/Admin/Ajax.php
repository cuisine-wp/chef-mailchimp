<?php

	namespace ChefMailchimp\Admin;

	use \stdClass;
	use \ChefMailchimp\Wrappers\AjaxInstance;

	class Ajax extends AjaxInstance{

		/**
		 * Init admin ajax events:
		 */
		function __construct(){

			$this->listen();

		}

		/**
		 * All backend-ajax events for this plugin
		 * 
		 * @return string, echoed
		 */
		private function listen(){


			//boilerplate:
			add_action( 'wp_ajax_actionName', function(){

				$this->setPostGlobal();


				die();

			});
		}
	}


	if( is_admin() )
		\ChefMailchimp\Admin\Ajax::getInstance();
