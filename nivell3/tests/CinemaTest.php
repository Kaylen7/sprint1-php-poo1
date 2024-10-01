<?php declare(strict_types=1);

require_once('./src/Cinema.php');
require_once('./src/Pelicula.php');

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Covers;

#[CoversClass(Cinema::class)]
final class CinemaTest extends TestCase{

    private Cinema $cinema;
    private Cinema $cinemaAmbPeli;
    private Pelicula $mockPeliLlarga;
    private Pelicula $mockPeliCurta;

    protected function setUp(): void{

        $this->mockPeliLlarga = $this->createPeliculaMock('Interstellar', 'Christopher Nolan', 169);
        $this->mockPeliCurta = $this->createPeliculaMock('Test', 'Direccio', 100);


        $this->cinema = new Cinema('Cinema Eixample', 'Barcelona');
        $this->cinemaAmbPeli = new Cinema('Cinema Eixample', 'Tarragona', [$this->mockPeliLlarga, $this->mockPeliCurta]);
    }

    private function createPeliculaMock(string $titol, string $direccio, int $durada): Pelicula{
        $mockMovie = $this->createMock(Pelicula:: class);
        $mockMovie->method('getData')
        ->willReturn([
            'titol' => $titol,
            'direccio' => $direccio,
            'durada' => $durada
        ]);

        return $mockMovie;
    }

    #[Covers(Cinema::class . '::.addRandomMovies')]
    public function testAddRandomMovies(): void {
        $movies = [
            $this->createPeliculaMock("Harry Potter 1", "JK Rowling", 120),
            $this->createPeliculaMock("Harry Potter 2", "JK Rowling 2", 90),
            $this->createPeliculaMock("Harry Potter 3", "JK Rowling 3", 200),
        ];

        $this->cinema->addRandomMovies($movies, 2);
        $result = count($this->cinema->frontData('pelis'));
        $this->assertSame(2, $result);
    }

    #[Covers(Cinema::class . '::.addMoviesByIdx')]
    public function testAddMoviesByIdx(): void {
        $movies = [
            $this->createPeliculaMock("Harry Potter 1", "JK Rowling", 120),
            $this->createPeliculaMock("Harry Potter 2", "JK Rowling 2", 90),
            $this->createPeliculaMock("Harry Potter 3", "JK Rowling 3", 200),
        ];

        $this->cinema->addMoviesByIdx($movies, [0, 1, 2]);
        $result = $this->cinema->frontData('pelis');
        $this->assertTrue($result === $movies);
    }

    #[Covers(Cinema::class . '::.findMovie')]
    public function testFindMovie(): void{
        $this->assertTrue($this->cinemaAmbPeli->findMovie('Interstellar'));
        $this->assertTrue($this->cinemaAmbPeli->findMovie('Christopher Nolan'));
        $this->assertFalse($this->cinemaAmbPeli->findMovie('Hola'));
    }

    #[Covers(Cinema::class . '::.getLongestMovie')]
    public function testGetLongestMovie(): void{
        $this->assertSame($this->mockPeliLlarga, $this->cinemaAmbPeli->getLongestMovie());
    }

    #[Covers(Cinema::class . '::.__toString')]
    public function testToString(): void{
        $nom = $this->cinemaAmbPeli->frontData('nom');
        $poblacio = $this->cinemaAmbPeli->frontData('poblacio');
        $pelis = $this->cinemaAmbPeli->frontData('pelis');
        $expected = "Nom: $nom\nPoblació: $poblacio\n\n" . (implode("\n\n", $pelis));

        $result = $this->cinemaAmbPeli->__toString();
        $this->assertSame($expected, $result);
    }

    #[Covers(Cinema::class . '::.frontData')]
    public function testFrontData(): void{
        $result = $this->cinema->frontData('nom');
        $this->assertSame($result, 'Cinema Eixample');
    }

}
