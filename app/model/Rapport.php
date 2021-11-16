<?php
    //      
    // Class name: Rapport 
    //                   

    // Namespaces & Uses
    namespace App\model;

    // Class
    class Rapport {
        # Variables
        private int $id;
        private string $date;
        private string $motif;
        private string $bilan;
        private string $idVisiteur;
        private string $idMedecin;

        # Constructor
        public function __construct(int $id, string $date, string $motif, string $bilan, string $idVisiteur, string $idMedecin) {
            $this->id = $id;
            $this->date = $date;
            $this->motif = $motif;
            $this->bilan = $bilan;
            $this->idVisiteur = $idVisiteur;
            $this->idMedecin = $idMedecin;
        }

        # Functions
        public function getID() : int { return $this->id; }
        public function getDate() : string { return $this->date; }
        public function getMotif() : string { return $this->motif; }
        public function getBilan() : string { return $this->bilan; }
        public function getIDVisiteur() : string { return $this->idVisiteur; }
        public function getIDMedecin() : string { return $this->idMedecin; }
    }
?>