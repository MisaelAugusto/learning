<?php

namespace MisaelAugusto\SearchCourses\__tests__;

use GuzzleHttp\Client;
use MisaelAugusto\SearchCourses\Searcher;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

class SearcherTest extends TestCase
{
    private $httpClientMock;
    private $url = '/cursos-online-programacao/php';

    protected function setUp(): void
    {
        $html = <<<FIM
        <html>
            <body>
                <span class="card-curso__nome">Curso Teste 1</span>
                <span class="card-curso__nome">Curso Teste 2</span>
                <span class="card-curso__nome">Curso Teste 3</span>
            </body>
        </html>
        FIM;


        $stream = $this->createMock(StreamInterface::class);
        $stream
            ->expects($this->once())
            ->method('__toString')
            ->willReturn($html);

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $httpClient = $this
            ->createMock(Client::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', $this->url)
            ->willReturn($response);

        $this->httpClientMock = $httpClient;
    }

    public function testSearchCourses()
    {
        $crawler = new Crawler();
        $searcher = new Searcher($this->httpClientMock, $crawler);
        $courses = mb_split(PHP_EOL, $searcher->search());

        $this->assertCount(3, $courses);
        $this->assertEquals('Curso Teste 1', $courses[0]);
        $this->assertEquals('Curso Teste 2', $courses[1]);
        $this->assertEquals('Curso Teste 3', $courses[2]);
    }
}
