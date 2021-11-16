<?php
    // Namespaces & Uses
    namespace App\controller;
    use App\model\VisiteurAccess;

    // Class
    class VisiteurController {
        private static $_instance = null;

        public static function getInstance() : object {
            if(is_null(self::$_instance)) {
                self::$_instance = new VisiteurController;
            }

            return self::$_instance;
        }

        public static function isConnected() : bool {
            $isConnected = VisiteurAccess::isConnected();

            return $isConnected;
        }

        public static function getVisitorInfos() : array {
            $visitor = array();

            return $visitor;
        }

        public static function getVisitorOffers() : array {
            $visitor_offers = array();

            return $visitor_offers;
        }

        public function render() : void {
            $this->activePage = 'myProfile';

            include_once 'app/view/dashboard/header.php';
            include_once 'app/view/dashboard/sidebar.php';
            include_once 'app/view/dashboard/myProfile.php';
            include_once 'app/view/dashboard/footer.php';
        }
    }
?>