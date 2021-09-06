<?php
    $controle = new Controle();

    if($_SESSION['userType'] == 'Documentaliste'){
        header('Location:'.$router->generate('espace-documentaliste'));
        exit();
    }

    $titlePage = "Liste des controles";

    $success = false;
    $error = false;
    if(isset($_POST['delete'])){
        $controle->setId_controle($_POST['id_controle']);
		$del = $controle->sqlDeleteControle($controle->getId_controle());
		$success = true;
	}

?>
<h1>Liste des controles</h1>
<!-- Gestion des erreurs -->
<?php if($error == true){?>
	<div class='alert alert-danger'>Impossible de supprimer ce contrôle </div>
<?php } elseif ($success == true){ ?>
	<div class='alert alert-success'>Le contrôle à été supprimer</div>
<?php } ?>
<?php $controle->genControles();?>
<?php if($_SESSION['userType'] !='Eléve'){?>
	<a class="btn btn-primary" href="<?=$router->generate('ajout-controle')?>">Ajouter un controle</a>
<?php } ?>
