# Gestion d'un panier PHP-MySQL

# Base de données
<pre><code>Drop database if exists gestpanier;
Create database gestpanier;
Use gestpanier;

Drop table if exists produits;
Create table if not exists produits (
	id int(11) not null auto_increment,
	nom varchar(100) not null,
	description longtext,
	prix decimal(7,2) not null,
	prixc decimal(7,2) not null default 0.00,
	quantite int(11) not null,
	image varchar(255),
	date_ajout datetime not null,
	primary key (id)
) ENGINE=InnoDB, CHARSET=utf8;

Insert into produits values
(1, "TOKAI LAR-15B", "Téléphonie mais-libre via Bluetooth", 19.99, 0.00, 22, "TOKAI_LAR-15B.jpg", "2021-09-01 10:00:00"),
(2, "PIONEER MVH-S110UB", "Contrôle de l'autoratio à partir d'un smartphone", 39.99, 0.00, 25, "PIONEER_MVH-S110UB.jpg", "2021-09-01 10:30:00"),
(3, "SONY WX-920BT", "Téléphonie mains-libre via Bluetooth et commande vocal SIRI", 199.99, 0.00, 30, "SONY_WX-920BT.jpg", "2021-09-01 11:00:00"),
(4, "JVC KW-V420BT", "Téléphonie mais-libre via Bluetooth et commande vocal SIRI", 399.00, 0.00, 5, "JVC_KW-V420BT", "2021-09-01 11:30:00");
</code></pre>
