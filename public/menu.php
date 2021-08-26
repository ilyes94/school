
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"><img src="<?=$_SESSION['root']?>/assets/img/logo.png" width="50%" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Utilisateurs -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Utilisateurs
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= $router->generate('dashboard')?>">Liste des utilisateurs</a></li>
            <li><a class="dropdown-item" href="<?= $router->generate('ajout-utilisateur')?>">Ajouter un utilisateur</a></li>
          </ul>
        </li>
        <!-- Eleves -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Eléves
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= $router->generate('liste-eleves')?>">Liste des éléves</a></li>
            <li><a class="dropdown-item" href="<?= $router->generate('ajout-eleve')?>">Ajouter un éléve</a></li>
          </ul>
        </li>
        <!-- Controles -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Controles
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= $router->generate('liste-controles')?>">Liste des controles</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="fa fa-user-circle-o"></span>&nbsp <?= ucfirst($_SESSION['prenom']) ?> 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= $router->generate('mon-compte', array('id' => $_SESSION['id']))?>"><span class="fa fa-vcard-o"></span>&nbsp Mon compte</a></li>
            <li><a class="dropdown-item" href="<?= $router->generate('modif-pass', array('id' => $_SESSION['id']))?>"><span class="fa fa-lock"></span>&nbsp Changer le mot de passe</a></li>
            <li><a class="dropdown-item" href="<?= $router->generate('log-out')?>"> <span class="fa fa-sign-out"></span>&nbsp Se déconecter</a></li>
          </ul>
        </li>
      </ul>
      </form>
    </div>
  </div>
</nav>