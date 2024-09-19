<?php

define('UTILS_LOCAL','../sprint1-php-basics/utils.php');

if(file_exists(UTILS_LOCAL)){
    include UTILS_LOCAL;
} else {
    echo "<h1>Error 404: Page not found ☕️</h1><p>Comprova que tens l'arxiu <code>utils.php</code> a la ruta corresponent.</p>";
    exit(1);
}

apartat(1);

class Employee{
    public function __construct(
       private string $name,
       private int $sou
    ){}

    public function print(){
        echo "<b>Nom</b>: $this->name <br/>";
        echo "<b>Impostos: </b>" . ($this->sou > 6000 ? "Sí" : "No");
    }
}

$treballadora1 = new Employee("Treballadora X", 6001);
$treballadora1->print();

apartat(2);

abstract class Shape{
    public function __construct(
        protected float|int $ample,
        protected float|int $alt
    ){}

    abstract protected function getArea();
}

class Triangle extends Shape{
    
    public function getArea(){
        echo "<b>Base:</b> $this->ample<br/><b>Altura:</b> $this->alt<br/>";
        echo "<b>Àrea del triangle:</b> " . ($this->alt * $this->ample / 2) . "<br/>";
    }
}

class Rectangle extends Shape{
    public function getArea(){
        echo "<b>Base:</b> $this->ample<br/><b>Altura:</b> $this->alt<br/>";
        echo "<b>Àrea del rectangle:</b> " . ($this->alt * $this->ample) . "<br/>";
    }
}

$triangle = new Triangle(6.5, 82);
$triangle->getArea();
echo "<br/>";
$rectangle = new Rectangle(2, 8.6);
$rectangle->getArea();