<?php
    $livre = new Livre();

    if($_SESSION['userType'] == 'Eléve'){
        header('Location:'.$router->generate('dashboard'));
        exit();
    }

    @$id_eleve=$params['id'];
    $livre->setEleve($id_eleve);

    $success = false;
    $error = false;

    $titlePage = "Espace documentaliste";

    if(isset($_POST['retour'])){
        $livre->setIsbn($_POST['isbn']);
        $rendre = $livre->sqlLivreRendu($livre->getIsbn()); 
        $setRendu = $livre->setRendu($livre->getIsbn());
		$success = true;
	}

?>
<h1>Espace documentaliste</h1>
<div class="jumbotron">
    <p class="box-return"><a href="<?= $router->generate('cdi')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour au CDI</u></a></p>

    <?php if ($success == true){ ?>
	<div class='alert alert-success'>Le livre à été rendu</div>
    <?php } ?>

    <?php $livre->genLivresEmprunte(); ?>
</div>