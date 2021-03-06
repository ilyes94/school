<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
	require './altorouter/AltoRouter.php';
	$uri = $_SERVER['REQUEST_URI'];


	//fonctions
	include __DIR__ . '/public/function.php';

	// models
	include __DIR__ . '/model/User.php';
	include __DIR__ . '/model/Eleve.php';
	include __DIR__ . '/model/Controle.php';
	include __DIR__ . '/model/Classe.php';
	include __DIR__ . '/model/Livre.php';

	$router = new AltoRouter();

	$router->setBasePath($_SERVER['BASE_URI']);

	$router->map('GET|POST', '/' , 'auth/log-in', 'log-in');
	//Utilisateur
	$router->map('GET|POST', '/dashboard', 'dashboard', 'dashboard');
	$router->map('GET|POST', '/modif-user/[i:id]', 'users/modif-user', 'modif-user');
	$router->map('GET|POST', '/ajout-utilisateur', 'users/ajout-utilisateur', 'ajout-utilisateur');
	
	//Compte
	$router->map('GET|POST', '/mon-compte/[i:id]', 'users/mon-compte', 'mon-compte');
	$router->map('GET|POST', '/modif-mot-de-passe/[i:id]', 'users/modif-pass', 'modif-pass');
	$router->map('GET', '/log-out', 'auth/log-out', 'log-out');

	//Eleve
	$router->map('GET|POST', '/liste-eleves', 'eleves/liste-eleves', 'liste-eleves');
	$router->map('GET|POST', '/ajout-eleve', 'eleves/ajout-eleve', 'ajout-eleve');
	$router->map('GET|POST', '/modif-eleve/[i:id]', 'eleves/modif-eleve', 'modif-eleve');

	//controle
	$router->map('GET|POST', '/liste-controles', 'controle/liste-controles', 'liste-controles');
	$router->map('GET|POST', '/ajout-controle', 'controle/ajout-controle', 'ajout-controle');
	$router->map('GET|POST', '/modif-controle/[i:id]', 'controle/modif-controle', 'modif-controle');
	$router->map('GET|POST', '/ajout-note/[i:id]', 'controle/ajout-note', 'ajout-note');

	//CDI
	$router->map('GET|POST', '/cdi', 'cdi/cdi', 'cdi');
	$router->map('GET', '/mes-emprunts/[i:id]', 'cdi/mes-emprunts', 'mes-emprunts'); 
	$router->map('GET|POST', '/espace-documentaliste', 'cdi/espace-documentaliste', 'espace-documentaliste');

	$match = $router->match();
	if(is_array($match)){
		if (is_callable($match['target'])){
			call_user_func_array($match['target'], $match['params']);
		} else{
			$params = $match['params'];
			ob_start();
			require "public/{$match['target']}.php";
			$pageContent = ob_get_clean();
		}
		require 'public/header.php';
		require 'public/footer.php';
	}else{
		echo '<h1>404 not found</h1>';
	}
?>