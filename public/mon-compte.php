<?php
    $user = new User();

    $titlePage = "Mon compte";

    @$id_utilisateur=$params['id'];
    $user->setIdUtilisateur($id_utilisateur);
    $success = false;
    $error = false;

    var_dump($_POST);

    if(!empty($_POST)){
        //Initialisation de l'objet
        $user->setLogin($_POST['login']);
        $user->setEmail($_POST['email']);
        $user->setPwd($_POST['password']);
        //Verification des champs
        if(empty($_POST['login'] && $_POST['email'])){
            $error = true;
            $message = "Veuillez remplir tout les champs";
        }
        //Verification du mail
        $tab = $user->sqlVerifEmail($user->getEmail());
        if($tab['id_utilisateur'] != $user->getIdUtilisateur()){
            $error = true;
            $message = "L'adresse e-mail existe déjà";
        }
        //Verification du mdp
        
        if($_POST['password'] != $_POST['confPassword']){
            $error = true;
            $message = "Les mots de passe ne sont pas identiques";
        }else{
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare("UPDATE utilisateur SET login = :login, email = :email, pwd = :pwd WHERE id_utilisateur = :id");
            $stmt->execute([
                'id' => $user->getIdUtilisateur(),
                'login' =>$user->getLogin(),
                'email' =>$user->getEmail(),
                'pwd' =>$user->getRole()
            ]);
            $success = true;
        }
    }
?>
<div class="jumbotron">
	<h1>Modifier mon compte</h1>
    <p class="box-return"><a href="<?= $router->generate('dashboard')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des utilisateur</u></a></p>
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>Votre profil à été modifié avec succes</div>
        <?php } ?>
	<div>
		<?php $user->genCompteUser();?>
	</div>
</div>