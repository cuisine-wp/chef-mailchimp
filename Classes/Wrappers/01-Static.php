<?php

    namespace ChefMailchimp\Wrappers;
    
    class StaticInstance {
    
        /**
         * Static bootstrapped instance.
         *
         * @var \ChefMailchimp\Wrappers\StaticInstance
         */
        public static $instance = null;
    
    
    
        /**
         * Init the Assets Class
         *
         * @return \ChefMailchimp\Admin\Assets
         */
        public static function getInstance(){
    
            return static::$instance = new static();
    
        }
    
    
    } 