<?php
session_start();
require('./src/Serveis/gestioCinemes.php');
require('./src/Utils/frontend.php');

if(isset($_POST['botoTornar'])){
    unset($_POST['cercarPelicula']);
    unset($_POST['botoTornar']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet" />
    <title>Cinemes</title>
</head>
<body>
    <section class='cinemes'>
    <h1>Cinemes</h1>
    <div class="cinemes-grid">
    <?php
        if((count($_POST) > 0)){
            echo "<div class='search-results'>";
            echo "<h2>Resultat de la cerca</h2>";
            echo "<p>En aquests cines hi ha pelis de " . $_POST['cercarPelicula'] . "</p>";
            $foundMovies = findCinema($cinemesObj, 'direccio', $_POST['cercarPelicula']);
            printMovies($foundMovies, false, true);

            echo "<form method='POST'><button class='button' type='submit' name='botoTornar'>Torna</button></form>";
            echo "</div>";
            
        } else {
            printMovies($cinemesObj, true, false);
        
            echo "<form class='search-form' action='index.php' method='POST'>" .
                "<label for='selectDireccio'>Quins cinemes tenen pelis de...</label>" .
                createSelectDropdown(getAllDirectors($cartelera)) . 
                "<button class='button' type='submit'>Envía</button>" .
                "</form>";
        }  
    ?>
    </div>
    </section>
</body>
</html>