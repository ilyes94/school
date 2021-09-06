<?php
    $livre = new Livre();

    if($_SESSION['userType'] !== 'Eléve'){
        header('Location:'.$router->generate('dashboard'));
        exit();
    }

    @$id_eleve=$params['id'];
    $livre->setEleve($id_eleve);

    $titlePage = "Mes emprunts";

?>
<h1>Mes emprunts</h1>
<div class="jumbotron">
    <p class="box-return"><a href="<?= $router->generate('cdi')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour au CDI</u></a></p>
    <?php $livre->genMesLivres();?>
</div>


