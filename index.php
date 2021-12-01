<?php

// Démarrage de la session
session_start();

// Appel des fonction et connexion à la base de données en utilisant PDO et MySQL
require_once("src/functions.php");
$bdd = connectBDD();

// La page est définie sur 'home.php' par défaut
if (isset($_GET['page'])) {
	if (file_exists("controleur/".$_GET['page']."Controleur.php"))
		$page = $_GET['page'];
	else
		$page = "404";
} else {
	$page = "accueil";
}

// Appel et affichage de la page demandée
require "controleur/".$page."Controleur.php";

?>