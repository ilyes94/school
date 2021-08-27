<?php
    if(isset($_GET['annee_scolaire'])){
        $annee_scolaire=$_GET['annee_scolaire'];
    }else{
        $annee_scolaire=annee_scolaire_actuelle();
    }

    $classe = new Classe();
    $sqlAllClasse = $classe->getAllClasse();
    $allClasse = $sqlAllClasse->fetchAll();
    
    $titlePage = "Ajouter un éléve";

    $success = false;
    $error = false;
    
    if(!empty($_POST)){
        
        //Verification du formulaire
        if(empty($_POST['sexe'] && $_POST['nom'] && $_POST['prenom'] && $_POST['email'] && $_POST['tel'] && $_POST['adresse'] && $_POST['ville'] && $_POST['ville'] && $_POST['cp'] && $_POST['date_naissance'] && $_POST['lieu_naissance'] && $_POST['classe'] && $_POST['annee_scolaire'] && $_POST['date_inscription'])){
            $error = true;
            $message = 'Veuillez remplir tout les champs ';
        }
        //Verification de l'email
        $eleve = new Eleve();
        $eleve->setEmail($_POST['email']);
        $user = new User();
        $tab = $user->sqlVerifEmail($eleve->getEmail());
        if($tab){
            $error = true;
            $message = "L'adresse e-mail existe déjà";
        }else{
            $eleve->setSexe($_POST['sexe']);
            $eleve->setNom($_POST['nom']);
            $eleve->setPrenom($_POST['prenom']);
            $eleve->setTel(str_replace(' ', '', $_POST['tel']));
            $eleve->setAdresse($_POST['adresse']);
            $eleve->setVille($_POST['ville']);
            $eleve->setCp($_POST['cp']);
            $eleve->setDate_naissance($_POST['date_naissance']);
            $eleve->setLieu_naissance($_POST['lieu_naissance']);
            $eleve->setClasse($_POST['classe']);
            $eleve->setAnne_scolaire($_POST['annee_scolaire']);
            $eleve->setDate_insciption($_POST['date_inscription']);

            $database = new Database();
            $conn = $database->getConnection();
            //CREATION DE l'eleve en Utilisateur
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
            $user->setRole('Eléve');
            
            $stmt = $conn->prepare("INSERT INTO utilisateur SET nom = :nom, prenom = :prenom, login = :login, pwd = :pwd, email = :email, role = :role");
            $stmt->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'login' =>$user->getLogin(),
                'pwd' =>$user->getPwd(),
                'email' =>$user->getEmail(),
                'role' =>$user->getRole()
            ]);
            //Creation de l'eleve
            //Recuperation de l'id de la derniere inscription
            $last_inscrtit = $user->getLastUser();
            $eleve->setId_eleve($last_inscrtit['id_utilisateur']);

            $stmt = $conn->prepare("INSERT INTO eleve SET 
                                    sexe = :sexe, 
                                    nom = :nom, 
                                    prenom = :prenom, 
                                    email = :email, 
                                    tel = :tel, 
                                    adresse = :adresse, 
                                    ville = :ville, 
                                    cp = :cp,
                                    date_naissance = :date_naissance,
                                    lieu_naissance = :lieu_naissance,
                                    date_inscription = :date_inscription,
                                    utilisateur_fk = :utilisateur_fk");
            $stmt->execute([
                'sexe' => $eleve->getSexe(),
                'nom' => $eleve->getNom(),
                'prenom' => $eleve->getPrenom(),
                'email' =>$eleve->getEmail(),
                'tel' =>$eleve->getTel(),
                'adresse' =>$eleve->getAdresse(),
                'ville' =>$eleve->getVille(),
                'cp' =>$eleve->getCp(),
                'date_naissance' =>$eleve->getDate_naissance(),
                'lieu_naissance' =>$eleve->getLieu_naissance(),
                'date_inscription' =>$eleve->getDate_insciption(),
                'utilisateur_fk' => $eleve->getId_eleve()
            ]);
            //INSERTION DANS SCOLARITE

            $stmt = $conn->prepare("INSERT INTO scolarite SET 
                                    annee_scolaire = :annee_scolaire, 
                                    eleve_fk = :eleve_fk, 
                                    classe_fk = :classe");
            $stmt->execute([
                'annee_scolaire' => $eleve->getAnne_scolaire(),
                'eleve_fk' => $eleve->getId_eleve(),
                'classe' => $eleve->getClasse()
            ]);

            $success = true;
        }
        
    }
    
?>
<div class="jumbotron">
    <form class="box" action="" method="post">
    <p class="box-return"><a href="<?= $router->generate('liste-eleves')?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
    <u>Retour à la liste des éléves</u></a></p>
    <!-- Gestion des erreurs -->
    <?php if($error == true){?>
        <div class='alert alert-danger'><?=$message?></div>
    <?php } elseif ($success == true){ ?>
        <div class='alert alert-success'>L'éléve <?=$_POST['nom'] .' '. $_POST['prenom']?> à été créé avec succes</div>
    <?php } ?>
    
        <div class="mb-3">
            <h4 class="title">Ajouter un éléve</h4>

            <div class="mb-3">
				<label>Civilitée</label>
				<div class="row fieldset">					
					<div class="col-sm-6 col-md-1">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="sexe" value="M" id="flexRadioDefault1" <?php if(isset($_POST['sexe']) && $_POST['sexe']=='M.')echo 'checked'?>>
							<label class="form-check-label" for="flexRadioDefault1">
								M.
							</label>
						</div>
					</div>
					<div class="col-sm-6 col-md-1">
						<div class="form-check ">
							<input class="form-check-input" type="radio" name="sexe" value="Mme" id="flexRadioDefault2" <?php if(isset($_POST['sexe']) && $_POST['sexe']=='Mme')echo 'checked'?>>
							<label class="form-check-label" for="flexRadioDefault2">
								Mme
							</label>
						</div>
					</div>
				</div>
			</div>

            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="nom" placeholder="Nom" required>
                <label for="floatingInput">Nom</label>    
            </div>
                
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="prenom" placeholder="Prenom" required>
                <label for="floatingInput">Prenom</label>    
            </div>
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="email" placeholder="E-mail" required>
                <label for="floatingInput">E-mail</label>    
            </div>
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="tel" placeholder="Télephone" required>
                <label for="floatingInput">Télephone</label>    
            </div>
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="adresse" placeholder="Adresse" required>
                <label for="floatingInput">Adresse</label>    
            </div>
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="ville" placeholder="Ville" required>
                <label for="floatingInput">Ville</label>    
            </div>
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="cp" placeholder="Code postal" required>
                <label for="floatingInput">Code postal</label>    
            </div>
            <div class="form-group">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control">
            </div>
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" name="lieu_naissance" placeholder="Ville de naissance" required>
                <label for="floatingInput">Ville de naissance</label>    
            </div>
            <div class="form-group">
                <label class="font-weight-bold"> Classe : </label>								
                <select class="form-control" name="classe">
                <?php foreach($allClasse as $classe){?>
                    <option value="<?=$classe['id_classe']?>">
                    <?=$classe['nom_classe'].' '.$classe['annee_scolaire_classe']?></option>	
                <?php } ?>				
                </select>
            </div>
            <div class="form-group">
                <label> Année scolaire: </label>
                    <?php $annee_debut=2020; ?>
                    <select class="form-control" name="annee_scolaire">
                        <?php 
                        for($i=1 ; $i<=nombre_annee_scolaire() ; $i++){
                            $annee_sc=($annee_debut+($i-1)) ."/". ($annee_debut+$i);
                        ?>
                        <option <?php if($annee_scolaire==$annee_sc) echo 'selected' ?> > 
                                <?php echo $annee_sc; ?>
                        </option>
                    <?php } ?>
                    </select>
            </div>
            <div class="form-group">
                <label>Date d'inscription</label>
                <input type="date" name="date_inscription" class="form-control">
            </div>
            
            <input type='submit' name='create' value='Enregistrer' class='btn btn-success'>
        </div>
    </form>
</div>