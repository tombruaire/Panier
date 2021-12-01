<!-- La page des produits est l'endroit où les clients vont parcourir tous les produits. -->
<!-- Nous limitons le nombre de produits à afficher sur chage page et ajoutons une pagination qui permettera aux clients de naviguer entre les pages . -->
<?= setHeader('Produits'); ?>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<div class="card bg-primary text-light">
				<div class="card-header">
					<h2 class="text-center">
						Liste des produits
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid mt-4">
	<div class="row d-flex justify-content-center">
		<?php foreach($produits as $produit) { ?>
			<div class="col-md-3">
				<div class="mb-4">
					<div class="card rounded">
						<div class="card-body">
							<div class="d-flex justify-content-center">
								<img src="assets/images/<?= $produit['image']; ?>" width="300" class="img-fluid mb-3" alt="Produit">
							</div>
							<h4 class="text-center mb-3">
								<a href="produit?id=<?= $produit['id']; ?>">
									<?= $produit['nom']; ?>
								</a>
							</h4>
							<p class="text-center text-dark font-weight-bold h4 mb-3">
								<?= $produit['prix'] ?> €
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="d-flex justify-content-center mt-3">
			<nav>
				<ul class="pagination">

					<!-- Bouton Précédent -->
					<?php if ($pageCourante > 1) { ?>
					<li class="page-item">
						<a class="page-link" href="produits?p=<?= $pageCourante-1; ?>">Précédent</a>
					</li>
					<?php } else { ?>
					<li class="page-item disabled">
						<a class="page-link" href="javascript:void(0)">Précédent</a>
					</li>
					<?php } ?>
					
					<!-- Bouton Suivant -->
					<?php if ($totalProduits > ($pageCourante * $nbProduitsParPage) - $nbProduitsParPage + count($produits)) { ?>
					<li class="page-item">
						<a class="page-link" href="produits?p=<?= $pageCourante+1; ?>">Suivant</a>
					</li>
					<?php } else { ?>
					<li class="page-item disabled">
						<a class="page-link" href="javascript:void(0)">Suivant</a>
					</li>
					<?php } ?>

				</ul>
			</nav>
		</div>
	</div>
</div>

<?= setFooter(); ?>