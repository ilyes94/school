<?php
    $eleve = new Eleve();

    if($_SESSION['userType'] == 'Eléve' || $_SESSION['userType']== 'Documentaliste' || $_SESSION['userType']== 'Enseignant'){
        header('Location:'.$router->generate('dashboard'));
        exit();
    }

    $titlePage = "Modification d'un éléve";

    @$id_eleve=$params['id'];
    $eleve->setId_eleve($id_eleve);
    $success = false;
    $error = false;

    //var_dump($_POST);

    if(!empty($_POST)){
        if(empty($_POST['email'] && $_POST['tel'] && $_POST['adresse'] && $_POST['ville'] && $_POST['ville'] && $_POST['cp'])){
            $error = true;
            $message = "Veuillez remplir tout les champs";
        }//Verification de l'email
        $eleve->setEmail($_POST['email']);
        $user = new User();
        $tab = $user->sqlVerifEmail($eleve->getEmail());
        if($tab['id_utilisateur'] != $eleve->getId_eleve()){
            $error = true;
            $message = "L'adresse e-mail existe déjà";
        }else{
            $eleve->setTel($_POST['tel']);
            $eleve->setAdresse($_POST['adresse']);
            $eleve->setVille($_POST['ville']);
            $eleve->setCp($_POST['cp']);

            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare("UPDATE eleve SET
                                    email = :email, 
                                    tel = :tel, 
                                    adresse = :adresse, 
                                    ville = :ville, 
                                    cp = :cp
                                    WHERE id_eleve = :id");
            
            $stmt->execute([
                'id' => $eleve->getId_eleve(),
                'email' => $eleve->getEmail(),
                'tel' => $eleve->getTel(),
                'adresse' => $eleve->getAdresse(),
                'ville' => $eleve->getVille(),
                'cp' => $eleve->getCp()
            ]);
            $success = true;
        }
    }

?>
<div class="jumbotron">
	<h1>Modifier un éléve</h1>
    <p class="box-return"><a href="<?= $router->generate('liste-eleves')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des éléves</u></a></p>
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>Modifier avec succes</div>
        <?php } ?>
	<div>
		<?php $eleve->genSingleEleve();?>
	</div>
</div>