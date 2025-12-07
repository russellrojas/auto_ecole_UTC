<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Consultation éléve</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <div>
        <p class="subtitle" align="center">INFORMATION D'UN ELEVE</p>
    </div>
    <body>
    <?php
        // connexion
        include 'connexion.php';

        // recuperer id eleve
        $ideleve = $_POST['ideleve'];

        //Securite pour eviter l'injection SQL
        $ideleve_ech = pg_escape_string($connect,$ideleve);

        //test si le "required" de html n'a pas abouti
        if (empty($ideleve_ech)) {
          echo "Attenion, il faut remplir tous les champs";
          echo "<br><a href=\"consultation_eleve.php\" >Recommencer en cliquant ici</a>";
          exit();
        }

        //requete
        $query = "SELECT * FROM eleves WHERE eleves.id = $ideleve_ech"; // recuperer les lignes (rows) de l'eleve choisie dans le formulaire
        $result = pg_query($connect, $query);

        if (!$result) {
          echo "La requete $query a échoué : ".pg_last_error($connect);
          echo "<br><a href=\"consultation_eleve.php\">Recommencer en cliquant ici</a>";
          exit();
        }

        while ($row = pg_fetch_array($result))
        {
          $nom = $row['nom'];
          $prenom = $row['prenom'];
          $dateNaiss = $row['datenaiss'];
          $dateInscription = $row['dateinscription'];

        }

        // determiner la date du jour
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        //Deuxieme requete pour recuperer les informations des seances passé où l'eleves été inscrit par ordre croissant
        $query2 = "select inscription.idseance, inscription.ideleve, note, DateSeance, themes.nom, descriptif from inscription inner join seances on inscription.idseance = seances.idseance inner join themes on seances.idtheme = themes.idtheme where inscription.ideleve = $ideleve and seances.DateSeance <'$date' order by DateSeance";
        $result_query2 = pg_query($connect, $query2);
        if (!$result_query2) {
          echo "La requete $query2 a échoué : ".pg_last_error($connect);
          echo "<br><a href=\"consultation_eleve.php\">Recommencer en cliquant ici</a>";
          exit();
        }

        // Consultation des infos
        echo "<table >";
        echo "<tr><td><b>Dossier de $nom $prenom:</b></td></tr>";
        echo "<tr><td>Née le <b>$dateNaiss</b><br></td></tr>";
        echo "<tr><td>Inscrit le <b>$dateInscription</b> <br> <br></td></tr>";

        echo "<tr><td><b>Séances antérieures:</b></td></tr>";
        if (pg_num_rows($result_query2) == 0){ //  si eleve est inscrit à aucune seance
          echo "<tr><td>Pas encore de seances pour cet élève</td></tr>";
        }
        else{
          while ($row2 = pg_fetch_array($result_query2))
          {

            echo "<tr><td>$row2[nom]</td>";
            echo "<td>$row2[DateSeance]</td>";
            echo "<td>$row2[descriptif]</td>";
            if ($row2['note']<0) //  si l'eleve a été noté
              {
                echo "<br><td>Pas encore noté</td></tr>";
              }
            else {
                echo "<td>$row2[note]".'/40'."</td></tr>";
              }
          }
        }
        echo "</table>";
        pg_close($connect);
    ?>
    </body>
</html>