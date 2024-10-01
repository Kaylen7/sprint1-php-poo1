<?php

include_once('./src/Pelicula.php');
include_once('./src/Cinema.php');
include_once('./src/Utils/generadors.php');

$cartelera = [
    ['Los renglones torcidos de Dios', '2h34m', 'Oriol Paulo'],
    ['Call Me By Your Name', '2h12m', 'Luca Gaudagnino'],
    ['5 Lobitos', '1h44m', 'Alauda Ruíz de Azúa'],
    ['Ammonite', '2h00m', 'Francis Lee'],
    ['Maixabel', '1h55m', 'Icíar Bollaín'],
    ['Darkest Hour', '2h05m', 'Joe Wright']
];

$infoCinemes = [
    ['yelmoCines', 'Yelmo Cines Sant Cugat', 'Sant Cugat'],
    ['auditori', 'Auditori Castellbisbal', 'Castellbisbal'],
    ['renoir', 'Renoir Floridablanca', 'Barcelona'],
    ['verdi', 'Verdi', 'Barcelona']
];

$movies = createMoviesObj($cartelera);
$cinemesObj = createCinemaObj($infoCinemes);

$cinemesObj['yelmoCines']->addMoviesByIdx($movies, [0, 1, 2]);
$cinemesObj['renoir']->addMoviesByIdx($movies, [3, 4, 5]);
$cinemesObj['verdi']->addRandomMovies($movies, 3);
$cinemesObj['auditori']->addRandomMovies($movies, 1);

function findCinema(array $cinemesObj, string $opcio, string $cerca): array{
    $foundCinemas = []; 
    foreach($cinemesObj as $cine){
        if ($cine->findMovie($cerca)){
            $foundCinemas[count($foundCinemas)] = $cine;
        }
    }
    return $foundCinemas;
}