<?php

require_once __DIR__.'/connexion.php';

class Controle{
    private ?int $id_controle;
    private ?string $classe;
    private ?string $matiere;
    private ?string $date;
    private ?string $eleve;
    private ?string $note;
    private ?string $absence;

    /**
     * Get the value of id_controle
     */ 
    public function getId_controle()
    {
        return $this->id_controle;
    }

    /**
     * Set the value of id_controle
     *
     * @return  self
     */ 
    public function setId_controle($id_controle)
    {
        $this->id_controle = $id_controle;

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
     * Get the value of matiere
     */ 
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set the value of matiere
     *
     * @return  self
     */ 
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of eleve
     */ 
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * Set the value of eleve
     *
     * @return  self
     */ 
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }
        /**
     * Get the value of absence
     */ 
    public function getAbsence()
    {
        return $this->absence;
    }

    /**
     * Set the value of absence
     *
     * @return  self
     */ 
    public function setAbsence($absence)
    {
        $this->absence = $absence;

        return $this;
    }
    // Tables
    private $db_tables = [
        "controle",
        "classe",
        "note_controle",
        "eleve",
        "scolarite"
    ];

    function genControles(){
        $stmt = $this->getSqlAllControles();
        
        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>ID</th>";
        echo "<th>Classe</th>";
        echo "<th>Matierre</th>";
        echo "<th>Date</th>";
        echo "<th>Modifier</th>";
        echo "<th>Ajout notes</th>";
        echo "<th>Supprimer</th>";
        echo "</tr></thead><tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $isNote = $this->sqlVerifNoteControle($row['id_controle']);
            if($isNote != null){
                $isNoted = true;
            }else{
                $isNoted = false;
            }

            echo "<form action='' method='POST'>";	
            echo "<input type='hidden' value='". $row['id_controle']."' name='id_controle' />";
            echo "<td>".$row['id_controle']."</td>";
            echo "<td>".$row['nom_classe']."</td>";
            echo "<td>".$row['matiere']."</td>";
            echo "<td>". dateEnToDateFr($row['date_controle'])."</td>";
                //button modif
                echo "<td><a href='modif-controle/".$row['id_controle']."' class='btn btn-success ";
                if($isNoted == false){echo ' disabled ';}
                echo "' >Modifier notes</a></td>";

                echo "<td><a href='ajout-note/".$row['id_controle']."' class='btn btn-info ";
                if($isNoted == true){echo ' disabled ';}
                echo "' >Ajouter</a></td>";

            echo "<td><a href='#' class='btn btn-danger' data-toggle='modal' data-target='#smallModal".$row['id_controle']."'>Supprimer</a></td>";
            echo "</tr>";
            echo "<div class='modal' id='smallModal".$row['id_controle']."' tabindex='-1' role='dialog' aria-labelledby='smallModal' aria-hidden='true'>";
						echo "<div class='modal-dialog'>";
							echo "<div class='modal-content'>";
								echo "<div class='modal-header'>";
									echo "<h5 class='modal-title' id='myModalLabel'>Confirmation</h5>";
									echo "</div>";
									echo "<div class='modal-body'>";
										echo "<p>Confirmez la suppression du contrôle de <b>".ucfirst($row['matiere']). ' du '.dateEnToDateFr($row['date_controle'])."</b><p>";
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

    function genSingleControle(){
        $stmt = $this->getSqlSingleControle($this->id_controle);

        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>Id Eleve</th>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>Absence</th>";
        echo "<th>Note</th>";
        echo "</tr></thead><tbody>";
        echo "<form action='' method='POST'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<tr>";
                echo "<input type='hidden' value='". $row['id_controle']."' name='id_controle' />";
                echo "<input type='hidden' name='id_eleve[]' value='". $row['id_eleve']."' />";
                echo "<td><input class='form-control' type='text' disabled value='". $row['id_eleve']."' name='id_eleve".$row['id_eleve']."'/></td>";
                echo "<td><input class='form-control' type='text' disabled value='". $row['nom']."' name='nom".$row['id_eleve']."'/></td>";
                echo "<td><input class='form-control' type='text' disabled value='". $row['prenom']."' name='prenom".$row['id_eleve']."'/></td>";
                    echo "<td><input class='form-check-input' disabled type='checkbox'";
                    if($row['absence'] == true){echo ' checked ';}
                    echo  " name='abs[]' value='".$row['id_eleve']."'></td>";
                echo "<td><input class='form-control' type='text' required name='notes[]' value='".$row['note']."'/></td>";
            echo "</tr>";   
        }
        echo "<input type='submit' name='update' value='Modifier' class='btn btn-success'>";
        echo "</form>";
        echo "</tbody></table>";
        
    }
    
    function genClasse(){
        $stmt = $this->getSqlElevesByClasse($this->classe);
        $id = $this->id_controle;

        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>Id Eleve</th>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>Absence</th>";
        echo "<th>Note</th>";
        echo "</tr></thead><tbody>";
        echo "<form action='' method='POST'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);	
            
            echo "<tr>";
                echo "<input type='hidden' value='".$id."' name='id_controle' />";
                echo "<input type='hidden' name='id_eleve[]' value='". $row['id_eleve']."' />";
                echo "<td><input class='form-control' type='text' disabled value='". $row['id_eleve']."' name='id_eleve".$row['id_eleve']."'/></td>";
                echo "<td><input class='form-control' type='text' disabled value='". $row['nom']."' name='nom".$row['id_eleve']."'/></td>";
                echo "<td><input class='form-control' type='text' disabled value='". $row['prenom']."' name='prenom".$row['id_eleve']."'/></td>";
                echo "<td><input class='form-check-input' type='checkbox' name='abs[]' value='".$row['id_eleve']."'></td>";
                echo "<td><input class='form-control' type='text' required name='notes[]' value=''/></td>";
            echo "</tr>";   
        }
        echo "<input type='submit' name='update' value='Enregistrer' class='btn btn-success'>";
        echo "</form>";
        echo "</tbody></table>";
        
    }


    public function getSqlAllControles(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
                    .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON classe.id_classe = controle.classe_fk ";

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function getSqlSingleControle(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
                    .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON classe.id_classe = controle.classe_fk ".
                    " INNER JOIN ".$this->db_tables[2]. 
                    " ON controle.id_controle = note_controle.controle_fk ". 
                    " INNER JOIN ".$this->db_tables[3]. 
                    " ON eleve.id_eleve = note_controle.eleve_fk 
                    WHERE id_controle=$this->id_controle";

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function getSqlElevesByClasse(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM "
                    .$this->db_tables[4].
                    " INNER JOIN ".$this->db_tables[3].
                    " ON eleve.id_eleve = scolarite.eleve_fk ".
                    " INNER JOIN ".$this->db_tables[1]. 
                    " ON classe.id_classe = scolarite.classe_fk 
                    WHERE classe_fk=$this->classe";
                    
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function sqlVerifNoteControle($id_controle){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT note FROM "
                    .$this->db_tables[2].
                    " WHERE controle_fk=$id_controle";

        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        $tab=$stmt->fetch();
        return $tab;

        $conn=null;
        $stmt=null;
    }

    public function getSqlClasseByControle(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT classe_fk FROM "
                    .$this->db_tables[0].
                    " WHERE id_controle=$this->id_controle";

        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        $tab=$stmt->fetch();
        return $tab;

        $conn=null;
        $stmt=null;
    }

    public function sqlDeleteControle($id_controle){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt=$conn->prepare ("DELETE FROM ". $this->db_tables[0] ." WHERE id_controle = $id_controle");
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }
}