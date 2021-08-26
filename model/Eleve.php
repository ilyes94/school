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
        "classe"
    ];

    function genEleves($i,$search,$classe,$annee_scolaire){
        if ($i == 1){
            $stmt = $this->getSqlSearch($search,$classe,$annee_scolaire);
        }else{
            $stmt = $this->getSqlEleves();
        }
        

        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>ID</th>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>E-mail</th>";
        echo "<th>Télephone</th>";
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
            echo "<td>".$row['email']."</td>";
            echo "<td>".chunk_split($row['tel'],2, ' ')."</td>";
            echo "<td>".$row['nom_classe']."</td>";
            echo "<td>".$row['annee_scolaire']."</td>";
            echo "<td><a href='".$_SESSION['root']."/public/eleves/attestation-eleve.php?id=".$row['id_eleve']."' class='btn btn-success'>Attestation</a></td>";
            echo "<td><a href='modif-eleve/".$row['id_eleve']."' class='btn btn-info'>Modifier</a></td>";
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

    function genSingleEleve(){
        $stmt = $this->getSqlSingleEleveByID($this->id_eleve);

        $row = $stmt->execute();
        $row = $stmt->fetch();

        echo "<form class='form' action='' method='post'>";
        echo "<input type='hidden' value='". $row['id_eleve']."' name='id_eleve' />";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Nom</label>";
                echo "<input type='text' name='nom' id='nom' class='form-control' value='".$row['nom']."' disabled required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Prenom</label>";
                echo "<input type='text' name='prenom' id='prenom' class='form-control' value='".$row['prenom']."' disabled required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>E-mail</label>";
                echo "<input type='text' name='email' id='email' class='form-control' value='".$row['email']."' required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Télephone</label>";
                echo "<input type='text' name='tel' id='tel' class='form-control' value='".$row['tel']."' required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Adresse</label>";
                echo "<input type='text' name='adresse' id='adresse' class='form-control' value='".$row["adresse"]."' required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Ville</label>";
                echo "<input type='text' name='ville' id='ville' class='form-control' value='".$row['ville']."' required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Code postal</label>";
                echo "<input type='text' name='cp' id='cp' class='form-control' value='".$row['cp']."' required>";
            echo "</div>";
            /*
                echo "<div class='form-group'>";
                    echo "<label class='label-control'>Role</label>";
                    echo "<select class='form-control' name='role'>";
                        echo "<option ";
                        if($row['role']=='Secrétaire') {echo 'selected ';} 
                        echo ">Secrétaire</option>";

                        echo "<option ";
                        if($row['role']=='Directeur') {echo 'selected ';} 
                        echo ">Directeur</option>";
                    echo "</select>";
                echo "</div>";
                */
            echo "<input type='submit' name='update' value='Modifier' class='btn btn-success'>";
        echo '</form>';
    }


    public function getSqlEleves(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
                    .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON eleve.id_eleve = scolarite.eleve_fk ".
                    " INNER JOIN ".$this->db_tables[2]. 
                    " ON classe.id_classe = scolarite.classe_fk ";

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function getSqlSearch($search,$classe,$annee_scolaire){
        $database = new Database();
        $conn = $database->getConnection();

        if($classe==0){
			$rClasse=""; 
        }
		else{//$index_filiere!=0: La requete doit prendre en compte la filière séléctionnée
            $rClasse=" AND classe.nom_classe='$classe' ";
        } 

        $sqlQuery = "SELECT * FROM "
                    .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON eleve.id_eleve = scolarite.eleve_fk ".
                    " INNER JOIN ".$this->db_tables[2]. 
                    " ON classe.id_classe = scolarite.classe_fk 
                    WHERE (nom like '%$search%' OR prenom like '%$search%')
                    $rClasse
                    AND annee_scolaire='$annee_scolaire'";

        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }
    public function getSqlSingleEleveByID(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
                    .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON eleve.id_eleve = scolarite.eleve_fk ".
                    " INNER JOIN ".$this->db_tables[2]. 
                    " ON classe.id_classe = scolarite.classe_fk 
                    WHERE id_eleve = $this->id_eleve";
        
        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function sqlDeleteEleve($id_eleve){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt=$conn->prepare ("DELETE FROM ". $this->db_tables[0] ." WHERE id_eleve = $id_eleve");
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

}