<?php
    $livre = new Livre();

	$success = false;
    $error = false;

	$titlePage = "CDI";
    
    if(!empty($_POST)){
        
        $dis = $livre->sqlVerifDispo($_POST['isbn']);
        var_dump($dis);
        //Verification de la disponibilité
        if($dis['etat']== 1){
            $error = true;
            $message = 'Le livre n\'\est pas disponible';
        }
        
        else{    
            $database = new Database();
            $conn = $database->getConnection();
            
            $livre->setIsbn($_POST['isbn']);
            $livre->setEleve($_POST['id_eleve']);
            $livre->setEtat(1);
            $today = dateFrToDateEn(date("d/m/Y"));
            $livre->setDateEmprunt($today);

            $stmt = $conn->prepare("INSERT INTO emprunt SET 
                                    isbn_fk = :isbn_fk, 
                                    eleve_fk = :eleve_fk,
                                    date_emprunt = :date_emprunt");
            $stmt->execute([
                'isbn_fk' => $livre->getIsbn(),
                'eleve_fk' => $livre->getEleve(),
                'date_emprunt' =>$livre->getDateEmprunt()
            ]);

            $stmt = $conn->prepare("UPDATE livre SET 
                                    etat = :etat
                                    WHERE isbn = :isbn");
            $stmt->execute([
                'isbn' => $livre->getIsbn(),
                'etat' => $livre->getEtat()
            ]);
            
            $success = true;
            
        }
        
    }
?>
<div class="jumbotron">
    <h1>CDI</h1>
    <!-- Gestion des erreurs -->
    <div class="row">
            <?php if($error == true){?>
                <div class='alert alert-danger'>Le livre n'est pas disponible</div>
            <?php } elseif ($success == true){ ?>
                <div class='alert alert-success'>Vous avez bien reserver ce livre</div>
            <?php } ?>
            <?php $livre->genLivres(); ?>
        </div>
</div>    