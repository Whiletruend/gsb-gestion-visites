<?php
    //      
    // Class name: Visiteur 
    //                   

    // Namespaces & Uses
    namespace App\model;

    // Class
    class Visiteur {
        # Variables
        private string $id;
        private string $nom;
        private string $prenom;
        private string $login;
        private string $mdp;
        private string $adresse;
        private string $cp;
        private string $ville;
        private string $dateEmbauche;

        # Constructor
        public function __construct(string $id, string $nom, string $prenom, string $login, string $mdp, string $adresse, string $cp, string $ville, string $dateEmbauche) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->login = $login;
            $this->mdp = $mdp;
            $this->adresse = $adresse;
            $this->cp = $cp;
            $this->ville = $ville;
            $this->dateEmbauche = $dateEmbauche;
        }

        # Functions
        public function getID() : string { return $this->id; }
        public function getNom() : string { return $this->nom; }
        public function getPrenom() : string { return $this->prenom; }
        public function getLogin() : string { return $this->login; }
        public function getMDP() : string { return $this->mdp; }
        public function getAdresse() : string { return $this->adresse; }
        public function getCP() : string { return $this->cp; }
        public function getVille() : string { return $this->ville; }
        public function getDateEmbauche() : string { return $this->dateEmbauche; }
    }
?>