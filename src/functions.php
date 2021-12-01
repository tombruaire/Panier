<?php

function connectBDD() {

	$hostname = "localhost";
	$database = "gestpanier";
	$username = "root";
	$password = "";

	try {
		return new PDO("mysql:host=".$hostname.";dbname=".$database.";charset=utf8", $username, $password);
	} catch (PDOException $exp) {
		die("Erreur de connexion à la base de données : " . $exp->getMessage());
	}

}

// En-tête de la page index.php
function setHeader($title) {

	// Obtenir le nombre d'articles dans le panier
	$nbArticles = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;

	echo <<<EOT
	<!DOCTYPE html>
	<html>
		<head>
			<title>$title</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
			<link ref="stylesheet" type="text/css" href="assets/css/style.css">
		</head>
		<body>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container-fluid">
					<a class="navbar-brand" href="/Panier/">Site</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="/Panier/">Accueil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="produits">Produits</a>
							</li>
						</ul>
						<div class="d-flex">
							<a href="panier" style="text-decoration: none;">
								<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart text-light" viewBox="0 0 16 16">
		  							<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</svg>
								<span class="postion-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
									$nbArticles
								</span>
							</a>
						</div>
					</div>
				</div>
			</nav>
	EOT;

}

// Footer de la page
function setFooter() {

	$annee = date("Y");

	echo <<<EOT
			<div class="card text-center">
				<div class="card-header">
					Tom BRUAIRE
				</div>
				<div class="card-body">
					<h5 class="card-title">Gestion d'un panier</h5>
				</div>
				<div class="card-footer">
					&copy; $annee - Tom BRUAIRE - Tout droits réservés.
				</div>
			</div>
		</body>
	</html>
	EOT;

}

?>