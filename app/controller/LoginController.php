<?php
    // Namespaces & Uses
    namespace App\controller;
    use App\model\Visiteur;
    use App\model\VisiteurAccess;

    // Class
    class LoginController {
        # Variables
        private static $_instance = null;

        # Functions
        private function __construct() {
            self::checkLogin();
        }

        private static function checkLogin() : void {
            if(isset($_POST['login_VISITEUR']) && isset($_POST['mdp_VISITEUR'])) {
                $postLogin = $_POST['login_VISITEUR'];
                $postPass = $_POST['mdp_VISITEUR'];

                self::login($postLogin, $postPass);
            }
        }

        private static function login($login, $pass) : void {
            if(!isset($_SESSION)) { session_start(); }

            $visitor = VisiteurAccess::getByLoginAndPass($login, $pass);

            if(!empty($visitor)) {
                $visitorDB_Login = $visitor->getLogin();
                $visitorDB_Pass = $visitor->getMDP();

                if( (trim($visitorDB_Login) == trim($login)) && (trim($visitorDB_Pass) == trim($pass)) ) {
                    # Get database values
                    $visitorDB_ID = $visitor->getID();
                    $visitorDB_FName = $visitor->getNom();
                    $visitorDB_LName = $visitor->getPrenom();
                    $visitorDB_Address = $visitor->getAdresse();
                    $visitorDB_CP = $visitor->getCP();
                    $visitorDB_City = $visitor->getVille();
                    $visitorDB_DE = $visitor->getDateEmbauche();

                    # Set $_SESSION variables from databases values
                    $_SESSION['login_VISITOR'] = $visitorDB_Login;
                    $_SESSION['pass_VISITOR'] = $visitorDB_Pass;

                    $_SESSION['id_VISITOR'] = $visitorDB_ID;
                    $_SESSION['fname_VISITOR'] = $visitorDB_FName;
                    $_SESSION['lname_VISITOR'] = $visitorDB_LName;
                    $_SESSION['address_VISITOR'] = $visitorDB_Address;
                    $_SESSION['cp_VISITOR'] = $visitorDB_CP;
                    $_SESSION['city_VISITOR'] = $visitorDB_City;
                    $_SESSION['de_VISITOR'] = $visitorDB_DE;

                    header('Location: .');
                }
            } else {
                header('Location: ./?action=login&errLogin');
            }
        }

        public static function logout() : void {
            if(isset($_SESSION['login_VISITOR']) && isset($_SESSION['pass_VISITOR'])) {
                session_destroy();
                
                header('Location: .');
            }
        }
        
        public static function getInstance() : object {
            if(is_null(self::$_instance)) {
                self::$_instance = new LoginController;
            }

            return self::$_instance;
        }

        public function render() {
            include_once 'app/view/header.php';
            include_once 'app/view/login.php';
            include_once 'app/view/dashboard/footer.php';
        }
    }
?>