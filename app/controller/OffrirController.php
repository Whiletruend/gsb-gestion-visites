<?php
    // Namespaces & Uses
    namespace App\controller;

    // Class
    class OffrirController {
        private static $_instance = null;

        public static function getInstance() : object {
            if(is_null(self::$_instance)) {
                self::$_instance = new OffrirController;
            }

            return self::$_instance;
        }

        public function render() {
            include_once 'app/view/header.php';
            include_once 'app/view/connect.php';
        }
    }
?>