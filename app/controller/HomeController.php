<?php
    // Namespaces & Uses
    namespace App\controller;

    // Class
    class HomeController {
        private static $_instance = null;

        public static function getInstance() : object {
            if(is_null(self::$_instance)) {
                self::$_instance = new HomeController;
            }

            return self::$_instance;
        }

        public function render() {
            include_once 'app/view/header.php';
            include_once 'app/view/home.php';
            include_once 'app/view/dashboard/footer.php';
        }
    }
?>