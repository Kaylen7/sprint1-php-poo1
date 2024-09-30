<?php
include_once('./src/Utils/helpers.php');

class Pelicula{
    public function __construct(
        private string|null $nom,
        private int|null $durada,
        private string|null $direccio
    ){}

    public function __toString(){
        return "$this->nom\nDurada: " . (minutesToStr($this->durada)) . "\nDirecció: $this->direccio";
    }

    public function getData(){
        return array(
            "nom" => $this->nom,
            "durada" => $this->durada,
            "direccio" => $this->direccio
        );
    }
    public function frontData($key){
        if($key === 'durada'){
            return minutesToStr($this->durada);
        }
        return $this->$key;
    }
}