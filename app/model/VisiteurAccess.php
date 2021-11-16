<?php
    //      
    // Class name: VisiteurAccess 
    //                   

    // Namespaces & Uses
    namespace App\model;
    use PDO;
    use App\controller\LoginController;

    // Class
    class VisiteurAccess extends Database {
        # Functions
        public static function getAll() : array {
            $query = self::query('SELECT * FROM Visiteur;');
            $table = array();

            foreach($query as $rows) {
                $table[$rows['id']] = new Visiteur($rows['id'], $rows['nom'], $rows['prenom'], $rows['login'], $rows['mdp'], $rows['adresse'], $rows['cp'], $rows['ville'], $rows['dateEmbauche']);
            }

            return $table;
        }

        public static function getByLoginAndPass($login, $pass) {
            $request = self::prepare('SELECT * FROM Visiteur WHERE login = :login AND mdp = :mdp;', array(':login' => $login, ':mdp' => $pass));

            if(!empty($request)) {
                return new Visiteur($request[0]['id'], $request[0]['nom'], $request[0]['prenom'], $request[0]['login'], $request[0]['mdp'], $request[0]['adresse'], $request[0]['cp'], $request[0]['ville'], $request[0]['dateEmbauche']);
            } else {
                return null;
            }
        }

        public static function isConnected() : bool {
            if(!isset($_SESSION)) { session_start(); }

            $isConnected = false;

            if(isset($_SESSION['login_VISITOR'])) {
                $visitor = self::getByLoginAndPass($_SESSION['login_VISITOR'], $_SESSION['pass_VISITOR']);

                $login = $_SESSION['login_VISITOR'];
                $pass = $_SESSION['pass_VISITOR'];
                $login_DB = $visitor->getLogin();
                $pass_DB = $visitor->getMDP();

                if(trim($login) == trim($login_DB) && trim($pass) == trim($pass_DB)) {
                    $isConnected = true;
                }
            }

            return $isConnected;
        }
    }
?>