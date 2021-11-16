<?php
    //      
    // Class name: RapportAccess 
    //                   

    // Namespaces & Uses
    namespace App\model;
    use PDO;

    // Class
    class RapportAccess extends Database {
        # Functions
        public static function getTotalRecords(string $id_visitor) : int {
            $query = self::query("SELECT COUNT(id) AS ID FROM Rapport WHERE idVisiteur = '" . $id_visitor . "';");
            $int = 0;

            foreach($query as $rows) {
                $int = $rows['ID'];
            }

            return $int;
        }

        public static function getLastRapport() : int {
            $query = self::query('SELECT MAX(id) AS ID FROM Rapport;');
            $int = 0;

            foreach($query as $rows) {
                $int = $rows['ID'];
            }

            return $int;
        }

        public static function getRapportByID(int $id_rapport) : object {
            $request = self::prepare('SELECT * FROM Rapport WHERE id = :id_rapport ORDER BY date DESC;', array(':id_rapport' => intval($id_rapport)));

            if(!empty($request)) {
                return new Rapport($request[0]['id'], $request[0]['date'], $request[0]['motif'], $request[0]['bilan'], $request[0]['idVisiteur'], $request[0]['idMedecin']);
            } else {
                return null;
            }
        }

        public static function getEveryRapportFrom(string $id_visitor, int $start, int $end) : array {
            $request = self::prepare('SELECT * FROM Rapport WHERE idVisiteur = :idVisiteur ORDER BY date DESC LIMIT ' . $start . ', ' . $end . '', array(':idVisiteur' => $id_visitor));
            $collection = array();

            if(!empty($request)) {
                foreach($request as $rows) {
                    $collection[$rows['id']] = new Rapport($rows['id'], $rows['date'], $rows['motif'], $rows['bilan'], $rows['idVisiteur'], $rows['idMedecin']);
                }
            }

            return $collection;
        }

        public static function getRapportByDateAndID(string $date, string $id_visitor) : array {
            $request = self::prepare('SELECT * FROM Rapport WHERE date = :date AND idVisiteur = :id_visitor ORDER BY date DESC;', array(':date' => $date, ':id_visitor' => $id_visitor));
            $collection = array();

            if(!empty($request)) {
                foreach($request as $rows) {
                    $collection[$rows['id']] = new Rapport($rows['id'], $rows['date'], $rows['motif'], $rows['bilan'], $rows['idVisiteur'], $rows['idMedecin']);
                }
            }

            return $collection;
        }

        public static function getEveryRapportOfAMedic($id_medic) : array {
            $request = self::prepare('SELECT * FROM Rapport WHERE idMedecin = :id_medic ORDER BY date DESC;', array(':id_medic' => $id_medic));
            $collection = array();

            if(!empty($request)) {
                foreach($request as $rows) {
                    $collection[$rows['id']] = new Rapport($rows['id'], $rows['date'], $rows['motif'], $rows['bilan'], $rows['idVisiteur'], $rows['idMedecin']);
                }
            }

            return $collection;
        }

        public static function getEveryMotifs() : array {
            $request = self::query('SELECT DISTINCT motif FROM Rapport LIMIT 6;');
            $collection = array();

            if(!empty($request)) {
                foreach($request as $rows) {
                    $collection[] = $rows['motif'];
                }
            }

            return $collection;
        }

        public static function addRapport(string $date, string $motif, string $bilan, string $id_visitor, int $id_medic) : void {
            $request = self::request('INSERT INTO Rapport(date, motif, bilan, idVisiteur, idMedecin) VALUES (:date, :motif, :bilan, :idVisiteur, :idMedecin);', array(':date' => $date, ':motif' => $motif, ':bilan' => $bilan, ':idVisiteur' => $id_visitor, ':idMedecin' => $id_medic));
        }

        public static function updateRapport($id_rapport, $motif, $bilan) : void {
            $request = self::request('UPDATE Rapport SET motif = :motif, bilan = :bilan WHERE id = :id', array(':motif' => $motif, ':bilan' => $bilan, ':id' => $id_rapport));
        }

        public static function deleteRapport($id_rapport) : void {
            $request = self::request('DELETE FROM Offrir WHERE idRapport = :id', array(':id' => $id_rapport));
            $request = self::request('DELETE FROM Rapport WHERE id = :id', array(':id' => $id_rapport));
        }
    }
?>