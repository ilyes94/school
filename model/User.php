<?php

require_once __DIR__.'/connexion.php';

class User{
    private ?string $login;
    private ?string $nom;
    private ?string $prenom;
    private ?string $role;
    private ?string $pwd;
    private ?string $email;
    private ?int $id_utilisateur;

    /**
     * Get the value of login
     *
     * @return  ?string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @param  ?string  $login
     *
     * @return  self
     */
    public function setLogin(?string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return  ?string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  ?string  $nom
     *
     * @return  self
     */
    public function setNom(?string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return  ?string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param  ?string  $prenom
     *
     * @return  self
     */
    public function setPrenom(?string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }


        /**
     * Get the value of role
     *
     * @return  ?string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  ?string  $role
     *
     * @return  self
     */
    public function setRole(?string $role)
    {
        $this->role = $role;

        return $this;
    }

        /**
     * Get the value of pwd
     *
     * @return  ?string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @param  ?string  $pwd
     *
     * @return  self
     */
    public function setPwd(?string $pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

        /**
     * Get the value of email
     *
     * @return  ?string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  ?string  $email
     *
     * @return  self
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     *
     * @return  ?int
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @param  ?int  $id_utilisateur
     *
     * @return  self
     */
    public function setIdUtilisateur(?int $id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
    
    // Table
    private $db_table = "utilisateur";  


    function genUsers(){
        
        $stmt = $this->getSqlUsers();
        
        echo "<table class='table table-striped table-bordered'><thead><tr>";
        echo "<th>ID</th>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>Role</th>";
        echo "<th>E-mail</th>";
        if($_SESSION['userType'] =='admin'){
            echo "<th>Modifier</th>";
            echo "<th>Supprimer</th>";
        }
        echo "</tr></thead><tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<form action='' method='POST'>";	
            echo "<input type='hidden' value='". $row['id_utilisateur']."' name='id_utilisateur' />"; 
            echo "<td>".$row['id_utilisateur']."</td>";
            echo "<td>".$row['nom']."</td>";
            echo "<td>".$row['prenom']."</td>";
            echo "<td>".$row['role']."</td>";
            echo "<td>".$row['email']."</td>";
            if($_SESSION['userType'] =='admin'){
                echo "<td><a href='modif-user/".$row['id_utilisateur']."' class='btn btn-info'>Modifier</a></td>";
                echo "<td><a href='#' class='btn btn-danger' data-toggle='modal' data-target='#smallModal".$row['id_utilisateur']."'>Supprimer</a></td>";
            }
            echo "</tr>";
            echo "<div class='modal' id='smallModal".$row['id_utilisateur']."' tabindex='-1' role='dialog' aria-labelledby='smallModal' aria-hidden='true'>";
						echo "<div class='modal-dialog'>";
							echo "<div class='modal-content'>";
								echo "<div class='modal-header'>";
									echo "<h5 class='modal-title' id='myModalLabel'>Confirmation</h5>";
									echo "</div>";
									echo "<div class='modal-body'>";
										echo "<p>Confirmez la suppression de l'utilisateur <b>".ucfirst($row['login'])."</b><p>";
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

    function genSingleUser(){
        $stmt = $this->getSqlSingleUserByID($this->id_utilisateur);

        $row = $stmt->execute();
        $row = $stmt->fetch();
        echo "<form class='form' action='' method='post'>";
        echo "<input type='hidden' value='". $row['id_utilisateur']."' name='id_utilisateur' />";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Nom</label>";
                echo "<input type='text' name='nom' id='nom' class='form-control' value=".$row['nom']." required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Prenom</label>";
                echo "<input type='text' name='prenom' id='prenom' class='form-control' value=".$row['prenom']." required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Login</label>";
                echo "<input type='text' name='login' id='login' class='form-control' value=".$row['login']." required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>E-mail</label>";
                echo "<input type='text' name='email' id='email' class='form-control' value=".$row['email']." required>";
            echo "</div>";
            if($_SESSION['userType'] =='admin'){
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
            }
            echo "<input type='submit' name='update' value='Modifier' class='btn btn-success'>";
        echo '</form>';
    }

    function genCompteUser(){
        $stmt = $this->getSqlSingleUserByID($this->id_utilisateur);

        $row = $stmt->execute();
        $row = $stmt->fetch();
        echo "<form class='form' action='' method='post'>";
        echo "<input type='hidden' value='". $row['id_utilisateur']."' name='id_utilisateur' />";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Login</label>";
                echo "<input type='text' name='login' id='login' class='form-control' value=".$row['login']." required>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>E-mail</label>";
                echo "<input type='text' name='email' id='email' class='form-control' value=".$row['email']." required>";
            echo "</div>";
            echo "<input type='submit' name='update' value='Modifier' class='btn btn-success'>";
        echo '</form>';
    }
    function genUpdatePwd(){
        $stmt = $this->getSqlSingleUserByID($this->id_utilisateur);

        $row = $stmt->execute();
        $row = $stmt->fetch();
        echo "<form class='form' action='' method='post'>";
            echo "<input type='hidden' value='". $row['id_utilisateur']."' name='id_utilisateur' />";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Nouveau mot de passe</label>";
                echo "<input type='password' name='password' id='password' class='form-control'>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<label class='label-control'>Confirmer le mot de passe</label>";
                echo "<input type='password' name='confPassword' id='password' class='form-control'>";
            echo "</div>";
            echo "<input type='submit' name='update' value='Modifier' class='btn btn-success'>";
        echo '</form>';
    }
    
    public function getSqlUsers(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM ". $this->db_table;

         
        $stmt = $conn->prepare($sqlQuery);              
        
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function getSqlSingleUserByID(){
        $database = new Database();
        $conn = $database->getConnection();

        $sqlQuery = "SELECT * FROM $this->db_table WHERE id_utilisateur = $this->id_utilisateur";
        
        $stmt = $conn->prepare($sqlQuery);

        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

    public function sqlVerifEmail($email){
        $database = new Database();
        $conn = $database->getConnection();
    
        $stmt=$conn->prepare("select * from $this->db_table where email=? limit 1");
        $stmt->execute([$email]);
        $tab=$stmt->fetch();
        return $tab;

        $conn=null;
        $stmt=null;
    }

    public function sqlVerifRole($id_utilisateur){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt=$conn->prepare("select role from $this->db_table where id_utilisateur = $id_utilisateur");
        $stmt->execute([$id_utilisateur]);
        $tab=$stmt->fetch();
        return $tab;

        $conn=null;
        $stmt=null;
    }

    public function sqlDeleteUser($id_utilisateur){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt=$conn->prepare ("DELETE FROM ". $this->db_table ." WHERE id_utilisateur = $id_utilisateur");
        $stmt->execute();
        return $stmt;

        $conn=null;
        $stmt=null;
    }

}
?>