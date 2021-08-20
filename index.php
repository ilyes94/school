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

	$router = new AltoRouter();

	$router->setBasePath($_SERVER['BASE_URI']);

	$router->map('GET', '/' , 'home', 'home');
	//Utilisateur
	$router->map('GET|POST', '/dashboard', 'dashboard', 'dashboard');
	$router->map('GET|POST', '/modif-user/[i:id]', 'modif-user', 'modif-user');
	$router->map('GET|POST', '/ajout-utilisateur', 'ajout-utilisateur', 'ajout-utilisateur');
	//Compte
	$router->map('GET|POST', '/mon-compte/[i:id]', 'mon-compte', 'mon-compte');
	$router->map('GET|POST', '/modif-mot-de-passe/[i:id]', 'modif-pass', 'modif-pass');

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
		echo '404 not found';
	}
?>