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
    
    if(!empty($_POST)){
        $countNotes = count($_POST['notes']);
        //verification des champs
        for($i = 0; $i<$countNotes; $i++){
            if(!isset($_POST['notes'][$i])){
                $error = true;
                $message = "Veuillez remplir tout les champs";
            }
            if($_POST['notes'][$i]>20){
                $error = true;
                $message = "Vous ne pouvez pas mettre plus que 20";
            }else{
                $database = new Database();
                $conn = $database->getConnection();
            
                $controle->setNote($_POST['notes'][$i]);
                $controle->setEleve($_POST['id_eleve'][$i]);

                $stmt = $conn->prepare("INSERT INTO note_controle SET
                                        controle_fk = :controle_fk,
                                        eleve_fk = :eleve_fk,
                                        absence = :absence,
                                        note = :note");

                $stmt->execute([
                    'controle_fk' => $controle->getId_controle(),
                    'eleve_fk' => $controle->getEleve(),
                    'absence' => false,
                    'note' => $controle->getNote()
                ]);

                
                //Gerer les absences
                if(isset($_POST['abs'][$i])) {
                    $controle->setAbsence($_POST['abs'][$i]);
                    $stmt = $conn->prepare("UPDATE note_controle SET
                                            absence = :absence
                                            WHERE eleve_fk = :eleve_fk AND controle_fk = :controle_fk ");
            
                    $stmt->execute([
                        'eleve_fk' => $controle->getAbsence(),
                        'controle_fk' => $controle->getId_controle(),
                        'absence' => true
                    ]);
                }
                $success = true;
                
            }
        }
    }

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