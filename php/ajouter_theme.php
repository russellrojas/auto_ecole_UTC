<html>
    <head>
        <meta charset="UTF8">
    </head>
    <body>
        <?php
        if(!empty($_POST["nom"]) ){
            
            //connexion a la base de donnees,
            include 'connexion.php';

            $nom=$_POST["nom"];
            $descriptif=$_POST["descriptif"]; 
            
            // on verifie si le theme existe deja
            $check_query = "SELECT * FROM themes WHERE nom = '$nom' AND supprime = true";
            $check_result = pg_query($connect, $check_query);

            if (pg_num_rows($check_result) > 0) {
                // El tema ya existe y está marcado como eliminado, reactivarlo
                $reactivation_query = "UPDATE themes SET supprime = false, descriptif = '$descriptif' WHERE nom = '$nom'";
                $reactivation_result = pg_query($connect, $reactivation_query);

                if ($reactivation_result) {
                    echo "Theme reactive avec succes!";
                } else {
                    echo "Erreur d'activation" . pg_last_error($connect);
                }
               
             
            }else {
                $query = "INSERT INTO themes (nom, supprime, descriptif) VALUES ('$nom', false, '$descriptif')";
                echo "<br>$query<br>"; // important echo a faire systematiquement, c'est impose !
        
                $result = pg_query($connect, $query); 
                if (!$result){
                    echo "<br>Erreur de Connexion".pg_last_error($connect);
                }
               
            }
            pg_close($connect); 
        
        }else{
            echo"Erreur de saisie!!<br>";
            }

        ?>
    </body>
</html>