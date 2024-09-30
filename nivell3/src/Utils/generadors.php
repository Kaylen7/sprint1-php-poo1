<?php

function createMoviesObj(array $movieInfo): array{
    $carteleraObj = [];
    foreach($movieInfo as $key=>$info){
        $carteleraObj[$key] = new Pelicula($info[0], strToMinutes($info[1]), $info[2]);
    }
    return $carteleraObj;
}

function createCinemaObj(array $cinemaInfo): array{
    $cinemaObj = [];
    foreach($cinemaInfo as $info){
        $cinemaObj[$info[0]] = new Cinema($info[1], $info[2]);
    }
    return $cinemaObj;
}