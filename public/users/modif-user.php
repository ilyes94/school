<?php
    $user = new User();

    if($_SESSION['userType'] == 'Eléve' || $_SESSION['userType'] == 'Documentaliste' || $_SESSION['userType'] == 'Enseignant'){
        header('Location:'.$router->generate('dashboard'));
        exit();
    }

    $titlePage = "Modification d'un utilisateur";

    @$id_utilisateur=$params['id'];
    $user->setIdUtilisateur($id_utilisateur);
    $success = false;
    $error = false;
    if(!empty($_POST)){
        if(empty($_POST['nom'] && $_POST['prenom'] && $_POST['email'] && $_POST['role'])){
            $error = true;
            $message = "Veuillez remplir tout les champs";
        }
        //Initialisation de l'objet
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setEmail($_POST['email']);
        $user->setRole($_POST['role']);
        //Verification de l'email
        $tab = $user->sqlVerifEmail($user->getEmail());
        if($tab['id_utilisateur'] != $user->getIdUtilisateur()){
            $error = true;
            $message = "L'adresse e-mail existe déjà";
        }else{
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, role = :role WHERE id_utilisateur = :id");
            $stmt->execute([
                'id' => $user->getIdUtilisateur(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' =>$user->getEmail(),
                'role' =>$user->getRole()
            ]);
            $success = true;
        }
    }

?>
<div class="jumbotron">
	<h1>Modifier un utilisateur</h1>
    <p class="box-return"><a href="<?= $router->generate('dashboard')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des utilisateur</u></a></p>
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>Modifier avec succes</div>
        <?php } ?>
	<div>
		<?php $user->genSingleUser();?>
	</div>
</div>