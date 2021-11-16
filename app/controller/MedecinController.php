<?php
    // Namespaces & Uses
    namespace App\controller;
    use App\model\MedecinAccess;

    // Class
    class MedecinController {
        private static $_instance = null;
        public static $page;
        public static $totalPages;

        private function __construct() {
            self::checkSearch();
        }

        private static function checkSearch() : void {
            if(isset($_POST['medic_Search'])) {
                header('Location: ./?action=myMedics&page=1&search=' . $_POST['medic_Search']);
            }

            if(isset($_POST['medic_LNameEdit'])) {
                $ID = $_GET['editMedic'];
                $LName = $_POST['medic_LNameEdit'];
                $FName = $_POST['medic_FNameEdit'];
                $Adress = $_POST['medic_AdressEdit'];
                $Phone = $_POST['medic_PhoneEdit'];
                $SpeCom = $_POST['medic_SpeComEdit'];
                $Departement = $_POST['medic_DepartEdit'];
                
                MedecinAccess::updateMedicInfos($ID, $LName, $FName, $Adress, $Phone, $SpeCom, $Departement);

                if(isset($_GET['search'])) {
                    header('Location: ./?action=myMedics&page=' . $_GET['page'] . '&search=' . $_GET['search']);
                } else {
                    header('Location: ./?action=myMedics&page=' . $_GET['page']);
                }
            }
        }

        public static function getEveryMedics() : array {
            $limit = 50;
            $allRecords = MedecinAccess::getTotalRecords();
            self::$totalPages = ceil($allRecords / $limit);
            self::$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
            $paginationStart = (self::$page - 1) * $limit;

            $medics = MedecinAccess::getEveryMedicsFromTo($paginationStart, $limit);
            
            return $medics;
        }

        public static function getMedicsByInfos($infos) : array {
            $medics = MedecinAccess::getMedicsByInfos($infos);

            return $medics;
        }

        public static function getMedicByID($id_medic) : object {
            $medic = MedecinAccess::getMedicByID($id_medic);

            return $medic;
        }

        public static function getInstance() : object {
            if(is_null(self::$_instance)) {
                self::$_instance = new MedecinController;
            }

            return self::$_instance;
        }

        public function render() : void {
            $this->activePage = 'myMedics';

            include_once 'app/view/dashboard/header.php';
            include_once 'app/view/dashboard/sidebar.php';
            include_once 'app/view/dashboard/myMedics.php';
            include_once 'app/view/dashboard/footer.php';
        }
    }
?>