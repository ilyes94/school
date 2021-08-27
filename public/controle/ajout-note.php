<?php
    $controle = new Controle();

    if($_SESSION['userType'] == 'Eléve'){
        header('Location:'.$router->generate('dashboard'));
        exit();
    }

    $titlePage = "Ajout des notes";

    @$id_controle=$params['id'];
    @$classe_controle=$params['classe'];
    $controle->setId_controle($id_controle);
    $controle->setClasse($classe_controle);
    echo $controle->getClasse();
    $success = false;
    $error = false;
    var_dump($_POST);

?>
<div class="jumbotron">
	<h1>Ajout des notes</h1>
    <p class="box-return"><a href="<?= $router->generate('liste-controles')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des éléves</u></a></p>
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>Modifier avec succes</div>
        <?php } ?>
	<div>

	</div>
</div>