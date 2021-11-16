<?php
    //      
    // Class name: MedicamentAccess 
    //                   

    // Namespaces & Uses
    namespace App\model;
    use PDO;

    // Class
    class MedicamentAccess extends Database {
        # Functions
        public static function getAll() : array {
            $query = self::query('SELECT * FROM Medicament ORDER BY nomCommercial ASC;');
            $table = array();

            if(!empty($query)) {
                foreach($query as $rows) {
                    $table[$rows['id']] = new Medicament($rows['id'], $rows['nomCommercial'], $rows['idFamille'], $rows['composition'], $rows['effets'], $rows['contreIndications']);
                }
            }

            return $table;
        }
    }
?>