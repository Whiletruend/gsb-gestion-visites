<?php
    //      
    // Class name: Medecin 
    //                   

    // Namespaces & Uses
    namespace App\model;

    // Class
    class Medecin {
        # Variable
        private int $id;
        private string $nom;
        private string $prenom;
        private string $adresse;
        private string $tel;
        private string $specialiteComplementaire;
        private string $departement;

        # Constructor
        public function __construct(int $id, string $nom, string $prenom, string $adresse, string $tel, string $specialiteComplementaire, int $departement) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->adresse = $adresse;
            $this->tel = $tel;
            $this->specialiteComplementaire = $specialiteComplementaire;
            $this->departement = $departement;
        }

        # Functions
        public function getID() : int { return $this->id; }
        public function getNom() : string { return $this->nom; }
        public function getPrenom() : string { return $this->prenom; }
        public function getAdresse() : string { return $this->adresse; }
        public function getTel() : string { return $this->tel; }
        public function getSpecialiteComplementaire() : string { return $this->specialiteComplementaire; }
        public function getDepartement() : string { return $this->departement; }
    }
?>