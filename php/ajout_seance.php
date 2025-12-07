<!DOCTYPE html>
<html>
    <head>
 
        <meta charset="UTF8"> 
        <link rel="stylesheet" href="../css/styles.css">

    </head>
    <div>
        <p class="subtitle" align="center">AJOUT D'UNE SEANCE</p>
    </div>
    <body>
    <?php
        date_default_timezone_set('Europe/Paris');
        //connexion a la BDD
    
        include 'connexion.php';
   
        $date = date("Y-m-d"); //date d'aujourd'hui

        $query="SELECT * FROM themes WHERE supprime=false";  //MODIFICAR CON WHERE PARA RECUPERAR SOLO TEMAS ACTIFS 0
        $result = pg_query($connect,$query);
        echo"<p>";
        echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' >";
        echo" <p>Liste des thèmes: <br>";
        echo '<select name="menuChoixTheme" size="5" ">';
        while ($row = pg_fetch_row($result)){
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        
        }
        echo "</select><br>";
        echo "<br>Date du theme:<br>";

        echo "<INPUT class='special' type='date' name='dateSeance' min='{$date}' ><br>";

        echo "<br>Effectif maximun<br>";
        echo'<input type="number"  name="effmax" min="0" max="20"><br>';
        echo "<br><INPUT class='special' type='submit' value='Enregistrer séance'>";
        echo "</FORM>";
        echo"</p>";
        pg_close($connect);
    ?>
    </body>
</html>