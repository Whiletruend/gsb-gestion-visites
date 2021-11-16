<?php
    // Namespaces & Uses
    namespace App\controller;
    use App\model\OffrirAccess;
    use App\model\RapportAccess;

    // Class
    class RapportController {
        private static $_instance = null;
        public static $page;
        public static $totalPages;

        private function __construct() {
            self::checkRapport();
        }

        private static function checkRapport() : void {
            if(isset($_POST['rapport_Motif'])) {
                $medic = $_POST['rapport_Medic'];
                $motif = $_POST['rapport_Motif'];
                $bilan = $_POST['rapport_Bilan'];
                $date = $_POST['rapport_Date'];
                $convertedDate = self::dateToEnglishFormat($date);

                RapportAccess::addRapport($convertedDate, $motif, $bilan, $_SESSION['id_VISITOR'], $medic);

                if(!empty($_POST['rapport_Medication']) && !empty($_POST['rapport_Quantity'])) { 
                    foreach(array_combine($_POST['rapport_Medication'], $_POST['rapport_Quantity']) as $key => $val) {
                        $lastRapport = RapportAccess::getLastRapport();
                        OffrirAccess::addOffrir($lastRapport, $key, $val);
                    }
                }
            }

            if(isset($_POST['rapport_Motif_edit']) && isset($_POST['rapport_Bilan_edit'])) {
                $id_rapport = $_GET['editRapport'];
                $motif = $_POST['rapport_Motif_edit'];
                $bilan = $_POST['rapport_Bilan_edit'];

                RapportAccess::updateRapport($id_rapport, $motif, $bilan);
            }

            if(isset($_POST['rapport_EditDate'])) {
                header('Location: ./?action=myRapports&page=' . $_GET['page'] . '&date=' . self::dateToEnglishFormat($_POST['rapport_EditDate']));
            }

            if(isset($_GET['delete'])) {
                RapportAccess::deleteRapport($_GET['delete']);

                header('Location: ./?action=myRapports&page=' . $_GET['page']);
            }
        }

        public static function dateToEnglishFormat(string $date) {
            $convertedDate = date('Y-m-d', strtotime($date));

            return $convertedDate;
        }

        public static function dateToFrenchFormat(string $date) {
            $convertedDate = date('d-m-Y', strtotime($date));

            return $convertedDate;
        }


        public static function getEveryRapportFrom($id_visitor) : array {
            // Paginations variables
            $limit = 10;
            $allRecords = RapportAccess::getTotalRecords($_SESSION['id_VISITOR']);
            self::$totalPages = ceil($allRecords / $limit);
            self::$page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
            $paginationStart = (self::$page - 1) * $limit;

            // Get every rapport from a visitor ID
            $rapport_collection = RapportAccess::getEveryRapportFrom($id_visitor, $paginationStart, $limit);
            
            // Return the objects array
            return $rapport_collection;
        }

        public static function getEveryRapportOfAMedic($id_medic) : array {
            $rapports = RapportAccess::getEveryRapportOfAMedic($id_medic);

            return $rapports;
        }

        public static function getRapportByDateAndID($date, $id_visitor) {
            $rapports = RapportAccess::getRapportByDateAndID($date, $id_visitor);
            
            return $rapports;
        }

        public static function getRapportByID($id_rapport) : object {
            $rapport = RapportAccess::getRapportByID($id_rapport);

            return $rapport;
        }

        public static function getEveryMotifs() : array {
            $motifs = RapportAccess::getEveryMotifs();

            return $motifs;
        }

        public static function getInstance() : object {
            if(is_null(self::$_instance)) {
                self::$_instance = new RapportController;
            }

            return self::$_instance;
        }

        public function render() : void {
            $this->activePage = 'myRapports';

            include_once 'app/view/dashboard/header.php';
            include_once 'app/view/dashboard/sidebar.php';
            include_once 'app/view/dashboard/myRapports.php';
            include_once 'app/view/dashboard/footer.php';
        }
    }
?>