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