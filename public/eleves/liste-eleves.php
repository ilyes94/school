<?php
    $eleve = new Eleve();

    $success = false;
    $error = false;
    
    $titlePage = "Liste des eleves";

    if(isset($_GET['annee_scolaire'])){
        $annee_scolaire=$_GET['annee_scolaire'];
    }else{
		$annee_scolaire=annee_scolaire_actuelle();
    }
		if(isset($_GET['search'])){
            $search=$_GET['search'];
        }	
		else{
            $search="";
        }		
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
                <select class="form-control mx-2" name="classe"	>
                    <option value="6éme">6éme</option>							
                    <option value="5éme">5éme</option>
                    <option value="4éme">4éme</option>
                    <option value="3éme">3éme</option>						
                </select>
                
            <input type="text" name="search" value="<?php echo $search ?>" class="form-control" placeholder="Nom ou prénom">
            <button class="btn btn-primary"><span class="fa fa-search"></span> Rechercher</button>
        </form>
    </div>
</div>

<!-- Gestion des erreurs -->
<?php if ($success == true){ ?>
	<div class='alert alert-success'>L'éléve à été supprimer</div>
<?php } ?>
<?php $eleve->genEleves();?>
<a class="btn btn-primary" href="<?=$router->generate('ajout-eleve')?>">Ajouter un éléve</a>