<?php
    //      
    // Class name: Famille 
    //                   

    // Namespaces & Uses
    namespace App\model;

    // Class
    class Famille {
        # Variables
        private int $id;
        private string $libelle;

        # Constructor
        public function __construct(int $id, string $libelle) {
            $this->id = $id;
            $this->libelle = $libelle;
        }

        # Functions
        public function getID() : int { return $this->id; }
        public function getLibelle() : string { return $this->libelle; }
    }
?>