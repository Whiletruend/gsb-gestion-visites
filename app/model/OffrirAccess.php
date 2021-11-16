<?php
    //      
    // Class name: OffrirAccess 
    //                   

    // Namespaces & Uses
    namespace App\model;
    use PDO;

    // Class
    class OffrirAccess extends Database {
        # Functions
        public static function getAll() : array {
            $query = self::query('SELECT * FROM Offrir;');
            $table = array();

            if(!empty($query)) {
                foreach($query as $rows) {
                    $table[$rows['id']] = new Offrir($rows['idRapport'], $rows['idMedicament'], $rows['quantite']);
                }
            }

            return $table;
        }

        public static function addOffrir(int $id_rapport, string $id_medication, int $quantity) : void {
            $request = self::request('INSERT INTO Offrir(idRapport, idMedicament, quantite) VALUES (:id_rapport, :id_medication, :quantity);', array(':id_rapport' => $id_rapport, ':id_medication' => $id_medication, ':quantity' => $quantity));
        }
    }
?>