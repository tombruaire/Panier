<?php /* [SUBLIME TEXT : View -> Word Wrap] */

/*** [AJOUTER UN PRODUIT AU PANIER] ***/
// Si l'utilisateur a cliqué sur le bouton 'Ajouter au panier' sur la page produit,
// on vérifie les données du formulaire
if (isset($_POST['produit_id'], $_POST['quantite']) && is_numeric($_POST['produit_id']) && is_numeric($_POST['quantite'])) {
	
	// Création de variables POST pour identifier facilement l'id du produit et la quantité.
	// Utilisation de la fonction '(int)' pour s'assurer que ce soit des entier
	$produit_id = (int)$_POST['produit_id'];
	$quantite = (int)$_POST['quantite'];

	// Préparation de l'instruction SQL
	// Nous vérifions essentiellement si le produit existe dans la base de données
	$select = $bdd->prepare("SELECT * FROM produits WHERE id = :id");
	$select->bindValue(':id', $_POST['produit_id'], PDO::PARAM_INT);
	$select->execute();

	// Récupération du produit dans la base de données et retournement du résultat sous forme de tableau
	$produit = $select->fetch(PDO::FETCH_ASSOC);

	// Vérification du produit s'il existe (le tableau n'est pas vide)
	if ($produit && $quantite > 0) {
		
		// Le produit existe dans la base de données
		// Maintenant nous pouvons créer / mettre à jour la variable de session pour le panier
		if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {

			// Si le produit est dans le panier
		 	if (array_key_exists($produit_id, $_SESSION['panier'])) {

		 		// Le produit est dans le panier.
		 		// Il suffit de mettre à jour la quantité
		 		$_SESSION['panier'][$produit_id] += $quantite;
		 		/* $_SESSION['panier'][$produit_id] = $_SESSION['panier'][$produit_id] + $quantite; */

		 	} else { // Sinon
		 		
		 		// Le produit n'est pas dans le panier.
		 		// Il suffit de l'ajouter.
		 		$_SESSION['panier'][$produit_id] = $quantite;

		 	}

		 } else {

		 	// Il n'y a pas de produits dans le panier.
		 	// Cela ajoutera le premier produit au panier.
		 	$_SESSION['panier'] = array($produit_id => $quantite);

		 }
	}

	// Empêcher la nouvelle soumission du formulaire
	header('Location: panier');
	exit();

}

/* Dans le code ci-dessus, nous utilisons les variables de session PHP.
Nous pouvons utiliser des sessions PHP pour mémoriser les produits du panier.
Par exemple : lorsqu'un client navigue vers une autre page, le panier contiendera toujours les produits précédemment ajoutés jusqu'à l'expiration de la session. */

/* Le code ci-dessus vérifiera si un produit a été ajouté au panier.
Si vous retournez au fichier 'produit.php', vous pouvez voir que nous avons créer un formulaire HTML.
Nous vérifions ces valeurs de formulaire, si le produit existe, nous procédons à la vérification du produit en le sélectionnant dans notre tableau de produits dans notre base de données.
Nous ne voudrions pas que les clients manipulent le système et ajoutent des produits inexistants. */

/* La variable de session panier $_SESSION['panier'] est un tableau associé de produits, et avec ce tableau, nous pouvons ajouter plusieurs produits au panier d'achat.
La clé du tableau sera l'id du produit et la valeur sera la quantité.
Si un produit existe déjà dans le panier, tout ce que nous avons à faire est de mettre à jour la quantité. */

/*** [SUPPRIMER UN PRODUIT DU PANIER] ***/
// Pour supprimer un produit du panier, il faut vérifier le paramètre l'url.
// 'delete', c'est l'identifiant du produit.
// Il faut s'assurer que c'est un numéro et vérifier si c'est dans le panier
if (isset($_GET['delete']) && is_numeric($_GET['delete']) && isset($_SESSION['panier']) && isset($_SESSION['panier'][$_GET['delete']])) {
	
	// Suppression du produit du panier
	unset($_SESSION['panier'][$_GET['delete']]);

	/* unset() permet de détruire la session. */

	header('Location: panier');
	exit();

}

/* Sur la page du panier, le client aura la possibilité de retirer un produit du panier.
Lorsque le bouton est cliqué, nous pouvons utiliser une demande GET pour déterminer quel produit sera à supprimer.
Par exemple : si nous avons un produit avec l'id 1, l'url suivante va le supprimer du panier : 
http://localhost/Panier/panier?delete=1 */

/*** [MISE A JOUR DES QUANTITES DE PRODUITS] ***/
// Mise à jour des quantité de produits dans le panier si l'utilisateur clique sur le bouton 'Mettre à jour' sur la page du panier.
if (isset($_POST['Update']) && isset($_SESSION['panier'])) {
	
	// Passage en boucle des données du POST afin que nous puissions mettre à jour les quantités pour chaque produit dans le panier.
	foreach ($_POST as $key => $value) {
		if (strpos($key, 'quantite') !== false && is_numeric($value)) {
			/* strpos() cherche la position de la première occurence dans la chaîne. */

			$id = str_replace('quantite-', '', $key);
			/* str_replace() remplace toutes occurences dans une chaîne. */

			$quantite = (int)$value;

			// Toujours effectuer des vérifications et des validations
			if (is_numeric($id) && isset($_SESSION['panier'][$id]) && $quantite > 0) {
				
				// Mise à jour de la nouvelle quantité
				$_SESSION['panier'][$id] = $quantite;

			}

		}
	} 

	// Empêcher la nouvelle soumission du formulaire
	header('Location: panier');
	exit();

}

/* Le code ci-dessus va répéter les produits dans le panier et mettre à jour leurs quantités.
Le client aura la possibilité de modifier les quantités sur la page du panier.
Le bouton 'Mettre à jour' a un nom de mise à jour, car c'est ainsi que le code saura quand mettre à jour les quantités à l'aide d'une demande POST. */

/*** [GESTION DE LA COMMANDE LOCALE] ***/
// Envoyer l'utilisateur à la page de commande s'il clique sur le bouton de commande.
// Le panier ne doit pas être vide.
if (isset($_POST['Commande']) && isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
	header('Location: commandes');
	exit();
}

/* Cela redirigera l'utilisateur vers la page des Commandes s'il clique sur le bouton 'Valider la commande' */

/*** Obtenir des produits dans le panier et sélectionner à partir de la base de données. ***/

// Vérifications de la variable session pour les produis dans le panier
$produitsDansLePanier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();
$produits = array();
$motantTotal = 0.00;

// S'il y a des produits dans le panier
if ($produitsDansLePanier) {
	
	// Comme il y a des produits dans le panier, nous devons les sélectionner dans la base de données.
	// Les produits sont dans le tableau panier à la chaîne de points d'interrogation.
	// Nous avons besoin de l'instruction SQL pour inclure IN (?, ?, ?,...etc)
	$arrayVersPointsInterrogation = implode(', ', array_fill(0, count($produitsDansLePanier), '?'));

	$select = $bdd->prepare("SELECT * FROM produits WHERE id IN (".$arrayVersPointsInterrogation.") ");

	// Nous n'avons pas besoin des clés de tableau, pas de valeurs.
	// Les clés sont les id des produits
	$select->execute(array_keys($produitsDansLePanier));

	// Récupération des produits dans la base de données et retournement du résultat en tableau
	$produits = $select->fetchAll(PDO::FETCH_ASSOC);

	// Calcul du montant total
	foreach ($produits as $produit) {
		$motantTotal += (float)$produit['prix'] * (int)$produitsDansLePanier[$produit['id']];
	}

}

/* S'il y a des produits dans le panier, récupéaration de ces produits dans notre tableau des produits, ainsi que le nom de la colonne suivante : nom du produit, description, prix et image, comme avant nous n'avons pas stocké ces informations dans notre variable de session. */

/* Nous calculons également le montant total en répérant les produit et en multipliant le prix du produit par sa quantité. */

require_once("vue/panier.php");

?>