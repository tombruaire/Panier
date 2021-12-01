<!-- Le panier est où le client est en mesure de voir une liste de leurs produits ajoutés au panier via le boutton. -->
<!-- Ils peuvent retirer un ou plusieurs produits et mettre à jour leurs quantités. -->
<?= setHeader('Panier'); ?>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<div class="card bg-primary text-light">
				<div class="card-header">
					<h3 class="text-center">Votre panier</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-lg-8 col-md-8 col-sm-12">
			<form method="post" action="panier">
				<table class="table table-dark table-striped text-center mb-4">
					<thead>
						<tr>
							<th scope="col" colspan="2">Produit</th>
							<th scope="col">Prix</th>
							<th scope="col">Quantité</th>
							<th scope="col">Total</th>
							<th scope="col">Opération</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($produits)) { ?>
							<tr>
								<td colspan="6" class="text-center">
									Votre panier est vide.
								</td>
							</tr>
						<?php } else { ?>
							<?php foreach ($produits as $produit) { ?>
								<tr>
									<td>
										<a href="produit?id=<?= $produit['id']; ?>" style="text-decoration: none;">
											<img src="assets/images/<?= $produit['image']; ?>" width="100" height="50" alt="<?= $produit['nom']; ?>">
										</a>
									</td>
									<td>
										<a href="produit?id=<?= $produit['id'] ?>" class="text-light" style="text-decoration: none;">
											<?= $produit['nom']; ?>
										</a>
									</td>
									<td><?= $produit['prix'] ?> €</td>
									<td>
										<input type="number" name="quantite-<?= $produit['id']; ?>" min="1" max="<?= $produit['quantite']; ?>" value="<?= $produitsDansLePanier[$produit['id']]; ?>" required>
									</td>
									<td><?= $produit['prix'] * $produitsDansLePanier[$produit['id']]; ?> €</td>
									<td>
										<a href="panier?delete=<?= $produit['id']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce produit du panier ?')" class="btn btn-danger">
											Supprimer
										</a>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>	
					</tbody>
					<tbody>
						<tr>
							<td colspan="5" class="text-end">
								MONTANT TOTAL
							</td>
							<td class="text-end">
								<b><?= $motantTotal; ?> €</b>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="d-flex justify-content-end mt-2">
					<p></p>
				</div>
				<div class="d-flex justify-content-center mt-4 mb-4">
					<button type="submit" name="Update" class="btn btn-primary me-2">
						Actualiser
					</button>
					<button type="submit" name="Commande" class="btn btn-success">
						Valider la commande
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?= setFooter(); ?>