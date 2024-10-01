<?php declare(strict_types=1);

require_once('./src/Serveis/gestioCinemes.php');

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class gestioCinemesTest extends TestCase{
    private Cinema $testCinema;
    private Pelicula $testPelicula;

    public function setUp(): void{
        $this->testCinema = new Cinema('Yelmo Cines', 'Barcelona');
        $this->testPelicula = new Pelicula('Las buenas compañías', 91, 'Sílvia Munt');

        $this->testCinema->addMoviesByIdx([$this->testPelicula], [0]);
    }

    public function testFindCinema(): void{
        $foundCinema = findCinema([$this->testCinema], 'titol', 'Las buenas compañías');
        $none = findCinema([$this->testCinema], 'titol', 'Hola');
        $this->assertTrue($foundCinema === [$this->testCinema]);
        $this->assertTrue($none === []);
    }
}