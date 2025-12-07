<html>
    <head>
        <meta charset="utf-8">
        <title>Suppression d'un thème</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <div>
        <p class="subtitle" align="center">SUPPRESSION D'UN THEME</p>
    </div>
    <body >
    <form action="supprimer_theme.php" method="POST" >
      <p>Choisir le thème à supprimer:</p>
      <?php
      // connexion
        include 'connexion.php';

      //requete pour recuperer les themes
      $query = "SELECT * FROM themes WHERE supprime = false"; // recuperer la liste des themes non supprimés
      $result = pg_query($connect, $query);

      if (!$result) {
        echo "La requete $query a échoué : ".pg_last_error($connect);
        echo "<br><a href=\"suppression_theme.php\" >Recommencer en cliquant ici</a>";
        exit();
      }


      echo "<select size='4' name='idtheme' required>";
      while ($row = pg_fetch_array($result)){
        echo "<option value= $row[0]>$row[1]</option>";
      }

      echo "</select>";
      pg_close($connect);
      ?>
      <br>  
      <input type="submit" value="Supprimer"> </td>   
      <input type="reset" value="Reset">
      </form>
    </body>
</html>