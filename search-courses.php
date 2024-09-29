<?php

require 'vendor/autoload.php';

use MisaelAugusto\SearchCourses\Searcher;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' => 'https://www.alura.com.br']);
$crawler = new Crawler();

$searcher = new Searcher($client, $crawler);

var_dump($searcher->search());

Test::test();
Test2::test();