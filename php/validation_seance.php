<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/styles.css">

    </head>
    <div>
        <p class="subtitle" align="center">VALIDATION D'UNE SEANCE</p>
    </div>
    <body>
    <form action="valider_seance.php" method="POST" >
    <p>Veuillez choisir la séance que vous souahitez valider:</p>
     
        <select name="idseance" size="4">
         <?php
          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");
          include 'connexion.php';
          $query = "SELECT * FROM seances INNER JOIN themes ON themes.idtheme = seances.idtheme WHERE seances.DateSeance < '$date'";
          $result_seances = pg_query($connect, $query);
          //verif
          if (!$result_seances) {
            echo "La requete $query a échoué :" .pg_last_error($connect);
            echo "<br><a href=\"validation_seance.php\" >Recommencer en cliquant ici</a>";
            exit();
          }

          while ($seance = pg_fetch_row($result_seances)) {
            echo "<option value = \"$seance[0]\"> $seance[1] $seance[5]</option>";
          }

          pg_close($connect);
          ?>
       </select><br>
  
       <input type="submit" value="Valider">
       <input type="reset" value="Reset">
 
  </body>
</html>