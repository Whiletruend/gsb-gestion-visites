<?php
    //      
    // Class name: Offrir 
    //                   

    // Namespaces & Uses
    namespace App\model;

    // Class
    class Offrir {
        # Variables
        private int $idRapport;
        private int $idMedicament;
        private int $quantite;

        # Constructor
        public function __construct(int $idRapport, int $idMedicament, int $quantite) {
            $this->idRapport = $idRapport;
            $this->idMedicament = $idMedicament;
            $this->quantite = $quantite;
        }

        # Functions
        public function getIDRapport() : int { return $this->idRapport; }
        public function getIDMedicament() : int { return $this->idMedicament; }
        public function getQuantite() : int { return $this->quantite; }
    }
?>