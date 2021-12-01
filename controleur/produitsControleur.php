<?php

// Le nombre de produits à afficher sur chaque page
$nbProduitsParPage = 4;

// La page courante
// Dans l'url, cela apparaîtera comme : produits?p=1, produits?p=2, etc...
$pageCourante = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

// Sélection des produits commandés par date d'ajout
$select = $bdd->prepare("SELECT * FROM produits ORDER BY date_ajout DESC LIMIT ?,?");

// Utilisation du 'bindValue'
// Le bindValue permettera d'utiliser 'integer' dans la requête SQL
// Nous avons besoin de l'utiliser pour 'LIMIT'
$select->bindValue(1, ($pageCourante - 1) * $nbProduitsParPage, PDO::PARAM_INT);
$select->bindValue(2, $nbProduitsParPage, PDO::PARAM_INT);
$select->execute();

// Récupération des produits de la base de données et retourne le résulat sous forme de tableau
$produits = $select->fetchAll(PDO::FETCH_ASSOC);

/* La mise jour de la variable $nbProduitsParPage limitera le nombre de produits à afficher sur chaque page. */

/* Pour définir sur quelle page se trouve le client, nous pouvons utiliser une requête GET.
Cela apparaîtera sous produits?p=1 etc..
Et dans notre code PHP, nous pouvons récupérer le paramètre 'p' avec la variable $_GET['p'].
En supposant que la requête est valide, le code exécutera une requête qui récupérera les produits limités de la base de données. */

/* Note
Nous excécutons des requêtes en utilisant des instructions préparées.
Les instructions préparées empêcheront complètement les injections SQL.
Il est de bonne pratique de préparer des déclarations avec les demandes GET et POST.
*/

// Obtenir le nombre total de produits
$totalProduits = $bdd->query("SELECT * FROM produits")->rowCount();

require_once("vue/produits.php");

?>