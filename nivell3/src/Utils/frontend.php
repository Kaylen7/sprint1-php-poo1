<?php

function createSelectDropdown(array $llista){
    $htmlStr = "<select id='selectDireccio' name='cercarPelicula'>";

    foreach($llista as $value){
        $htmlStr = $htmlStr . "<option value='$value'>$value</option>";
    }
    $htmlStr = $htmlStr . "</select>";
    return $htmlStr;
}

function getAllDirectors(array $cartelera): array{
    $directors = [];
    foreach($cartelera as $key=>$info){
        $directors[$key] = $info[2];
    }
    return $directors;
}

function getAllTitles(array $cartelera): array{
    $titles = [];
    foreach($cartelera as $key=>$info){
        $titles[$key] = $info[0];
    }
    return $titles;
}

function printMovies(array $llistaCines, bool $showPeliMesLlarga, bool $markDirector){
    foreach($llistaCines as $cinema){
        echo "<div class='cinema'>" . 
         "<header>" . $cinema->frontData('nom') . "</header>" .
         "<p class='poblacio'>" . $cinema->frontData('poblacio') . "</p>" .
         "<div class='movie-container'>";
         foreach($cinema->frontData('pelis') as $peli){
            echo "<p" . ($markDirector && ($peli->frontData('direccio') === $_POST['cercarPelicula']) ? " class='active'" : "") . ">" . $peli->frontData('nom') . "<br/>";
            echo "<span class='off'>" . $peli->frontData('durada') . "</span>";
            echo "<span class='off'>" . $peli->frontData('direccio') . "</span>";
            echo "</p>";
         }
         echo "</div>";
         if ($showPeliMesLlarga){
            $peliMesLlarga = $cinema->getLongestMovie();
         echo "<p>La peli més llarga que oferim és:<br/>" . $peliMesLlarga->frontData('nom') . "<br/>Durada: ". $peliMesLlarga->frontData('durada') . "<br/>Direcció: ".$peliMesLlarga->frontData('direccio') . "</p>";
         }
         echo "</div>";
    }
}