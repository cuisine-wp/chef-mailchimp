<?php

	namespace ChefMailchimp\Admin;

	use \stdClass;
	use \ChefMailchimp\Wrappers\AjaxInstance;
	use \ChefMailchimp\Wrappers\Api;

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

			add_action( 'wp_ajax_getLists', function(){

				$lists = Api::getLists();
				echo json_encode( $lists );

				die();

			});
		}
	}


	if( is_admin() )
		\ChefMailchimp\Admin\Ajax::getInstance();
