<?php
    $livre = new Livre();

    @$id_eleve=$params['id'];
    $livre->setEleve($id_eleve);

    $titlePage = "Espace documentaliste";

?>
<h1>Espace documentaliste</h1>
<div class="jumbotron">
    <p class="box-return"><a href="<?= $router->generate('cdi')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour au CDI</u></a></p>
    <?php $livre->genLivresEmprunte(); ?>
</div>