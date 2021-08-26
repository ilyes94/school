<?php
    if (!isset($_SESSION)) { session_start(); }

    $_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/School";

    var_dump($_SESSION);
    

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- fav icon-->
    <link rel="shortcut icon" href="<?=$_SESSION['root']?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?=$_SESSION['root']?>/css/style.css">
    <title><?= $titlePage ?? 'School' ?></title>

</head>

<body class="bg-color-gla">
    <div class="container bg-color-pla">
        <div id="header">
        <?php
            if(isset($_SESSION['userType'])){
                require 'public/menu.php';
            }
              ?>
        </div>
            <?= $pageContent ?>
