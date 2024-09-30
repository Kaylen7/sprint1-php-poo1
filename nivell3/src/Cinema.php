<?php
include_once('./src/Pelicula.php');

enum Filtre{
    case titol;
    case autoria;
}

class Cinema {

    public function __construct(
        private string $nom,
        private string $poblacio,
        private array $pelis = [],
    ){}

    private function addMovie(Pelicula $peli): void{
        $this->pelis[count($this->pelis)]= $peli;
    }

    public function addRandomMovies(array $movies, int $numberMovies): void{
        if ($numberMovies > count($movies)){
            echo "ERROR: No hi ha tantes películes a la cartelera!\n\n";
            return;
        }
        for ($i=0; $i<$numberMovies; $i++){
            $index = random_int(0, count($movies) - 1);
            $this->addMovie($movies[$index]);
            unset($movies[$index]);
            $movies = array_values($movies);
        }
    }

    function addMoviesByIdx(array $movies, array $idx): void{
        if(count($idx) > count($movies)){
            echo "ERROR: No hi ha tantes películes a la cartelera!\n\n";
            return;
        }
        foreach($idx as $n){
            $this->addMovie($movies[$n]);
        }
    }

    public function findMovie(string $opcions, string $cerca): bool{
        foreach($this->pelis as $peli){
            if(array_search($cerca, $peli->getData())){
                return true;
            }
        }
        return false;
    }

    public function getLongestMovie(): Pelicula{
        $aux = null;
        foreach($this->pelis as $peli){
            if(!$aux){
                $aux = $peli;
            }
            if($peli->getData()["durada"] > $aux->getData()["durada"]){
                $aux = $peli;
            }
        }
        return $aux;
    }

    public function __toString(): string{
        return "Nom: $this->nom\nPoblació: $this->poblacio\n\n" . ($this->pelis ? implode("\n\n", $this->pelis) : "");
    }

    public function frontData($key): string|array{
        return $this->$key;
    }
}