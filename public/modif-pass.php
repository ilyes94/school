<?php
    $user = new User();

    $titlePage = "Modifier mon mot de passe";

    @$id_utilisateur=$params['id'];
    $user->setIdUtilisateur($id_utilisateur);
    $success = false;
    $error = false;

    if($_SESSION['id'] != $user->getIdUtilisateur()){
        header('Location:'.$router->generate('home'));
        exit();
    }

    if(!empty($_POST)){
        $hashPwd = hash ('sha256', $_POST['password']);
        $user->setPwd($hashPwd);
        //Verification des champs
        if(empty($_POST['password'] && $_POST['confPassword'])){
            $error = true;
            $message = "Veuillez remplir tout les champs";
        }
        //Verification du mdp
        if($_POST['password'] != $_POST['confPassword']){
            $error = true;
            $message = "Les mots de passe ne sont pas identiques";
        }else{
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare("UPDATE utilisateur SET pwd = :pwd WHERE id_utilisateur = :id");
            $stmt->execute([
                'id' => $user->getIdUtilisateur(),
                'pwd' => $user->getPwd()
            ]);
            $success = true;
        }
    }
?>
<div class="jumbotron">
	<h1>Modifier mon mot de passe</h1>
    <p class="box-return"><a href="<?= $router->generate('dashboard')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des utilisateur</u></a></p>
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>Votre mot de passe à été modifié avec succes</div>
        <?php } ?>
	<div>
		<?php $user->genUpdatePwd();?>
	</div>
</div>