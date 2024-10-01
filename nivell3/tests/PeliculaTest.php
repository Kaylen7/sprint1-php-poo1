<?php declare(strict_types=1);

require_once('./src/Pelicula.php');

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Covers;

#[CoversClass(Pelicula::class)]
final class PeliculaTest extends TestCase{
    private Pelicula $testPeli;

    public function setUp(): void{
        $this->testPeli = new Pelicula("La mesita del comedor", 88, "Caye Casas");
    }

    #[Covers(Pelicula::class . "::.__toString")]
    public function testToString():void{
        $result = $this->testPeli->__toString();
        $expected = "La mesita del comedor\nDurada: 1h28m\nDirecció: Caye Casas";
        $this->assertSame($expected, $result);
    }

    #[Covers(Pelicula::class . "::.getData")]
    public function testGetData(): void{
        $result = $this->testPeli->getData();
        $expected = array(
            "nom" => "La mesita del comedor",
            "durada" => 88,
            "direccio" => "Caye Casas"
        );
        $this->assertSame($expected, $result);
    }

    #[Covers(Pelicula::class . "::.frontData")]
    public function testFrontData(): void{
        $nom = $this->testPeli->frontData('nom');
        $durada = $this->testPeli->frontData('durada');
        $this->assertSame($nom, "La mesita del comedor");
        $this->assertSame($durada, "1h28m");
    }
}