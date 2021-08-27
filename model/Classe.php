<?php

require_once __DIR__.'/connexion.php';

class Classe{
    private ?int $id_classe;
    private ?string $nom_classe;
    private ?string $anne_scolaire;

    /**
     * Get the value of id_classe
     */ 
    public function getId_classe()
    {
        return $this->id_classe;
    }

    /**
     * Set the value of id_classe
     *
     * @return  self
     */ 
    public function setId_classe($id_classe)
    {
        $this->id_classe = $id_classe;

        return $this;
    }

    /**
     * Get the value of nom_classe
     */ 
    public function getNom_classe()
    {
        return $this->nom_classe;
    }

    /**
     * Set the value of nom_classe
     *
     * @return  self
     */ 
    public function setNom_classe($nom_classe)
    {
        $this->nom_classe = $nom_classe;

        return $this;
    }

    /**
     * Get the value of anne_scolaire
     */ 
    public function getAnne_scolaire()
    {
        return $this->anne_scolaire;
    }

    /**
     * Set the value of anne_scolaire
     *
     * @return  self
     */ 
    public function setAnne_scolaire($anne_scolaire)
    {
        $this->anne_scolaire = $anne_scolaire;

        return $this;
    }
    private $db_table = "classe";

    public function getAllClasse(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM ". $this->db_table;

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }
}