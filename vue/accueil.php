<!-- La page d'accueil sera la première page que les visiteurs verront. -->
<!-- Pour cette page, nous pouvons ajouter une image et un texte, ainsi qu'une liste de 4 produits récemment ajoutés. -->
<?php

// Obtention des 4 derniers produits ajoutés
$select = $bdd->prepare("SELECT * FROM produits ORDER BY date_ajout DESC LIMIT 4");
$select->execute();
$lesProduits = $select->fetchAll(PDO::FETCH_ASSOC);

/* PDO::FETCH_ASSOC : retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats. */

?>

<?= setHeader('Accueil'); ?>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<div class="card bg-primary text-light">
				<div class="card-header">
					<h2 class="text-center">
						Bienvenue sur le site
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid mt-4">
	<div class="row d-flex justify-content-center">
		<?php foreach($lesProduits as $unProduit) { ?>
			<div class="col-md-3">
				<div class="mb-4">
					<div class="card rounded">
						<div class="card-body">
							<div class="d-flex justify-content-center">
								<img src="assets/images/<?= $unProduit['image']; ?>" width="300" class="img-fluid mb-3" alt="Produit">
							</div>
							<h4 class="text-center mb-3">
								<a href="produit?id=<?= $unProduit['id']; ?>">
									<?= $unProduit['nom']; ?>
								</a>
							</h4>
							<p class="text-center text-dark font-weight-bold h4 mb-3">
								<?= $unProduit['prix'] ?> €
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<!-- 
Cela va nous créer un modèle de page d'accueil de base.
Le code ci-dessus va répéter la variable $lesProduits et la remplir en conséquence
Le 'prixc' sera inclus, mais seulement si la valeur est supérieur à 0.
-->

<?= setFooter(); ?>