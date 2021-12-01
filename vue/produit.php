<!-- Cette page affiche tous les détails d'un produit spécifique, déterminés par la variable GET en fonction de l'id du produit. -->
<!-- Les clients peuvent voir l'image, le nom, le prix et la description. -->
<!-- Le client est en mesure de modifier la quantité et d'ajouter au panier avec un clic sur un bouton. -->
<?= setHeader("Produit"); ?>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-lg-5 col-md-5 col-sm-12">
			<div class="mb-4">
				<div class="card rounded">
					<div class="card-body">
						<div class="d-flex justify-content-center mb-3">
							<img src="assets/images/<?= $produit['image']; ?>" width="300" class="img-fluid" alt="<?= $produit['nom']; ?>">
						</div>
						<h4 class="text-center mb-3">
							<?= $produit['nom']; ?>
						</h4>
						<p class="text-center text-dark font-weight-bold h4 mb-3">
							<?= $produit['prix']; ?>
							<?php if ($produit['prixc'] > 0) { ?>
								<span><?= $produit['prixc']; ?></span>
							<?php } ?>
						</p>
						<div class="row d-flex justify-content-center">
							<div class="col-auto">
								<form method="post" action="panier" class="mb-3">
									<div class="mb-3">
										<label for="qte" class="form-label">Quantité</label>
										<input type="number" name="quantite" id="qte" value="1" min="1" max="<?= $produit['quantite']; ?>" class="form-control" required>
									</div>
									<div class="mb-3">
										<input type="hidden" name="produit_id" value="<?= $produit['id']; ?>">
									</div>
									<div class="d-flex justify-content-center">
										<button type="submit" class="btn btn-primary">
											Ajouter au panier
										</button>
									</div>
								</form>
							</div>
						</div>
						<figcaption class="blockquote-footer mt-4">
							<?= $produit['description']; ?>
						</figcaption>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="produit content-wrapper">
	
</div>

<?= setFooter(); ?>