<?php

require_once __DIR__.'/connexion.php';

class Eleve{
    private ?int $id_eleve;
    private ?string $sexe;
    private ?string $nom;
    private ?string $prenom;
    private ?string $email;
    private ?string $date_naissance;
    private ?string $lieu_naissance;
    private ?string $adresse;
    private ?string $ville;
    private ?string $cp;
    private ?string $tel;
    private ?string $date_insciption;
    private ?string $classe;
    private ?string $anne_scolaire;
    

    /**
     * Get the value of id_eleve
     */ 
    public function getId_eleve()
    {
        return $this->id_eleve;
    }

    /**
     * Set the value of id_eleve
     *
     * @return  self
     */ 
    public function setId_eleve($id_eleve)
    {
        $this->id_eleve = $id_eleve;

        return $this;
    }

    /**
     * Get the value of sexe
     */ 
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set the value of sexe
     *
     * @return  self
     */ 
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of date_naissance
     */ 
    public function getDate_naissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set the value of date_naissance
     *
     * @return  self
     */ 
    public function setDate_naissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * Get the value of lieu_naissance
     */ 
    public function getLieu_naissance()
    {
        return $this->lieu_naissance;
    }

    /**
     * Set the value of lieu_naissance
     *
     * @return  self
     */ 
    public function setLieu_naissance($lieu_naissance)
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of cp
     */ 
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of tel
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set the value of tel
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get the value of date_insciption
     */ 
    public function getDate_insciption()
    {
        return $this->date_insciption;
    }

    /**
     * Set the value of date_insciption
     *
     * @return  self
     */ 
    public function setDate_insciption($date_insciption)
    {
        $this->date_insciption = $date_insciption;

        return $this;
    }
        /**
     * Get the value of mail
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
        /**
     * Get the value of classe
     */ 
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set the value of classe
     *
     * @return  self
     */ 
    public function setClasse($classe)
    {
        $this->classe = $classe;

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

    // Tables
    private $db_tables = [
        "eleve",
        "scolarite",
        "utilisateur"
    ];

    function genEleves(){
        
        $stmt = $this->getSqlEleves();

        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>ID</th>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>Classe</th>";
        echo "<th>Année scolaire</th>";
        echo "<th>Attestation</th>";
        echo "<th>Modifier</th>";
        echo "<th>Supprimer</th>";
        echo "</tr></thead><tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<form action='' method='POST'>";	
            echo "<input type='hidden' value='". $row['id_eleve']."' name='id_eleve' />"; 
            echo "<td>".$row['id_eleve']."</td>";
            echo "<td>".ucfirst($row['nom'])."</td>";
            echo "<td>".ucfirst($row['prenom'])."</td>";
            echo "<td>".$row['classe']."</td>";
            echo "<td>".$row['annee_scolaire']."</td>";
            echo "<td><a href='attestation-user/".$row['id_eleve']."' class='btn btn-success'>Attestation</a></td>";
            echo "<td><a href='modif-user/".$row['id_eleve']."' class='btn btn-info'>Modifier</a></td>";
            echo "<td><a href='#' class='btn btn-danger' data-toggle='modal' data-target='#smallModal".$row['id_eleve']."'>Supprimer</a></td>";
            
            echo "</tr>";
            echo "<div class='modal' id='smallModal".$row['id_eleve']."' tabindex='-1' role='dialog' aria-labelledby='smallModal' aria-hidden='true'>";
						echo "<div class='modal-dialog'>";
							echo "<div class='modal-content'>";
								echo "<div class='modal-header'>";
									echo "<h5 class='modal-title' id='myModalLabel'>Confirmation</h5>";
									echo "</div>";
									echo "<div class='modal-body'>";
										echo "<p>Confirmez la suppression de l'éleve <b>".ucfirst($row['prenom'])."</b><p>";
									echo "</div>";
									echo "<div class='modal-footer'>";
										echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Annuler</button>";
										echo "<input type='submit' name='delete' value='Confirmer' class='btn btn-danger' />";
								echo "</div>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
            echo "</form>";
        }
        echo "</tbody></table>";
    }

    public function getSqlEleves(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
                    .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON eleve.id_eleve = scolarite.eleve_fk";

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function getLastEleve(){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt=$conn->prepare("SELECT id_eleve FROM " .$this->db_tables[0]." ORDER BY id_eleve desc limit 1 ");

        $stmt->execute();
        $tab=$stmt->fetch();
        return $tab;

        $conn=null;
        $stmt=null;
    }

}