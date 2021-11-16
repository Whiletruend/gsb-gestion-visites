<?php
    // Namespaces & Uses
    namespace App\controller;
    use App\model\MedicamentAccess;

    // Class
    class MedicamentController {
        private static $_instance = null;

        public static function getEveryMedications() : array {
            $medications = MedicamentAccess::getAll();

            return $medications;
        }

        public static function getInstance() : object {
            if(is_null(self::$_instance)) {
                self::$_instance = new MedicamentController;
            }

            return self::$_instance;
        }

        public function render() {
            include_once 'app/view/header.php';
            include_once 'app/view/connect.php';
        }
    }
?>