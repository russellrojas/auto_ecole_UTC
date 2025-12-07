<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF8">    
        <link rel="stylesheet" href="../css/styles.css">
    </head>
   
    <body>
    <?php
    if (!empty($_POST["menuChoixTheme"]) && !empty($_POST["dateSeance"]) && !empty($_POST["effmax"])) {
       
        include 'connexion.php';

        $idtheme = $_POST["menuChoixTheme"];
        $dateSeance = $_POST["dateSeance"];
        $effmax = $_POST["effmax"];

        //verification d'une seance avec le theme la meme date
        $checkQuery = "SELECT * FROM seances WHERE DateSeance = '$dateSeance' AND idtheme = '$idtheme'";
        $checkResult = pg_query($connect, $checkQuery);

        if (pg_num_rows($checkResult) > 0) {
            
            echo "Erreur : Il existe déjà une séance avec le même thème à la même date.";
        } else {
         
            $insertQuery = "INSERT INTO seances (idtheme, DateSeance, effmax) VALUES ('$idtheme', '$dateSeance', '$effmax')";
            
            echo "<br>$insertQuery<br>"; // Importante echo para debugging

            $insertResult = pg_query($connect, $insertQuery);
            if (!$insertResult) {
                echo "<br>Erreur d'insertion : " . pg_last_error($connect);
            } else {
                echo "Séance ajoutée avec succès!";
            }
        }

        pg_close($connect);
    } else {
        echo "Erreur de saisie!!<br>";
    }
    ?>
    </body>
</html>