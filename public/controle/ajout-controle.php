<?php

if($_SESSION['userType'] == 'Eléve' || $_SESSION['userType']== 'Documentaliste'){
    header('Location:'.$router->generate('dashboard'));
    exit();
}

    $classe = new Classe();
    $sqlAllClasse = $classe->getAllClasse();
    $allClasse = $sqlAllClasse->fetchAll();

    $annee_scolaire=annee_scolaire_actuelle();
    
    $matieres = [
        'Français',
        'Mathématiques',
        'Anglais',
        'Histoire',
        'Géographie',
        'Éducation civique',
        'SVT',
        'Technologie',
        'Musique',
        'Arts plastiques',
        'EPS',
        'Physique',
        'Chimie'
    ];
    

    $titlePage = "Ajouter un contrôle";

    //var_dump($_POST);

    $success = false;
    $error = false;

    if(!empty($_POST)){
        
        //Verification du formulaire
        if(empty($_POST['classe'] && $_POST['matiere'] && $_POST['date_controle'] )){
            $error = true;
            $message = 'Veuillez remplir tout les champs ';
        }
        else{     
            $database = new Database();
            $conn = $database->getConnection();

            $controle = new Controle();
            $controle->setClasse($_POST['classe']);
            $controle->setMatiere($_POST['matiere']);
            $controle->setDate($_POST['date_controle']);
            $stmt = $conn->prepare("INSERT INTO controle SET 
                                    classe_fk = :classe_fk, 
                                    matiere = :matiere, 
                                    date_controle = :date_controle");
            $stmt->execute([
                'classe_fk' => $controle->getClasse(),
                'matiere' => $controle->getMatiere(),
                'date_controle' =>$controle->getDate()
            ]);

            $success = true;
        }
        
    }

?>
<div class="jumbotron">
    <form class="box" action="" method="post">
    <p class="box-return"><a href="<?= $router->generate('liste-controles')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des contrôles</u></a></p>
    <!-- Gestion des erreurs -->
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>Le contrôle du <?= dateEnToDateFr($_POST['date_controle']) .' pour la matière : '. $_POST['matiere']?> à été créé avec succes</div>
    <?php } ?>
    
        <div class="mb-3">
            <h4 class="title">Ajouter un contrôle</h4>

            <div class="form-group">
                <label class="font-weight-bold"> Classe : </label>								
                <select class="form-control" name="classe">
                <?php foreach($allClasse as $classe){?>
                    <option value="<?=$classe['id_classe']?>">
                    <?=$classe['nom_classe']?></option>	
                <?php } ?>				
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold"> Matière : </label>								
                <select class="form-control" name="matiere">
                <?php foreach($matieres as $matiere){?>
                    <option value="<?=$matiere?>">
                    <?=$matiere?></option>	
                <?php } ?>				
                </select>
            </div>
            <div class="form-group">
                <label>Date du contrôle</label>
                <input type="date" name="date_controle" class="form-control">
            </div>

            <input type='submit' name='create' value='Enregistrer' class='btn btn-success'>
        </div>
    </form>
</div>