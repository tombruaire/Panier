<?php

// Vérification que l'id du produit est passé en paramètre dans l'url
if (isset($_GET['id'])) {
	
	// Prépararation et exection de l'instruction
	/* Préparer et executer une instruction empêche les injections SQL */
	$select = $bdd->prepare("SELECT * FROM produits WHERE id = :id");
	$select->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
	$select->execute();

	// Récupération du produit de la base de données et retournement du résultat sous forme de tableau
	$produit = $select->fetch(PDO::FETCH_ASSOC);

	// Vérification du produit s'il existe (le tableau n'est pas vide)
	if (!$produit) {
	  	// Si l'id du produit n'existe pas (tableau vide), on affiche un message d'erreur
	  	exit("Le produit n'existe pas !");
	  }  
} else {
	// Si l'id du produit n'est pas spécifier, on affiche un message d'erreur
	exit("Le produit n'existe pas !");
}

/* Le code ci-dessus permet de vérifier si la variable 'id' demandée (GET) existe.
Si l'id est spécifié, le code procédera à la récupération du produit à partir de la table des produits dans la base de données. */

/* Si le produit n'existe pas dans la base de données, le code affichera un message d'erreur.
La fonction 'exit()' empêchera l'exécution du code et affichera l'erreur. */

require_once("vue/produit.php");

?>