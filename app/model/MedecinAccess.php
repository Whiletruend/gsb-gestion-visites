<?php
    //      
    // Class name: MedecinAccess 
    //                   

    // Namespaces & Uses
    namespace App\model;
    use PDO;

    // Class
    class MedecinAccess extends Database {
        # Functions
        public static function getAll() : array {
            $query = self::query('SELECT * FROM Medecin ORDER BY nom ASC;');
            $collection = array();

            if(!empty($query)) {
                foreach($query as $rows) {
                    $collection[$rows['id']] = new Medecin($rows['id'], $rows['nom'], $rows['prenom'], $rows['adresse'], $rows['tel'], strval($rows['specialitecomplementaire']), $rows['departement']);
                }
            }

            return $collection;
        }

        public static function getMedicByID($id_medic) : object {
            $request = self::prepare('SELECT * FROM Medecin WHERE id = :id_medic;', array(':id_medic' => $id_medic));

            if(!empty($request)) {
                return new Medecin($request[0]['id'], $request[0]['nom'], $request[0]['prenom'], $request[0]['adresse'], $request[0]['tel'], strval($request[0]['specialitecomplementaire']), $request[0]['departement']);
            } else {
                return null;
            }
        }

        public static function getTotalRecords() : int {
            $query = self::query("SELECT COUNT(id) as ID FROM Medecin;");
            $int = 0;

            foreach($query as $rows) {
                $int = $rows['ID'];
            }

            return $int;
        }

        public static function getEveryMedicsFromTo(int $start, int $end) : array {
            $request = self::prepare('SELECT * FROM Medecin ORDER BY nom ASC LIMIT ' . $start . ', ' . $end . '', array());
            $collection = array();

            if(!empty($request)) {
                foreach($request as $rows) {
                    $collection[$rows['id']] = new Medecin($rows['id'], $rows['nom'], $rows['prenom'], $rows['adresse'], $rows['tel'], strval($rows['specialitecomplementaire']), $rows['departement']);
                }
            }

            return $collection;
        }

        public static function getMedicsByInfos($infos) : array {
            $query = self::query("SELECT * FROM Medecin WHERE nom LIKE '" . $infos . "%' OR id = '" . $infos . "'  ORDER BY nom ASC;");
            $collection = array();

            if(!empty($query)) {
                foreach($query as $rows) {
                    $collection[$rows['id']] = new Medecin($rows['id'], $rows['nom'], $rows['prenom'], $rows['adresse'], $rows['tel'], strval($rows['specialitecomplementaire']), $rows['departement']);
                }
            }

            return $collection;
        }

        public static function updateMedicInfos($id, $lname, $fname, $adress, $phone, $specom, $departement) : void {
            $request = self::request('UPDATE Medecin SET nom = :nom, prenom = :prenom, adresse = :adresse, tel = :tel, specialitecomplementaire = :specialitecomplementaire, departement = :departement WHERE id = :id;', array(':id' => $id, ':nom' => $lname, ':prenom' => $fname, ':adresse' => $adress, ':tel' => $phone, ':specialitecomplementaire' => $specom, ':departement' => $departement));
        }
    }
?>