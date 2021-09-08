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
    <?php if ($success == true){ ?>
	<div class='alert alert-success'>Le livre à été rendu</div>
    <?php } ?>

    <?php $livre->genLivresEmprunte(); ?>
</div>