<?php
    $user = new User();
    $titlePage = "Connexion";
    $error = false;
    

    if(!empty($_POST)){
        if(empty($_POST['login'] && $_POST['password'])){
            $error = true;
            $message = "Veuillez remplir tout les champs";
        }
        $user->setLogin($_POST['login']);
        $hashPwd = hash ('sha256', $_POST['password']);
        $user->setPwd($hashPwd);
        $tab = $user->sqlVerifLoginPwd($user->getLogin(), $user->getPwd());

        if ($tab==null) {
            $error = true;
            $message="Mauvais email ou mot de passe!";
        }else{

            $_SESSION["userType"]=$tab["role"];
            $_SESSION["id"]=$tab["id_utilisateur"];
            $_SESSION["prenom"]=$tab["prenom"];
            header('Location:'.$router->generate('dashboard'));
        }
    }
    

?>
<div class="jumbotron">
	<h1>Connexion à mon espace</h1>
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } ?>
    <form class="box" action="" method="post" name="login">
        <div class="form-floating my-3">
            <input type="text" class="form-control" id="floatingInput" name="login" placeholder="Login" required>
            <label for="floatingInput">Login</label>
            <h6 class="text-danger">Pour votre 1<sup>ére</sup> connexion votre login est la premiere partie de votre e-mail : <u>utilisateur@gmail.com -> Login : utilisateur</u></h6>
        </div>
        
        <div class="form-floating my-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Mot de passe" required>
            <label for="floatingPassword">Mot de passe</label>
            <h6 class="text-danger">Pour votre 1<sup>ére</sup> connexion votre mot de passe est votre nom + prenom : <u> Mekki Ilyes -> Mot de passe : mekkiilyes</u></h6>
        </div>

        <input type="submit" value="Connexion " name="valider" class="btn btn-primary box-button">
        </form>
	</div>
</div>