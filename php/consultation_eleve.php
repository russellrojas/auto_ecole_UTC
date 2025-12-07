<html>
    <head>
    <meta charset="utf-8">
   
    <link rel="stylesheet" href="../css/styles.css">
    </head>
    <div>
        <p class="subtitle" align="center">INFORMATION D'UN ELEVE</p>
    </div>
    <body >
    <form action="consulter_eleve.php" method="POST">
        <p>Choisir un éléve:</p> </td>
        <?php
            // connexion
            include 'connexion.php';

            //requete
            $query = "SELECT * FROM eleves"; // recuperer la liste des eleves
            $result = pg_query($connect, $query);

            if (!$result) {
              echo "La requete $query a échoué : ".pg_last_error($connect);
              echo "<br><a href=\"consultation_eleve.php\" >Recommencer en cliquant ici</a>";
              exit();
            }

            echo "<select size='4' name='ideleve' required >";

            while ($row = pg_fetch_array($result)) {
              echo "<option value= $row[0]> $row[1] $row[2] </option>";
            }

            echo "</select>";

            pg_close($connect);
        ?>
        <br>
        <input type="submit" value="Consulter">
        <input type="reset" value="Reset">
    </form>
  
  </body>
</html>