<?php
    $livre = new Livre();

    @$id_eleve=$params['id'];
    $livre->setEleve($id_eleve);

    if($_SESSION['userType'] !== 'Eléve' || $_SESSION['id_eleve'] != $livre->getEleve()){
        header('Location:'.$router->generate('dashboard'));
        exit();
    }




    $titlePage = "Mes emprunts";

?>
<h1>Mes emprunts</h1>
<div class="jumbotron">
    <p class="box-return"><a href="<?= $router->generate('cdi')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour au CDI</u></a></p>
    <?php $livre->genMesLivres();?>
</div>


