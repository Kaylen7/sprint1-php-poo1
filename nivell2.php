<?php

define('UTILS_LOCAL','../sprint1-php-basics/utils.php');

if(file_exists(UTILS_LOCAL)){
    include UTILS_LOCAL;
} else {
    echo "<h1>Error 404: Page not found ☕️</h1><p>Comprova que tens l'arxiu <code>utils.php</code> a la ruta corresponent.</p>";
    exit(1);
}

apartat(1);

class PokerDice{
    private array $faces = ["As", "K", "Q", "J", "7", "8"];
    private static string $total = "";
    private string $result = "";

    public function throw(){
        $index = random_int(0, 5);
        $this->result = $this->faces[$index];
    }

    public function shapeName(): string{
        return $this->result;
    }

    public function setTotal(){
        self::$total = self::$total . $this->result . " ";
    }

    public function getTotalThrows(): string{
        return self::$total;
    }
}

$coleccio_daus = array();

for ($i=0; $i<5; $i++){
    $coleccio_daus[] = new PokerDice();
}

function tirar5Daus(array $dausObj): void{
    foreach($dausObj as $idx=>$dau){
        $dau->throw();
        echo "<b>🎲 $idx:</b> " . $dau->shapeName() . "<br/>";
        $dau->setTotal();
    }
    echo "<br/>La tirada completa és: <br/>" . $dausObj[0]->getTotalThrows() . "<br/>";
}

tirar5Daus($coleccio_daus);
echo "<br/>Més de 3 repetits dona bona sort! 😉";