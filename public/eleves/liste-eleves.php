<?php
    $classe = new Classe();
    $sqlAllClasse = $classe->getAllClasse();
    $allClasse = $sqlAllClasse->fetchAll();

    $eleve = new Eleve();

    $success = false;
    $error = false;
    //suppression
    if(isset($_POST['delete'])){
        $user = new User();
        $eleve->setId_eleve($_POST['id_eleve']);
		$del = $user->sqlDeleteUser($eleve->getId_eleve());
		$success = true;
	}

    $titlePage = "Liste des eleves";


    //Filtres
    if(isset($_GET['annee_scolaire'])){
        $annee_scolaire=$_GET['annee_scolaire'];
    }else{
		$annee_scolaire=annee_scolaire_actuelle();
    }

    if(isset($_GET['classe'])){
        $classe=$_GET['classe'];
    }else{
		$classe=0;
    }


	if(isset($_GET['search'])){
        $search=$_GET['search'];
    }	
	else{
        $search="";
    }
    //requete

?>

<h1> Liste des eleves </h1>
<div class="card">
	<div class="card-header bg-primary text-white">Rechecher d'éléves</div>
        <div class="card-body">
            <form class="form-inline" >
                    <label> Année scolaire: </label>
                    <?php $annee_debut=2020; ?>
                    <select class="form-control mx-2" 
                        name="annee_scolaire"
                        onChange="this.form.submit();">
                        <?php 
                        for($i=1 ; $i<=nombre_annee_scolaire() ; $i++){
                            $annee_sc=($annee_debut+($i-1)) ."/". ($annee_debut+$i);
                        ?>
                        <option <?php if($annee_scolaire==$annee_sc) echo 'selected' ?> > 
                                <?php echo $annee_sc; ?>
                        </option>
                    <?php } ?>
                    </select>
                

                <label> Classe: </label>								
                <select class="form-control mx-2" 
                    name="classe"
                    onChange="this.form.submit();">
                    <option value="0">Toute les classes</option>
                    <?php foreach($allClasse as $clas){?>
                    <option value="<?=$clas['nom_classe']?>">
                    <?=$clas['nom_classe']?></option>	
                    <?php } ?>						
                </select>
                
            <input type="text" name="search" value="<?php echo $search ?>" class="form-control" placeholder="Nom ou prénom">
            <button class="btn btn-primary mx-2"><span class="fa fa-search"></span> Rechercher</button>
        </form>
    </div>
</div>

<!-- Gestion des erreurs -->
<?php if ($success == true){ ?>
	<div class='alert alert-success'>L'éléve à été supprimer</div>
<?php } ?>
    <?php if(isset($_GET['search'])){
        $eleve->genEleves(1,$search,$classe,$annee_scolaire);
    }else{
        $eleve->genEleves(0,$search,$classe,$annee_scolaire);

    }
        ?>
        <a class="btn btn-primary" href="<?=$router->generate('ajout-eleve')?>">Ajouter un éléve</a>