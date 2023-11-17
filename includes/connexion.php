<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dataware";

// Créer la connexion avec le jeu de caractères UTF-8
$db = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$db) {
    die("Échec de la connexion à la base de données: " . mysqli_connect_error());
}

//  UTF-8
mysqli_set_charset($db, "utf8");

