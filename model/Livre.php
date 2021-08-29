<?php

require_once __DIR__.'/connexion.php';

class Livre{
    private ?int $isbn;
    private ?string $nomLivre;
    private ?string $typeLivre;
    private ?string $auteurLivre;
    private ?string $eleve;
    private ?string $etat;
    private ?string $img;
    private ?string $dateEmprunt;
    

    /**
     * Get the value of isbn
     */ 
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set the value of isbn
     *
     * @return  self
     */ 
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get the value of nomLivre
     */ 
    public function getNomLivre()
    {
        return $this->nomLivre;
    }

    /**
     * Set the value of nomLivre
     *
     * @return  self
     */ 
    public function setNomLivre($nomLivre)
    {
        $this->nomLivre = $nomLivre;

        return $this;
    }

    /**
     * Get the value of typeLivre
     */ 
    public function getTypeLivre()
    {
        return $this->typeLivre;
    }

    /**
     * Set the value of typeLivre
     *
     * @return  self
     */ 
    public function setTypeLivre($typeLivre)
    {
        $this->typeLivre = $typeLivre;

        return $this;
    }

    /**
     * Get the value of auteurLivre
     */ 
    public function getAuteurLivre()
    {
        return $this->auteurLivre;
    }

    /**
     * Set the value of auteurLivre
     *
     * @return  self
     */ 
    public function setAuteurLivre($auteurLivre)
    {
        $this->auteurLivre = $auteurLivre;

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
     * Get the value of etat
     */ 
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @return  self
     */ 
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of dateEmprunt
     */ 
    public function getDateEmprunt()
    {
        return $this->dateEmprunt;
    }

    /**
     * Set the value of dateEmprunt
     *
     * @return  self
     */ 
    public function setDateEmprunt($dateEmprunt)
    {
        $this->dateEmprunt = $dateEmprunt;

        return $this;
    }

    // Tables
    private $db_tables = [
        "livre",
        "emprunt",
        "eleve",
        "scolarite",
        "classe"
    ];

    public function genLivres(){
        $stmt = $this->getSqlAllLivres();
        if($stmt != NULL){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                
                echo '<div class="card col-md-4 my-1">';
                    echo '<form method="POST">';
                        echo '<h4 class="typecat"><i class="fa fa-quote-left"></i>&nbsp;'.$row["type_livre"].'&nbsp;<i class="fa fa-quote-right"></i></h4>';
                        echo '<img class="img_thumb card-img-top" src='.$_SESSION["root"]."/assets/".$row["img_livre"].'  alt="Card image cap">';
                        echo '<div class="card-body row">';
                            echo '<div class="col-6 col-sm-6 col-md-8">';
                                echo '<h4 class="card-title">'.$row["titre_livre"].'</h4>';
                                echo '<h5 class="auteur">'.$row["auteur_livre"].'</h5>';
                            echo '</div>';
                            echo '<div class="col-6 col-sm-6 col-md-4">';

                                echo '<h6 class="';
                                if($row['etat']==0){
                                    $dispo = 'disponible';
                                    echo $dispo;
                                }else{
                                    $dispo = 'indisponible';
                                    echo $dispo;
                                }
                                echo '">'. ucfirst($dispo).'<h6>';
                                // ------------------------------

                                echo '<button class="btn btn-primary " type="submit" value="Emprunter" name="emprunt" ';
                                if($row['etat']==1){
                                    echo 'disabled';
                                }
                                echo '><i class="fa fa-shopping-basket"></i></button>';

                                echo '<input type="hidden" value="'.$row['isbn'].'" name="isbn" />';
                                echo '<input type="hidden" value="'.$_SESSION['id_eleve'].'" name="id_eleve" />';
                            echo '</div>';
                        echo '</div>';
                    echo '</form>';
                echo '</div>';
                
            }
        }
    }

    function genLivresEmprunte(){
        $stmt = $this->sqlGetLivresEmprunte();
        
        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>Eléve</th>";
        echo "<th>Classe</th>";
        echo "<th>Titre du livre</th>";
        echo "<th>Date d'emprunt</th>";
        echo "<th>Date de retour</th>";
        echo "<th>Action</th>";
        echo "</tr></thead><tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            //generation de la date de retour
            $dateRetour = generateDateRetour($row['date_emprunt']);

            echo "<tr>";
                echo "<td>".$row['nom'].' '.$row['prenom']."</td>";
                echo "<td>".$row['nom_classe']."</td>";
                echo "<td>".$row['titre_livre']."</td>";
                echo "<td>".dateEnToDateFr($row['date_emprunt'])."</td>";
                echo "<td>".dateEnToDateFr($dateRetour)."</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    function genMesLivres(){
        $stmt = $this->sqlGetLivresEmprunteByEleve();
        
        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>Nom livre</th>";
        echo "<th>Type livre</th>";
        echo "<th>Date d'emprunt</th>";
        echo "<th>Date de retour</th>";
        echo "</tr></thead><tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            //generation de la date de retour
            $dateRetour = generateDateRetour($row['date_emprunt']);

            echo "<tr>";
                echo "<td>".$row['titre_livre']."</td>";
                echo "<td>".$row['type_livre']."</td>";
                echo "<td>".dateEnToDateFr($row['date_emprunt'])."</td>";
                echo "<td>".dateEnToDateFr($dateRetour)."</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    
    public function getSqlAllLivres(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM " .$this->db_tables[0];

        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function sqlVerifDispo($isbn){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT etat FROM " .$this->db_tables[0]. 
                    " WHERE isbn = $isbn";

        $stmt = $conn->prepare($sqlQuery);              

        $stmt->execute();
        $tab=$stmt->fetch();
        return $tab;

        $conn=null;
        $stmt=null;
        
    }

    public function sqlGetLivresEmprunteByEleve(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM " .$this->db_tables[0].
                    " INNER JOIN ".$this->db_tables[1].
                    " ON livre.isbn = emprunt.isbn_fk ". 
                    " WHERE eleve_fk =" .$this->eleve;

        $stmt = $conn->prepare($sqlQuery);              

        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
        
    }
    public function sqlGetLivresEmprunte(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM ".$this->db_tables[0]. 
                        " INNER JOIN ".$this->db_tables[1]. 
                        " ON livre.isbn = emprunt.isbn_fk 
                        INNER JOIN ".$this->db_tables[2]. 
                        " ON eleve.id_eleve = emprunt.eleve_fk 
                        INNER JOIN ".$this->db_tables[3]. 
                        " ON eleve.id_eleve = scolarite.eleve_fk 
                        INNER JOIN ".$this->db_tables[4]. 
                        " ON classe.id_classe = scolarite.classe_fk";

        $stmt = $conn->prepare($sqlQuery);              

        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
        
    }

}