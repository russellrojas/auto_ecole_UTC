<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calendrier éléve</title>
    <link rel="stylesheet" href="../css/styles.css">
  </head>

  <div>
    <p class="subtitle" align="center">CALENDRIER D'UN ELEVE</p>
  </div>

  <body>
  <?php
    include 'connexion.php';

    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    // Récupération id élève
    $ideleve = $_POST['ideleve'];

    // Sécurité
    $ideleve_ech = pg_escape_string($connect, $ideleve);

    if (empty($ideleve_ech)) {
      echo "Attention, il faut remplir tous les champs";
      echo "<br><a href=\"visualisation_calendrier_eleve.php\">Recommencer en cliquant ici</a>";
      exit();
    }

    // Récupérer nom & prénom
    $query_nom = "SELECT * FROM eleves WHERE eleves.id = $ideleve_ech";
    $result_nom = pg_query($connect, $query_nom);

    if (!$result_nom) {
      echo "La requete $query_nom a échoué : " . pg_last_error($connect);
      echo "<br><a href=\"visualisation_calendrier_eleve.php\">Recommencer en cliquant ici</a>";
      exit();
    }

    while ($row_nom = pg_fetch_assoc($result_nom)) {
      $nom = $row_nom['nom'];
      $prenom = $row_nom['prenom'];
    }

    // Récupérer les séances futures
    $query = "
      SELECT inscription.idseance, inscription.id, note, dateseance, themes.nom, descriptif
      FROM inscription
      INNER JOIN seances ON inscription.idseance = seances.idseance
      INNER JOIN themes ON seances.idtheme = themes.idtheme
      WHERE inscription.id = $ideleve_ech AND seances.dateseance >= '$date'
      ORDER BY dateseance
    ";

    $result = pg_query($connect, $query);

    if (!$result) {
      echo "La requete $query a échoué : " . pg_last_error($connect);
      echo "<br><a href=\"visualisation_calendrier_eleve.php\">Recommencer en cliquant ici</a>";
      exit();
    }

    echo "<table>";

    if (pg_num_rows($result) == 0) {
      echo "<tr><td>Pas encore inscrit dans des séances</td></tr>";
    }
    else {
      echo "<tr><td><b>Calendrier de $nom $prenom:</b></td></tr>";
      echo "<tr><td><b>Séances à venir :</b></td></tr>";

      while ($row = pg_fetch_assoc($result)) {
        echo "<tr><td>Nom :</td><td>" . $row['nom'] . "</td></tr>";
        echo "<tr><td>Date :</td><td>" . $row['dateseance'] . "</td></tr>";
        echo "<tr><td>Description :</td><td>" . $row['descriptif'] . "</td></tr>";
      }
    }

    echo "</table>";

    pg_close($connect);
  ?>
  </body>
</html>
