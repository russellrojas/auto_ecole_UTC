<?php
// Paramètres de connexion
define("DB_HOST", "XXX.X.X.X");
define("DB_USER", "XXXXXX");
define("DB_PASS", "your_user");
define("DB_NAME", "your_date_base");

// Chaîne de connexion PostgreSQL
$connect = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

if (!$connect) {
    die("Erreur de connexion à PostgreSQL : " . pg_last_error());
}

// Optionnel : définir l'encodage en UTF-8
pg_set_client_encoding($connect, "UTF8");
?>
