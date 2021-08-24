<?php
    $user = new User();

	$success = false;
    $error = false;

	$titlePage = "Dashboard";

	if(!isset($_SESSION['userType'])){
        header('Location:'.$router->generate('log-in'));
    }
	
	if(isset($_POST['delete'])){
		$user->setIdUtilisateur($_POST['id_utilisateur']);
		$tab = $user->sqlVerifRole($user->getIdUtilisateur());
		if($tab['role'] == 'Directeur'){
			$error = true;
		}else{
			$del = $user->sqlDeleteUser($user->getIdUtilisateur());
			$success = true;
		}
	}
	
?>
<h1>Liste des utilisateurs</h1>
<!-- Gestion des erreurs -->
<?php if($error == true){?>
	<div class='alert alert-danger'>Impossible de supprimer cet utilisateur</div>
<?php } elseif ($success == true){ ?>
	<div class='alert alert-success'>L'utilisateur à été supprimer</div>
<?php } ?>
<?php $user->genUsers();?>
<?php if($_SESSION['userType'] !='Eléve'){?>
	<a class="btn btn-primary" href="<?=$router->generate('ajout-utilisateur')?>">Ajouter un utilisateur</a>
<?php } ?>
