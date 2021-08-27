<?php

    $titlePage = "Ajouter un utilisateur";

    $success = false;
    $error = false;
    if(!empty($_POST)){
        //var_dump($_POST);
        $user = new User();
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setEmail($_POST['email']);
        $user->setRole($_POST['role']);

        //Verification du formulaire
        if(empty($_POST['nom'] && $_POST['prenom'] && $_POST['email'] && $_POST['role'])){
            $error = true;
            $message = 'Veuillez remplir tout les champs ';
        }
        //Verification de l'email
        $tab = $user->sqlVerifEmail($user->getEmail());
        if($tab){
            $error = true;
            $message = "L'adresse e-mail existe déjà";
        }else{
            
            $database = new Database();
            $conn = $database->getConnection();
            //creation du mdp
            $pwd = strtolower($_POST['nom'].$_POST['prenom']);
            $hashPwd = hash ('sha256', $pwd);
            //creation du login
            $login = before('@', $_POST['email']);

            $user->setNom($_POST['nom']);
            $user->setPrenom($_POST['prenom']);
            $user->setLogin($login);
            $user->setPwd($hashPwd);
            $user->setEmail($_POST['email']);
            $user->setRole($_POST['role']);
            
            $stmt = $conn->prepare("INSERT INTO utilisateur SET nom = :nom, prenom = :prenom, login = :login, pwd = :pwd, email = :email, role = :role");
            $stmt->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'login' =>$user->getLogin(),
                'pwd' =>$user->getPwd(),
                'email' =>$user->getEmail(),
                'role' =>$user->getRole()
            ]);
            
            $success = true;

        }
    }
    //echo $page;
?>
<div class="jumbotron">
    <form class="box" action="" method="post">
    <p class="box-return"><a href="<?= $router->generate('dashboard')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des utilisateur</u></a></p>
    <!-- Gestion des erreurs -->
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>L'utilisateur <?=$_POST['nom']?> à été créé avec succes</div>
    <?php } ?>
    
        <div class="mb-3">
            <h4 class="title">Ajouter un utilisateur</h4>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label class='label-control'>Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="" required>
                </div>
            
                <div class="col">
                    <label class='label-control'>Prénom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="" required>
                </div>
            </div>    
        </div>

        <div class="mb-3">
            <label for="label-control">Adresse e-mail</label>
            <input type="email" class="form-control" name="email" placeholder="" required>
        </div>

        <label for="label-control">Rôle</label>
        <select name="role" class="form-select mb-3">
            <option value="Secrétaire">Secrétaire</option>
            <option value="Eléve">Eléve</option>
        </select>

        <input type='submit' name='create' value='Enregistrer' class='btn btn-success'>
    </form>
</div>