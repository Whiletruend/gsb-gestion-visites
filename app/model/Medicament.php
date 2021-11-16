<?php
    //      
    // Class name: Medicament
    //                   

    // Namespaces & Uses
    namespace App\model;

    // Class
    class Medicament {
        # Variables
        private string $id;
        private string $nomCommercial;
        private string $idFamille;
        private string $composition;
        private string $effets;
        private string $contreIndications;

        # Constructor
        public function __construct(string $id, string $nomCommercial, string $idFamille, string $composition, string $effets, string $contreIndications) {
            $this->id = $id;
            $this->nomCommercial = $nomCommercial;
            $this->idFamille = $idFamille;
            $this->composition = $composition;
            $this->effets = $effets;
            $this->contreIndications = $contreIndications;
        }

        # Functions
        public function getID() : string { return $this->id; }
        public function getNomCommercial() : string { return $this->nomCommercial; }
        public function getIDFamille() : string { return $this->idFamille; }
        public function getComposition() : string { return $this->composition; }
        public function getEffets() : string { return $this->effets; }
        public function getContreIndications() : string { return $this->contreIndications; }
    }
?>