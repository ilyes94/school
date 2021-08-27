<?php
    $controle = new Controle();

    if($_SESSION['userType'] == 'Eléve'){
        header('Location:'.$router->generate('dashboard'));
        exit();
    }

    $titlePage = "Ajout des notes";
    $success = false;
    $error = false;

    @$id_controle=$params['id'];
    $controle->setId_controle($id_controle);
    
    var_dump($_POST);

    $classe = $controle->getSqlClasseByControle();
    $controle->setClasse($classe['classe_fk']);

    $eleves = $controle->getSqlElevesByClasse();
    

?>
<div class="jumbotron">
	<h1>Ajout des notes</h1>
    <p class="box-return"><a href="<?= $router->generate('liste-controles')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des contrôles</u></a></p>
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>Enregistrer avec succes</div>
        <?php } ?>
	<div>
       <?php $controle->genClasse(); ?>
	</div>
</div>