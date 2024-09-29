<?php

namespace MisaelAugusto\SearchCourses;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Searcher
{
    public function __construct(
        public readonly Client $httpClient,
        public readonly Crawler $crawler
    ) {
    }

    public function search()
    {
        $response = $this->httpClient->request(
            'GET',
            '/cursos-online-programacao/php'
        );

        $html = $response->getBody();



        $this->crawler->addHtmlContent($html);

        $coursesElements = $this->crawler->filter(
            'span.card-curso__nome'
        )->getIterator();

        $courses = array_map(
            function ($item) {
                return $item->textContent;
            },
            $coursesElements->getArrayCopy()
        );

        return join(PHP_EOL, $courses);
    }
}
