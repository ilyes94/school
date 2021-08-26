<?php
    $controle = new Controle();

    $titlePage = "Liste des controles";

    $success = false;
    $error = false;


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
