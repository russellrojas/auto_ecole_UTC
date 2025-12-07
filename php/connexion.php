<?php
// Paramètres de connexion
define("DB_HOST", "127.0.0.1");
define("DB_USER", "postgres");
define("DB_PASS", "russell96");
define("DB_NAME", "db_autoecole");

// Chaîne de connexion PostgreSQL
$connect = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

if (!$connect) {
    die("Erreur de connexion à PostgreSQL : " . pg_last_error());
}

// Optionnel : définir l'encodage en UTF-8
pg_set_client_encoding($connect, "UTF8");
?>
