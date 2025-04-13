<?php

// require __DIR__."/src/functions.php";
// require __DIR__."/src/Model/Rating.php";
// require __DIR__."/src/Model/Category.php";
// require __DIR__."/src/Model/Rateable.php";
// require __DIR__."/src/Model/Title.php";
// require __DIR__."/src/Model/Episode.php";
// require __DIR__."/src/Model/Series.php";
// require __DIR__."/src/Model/Movie.php";

require 'autoload.php';

use ScreenMatch\Model\{
  Movie, Category, Series, Episode
};

echo "Bem-vindo(a) ao ScreenMatch".PHP_EOL;

// $movie = createMovie("Thor - Ragnarok", 2021, 'heores');
$movie = new Movie("Thor - Ragnarok", 2021, Category::Action, 180);

$movie->addStar(1);
$movie->addStar(2);
$movie->addStar(3);

var_dump($movie->getStarsRating(), $movie->isGood()).PHP_EOL;

$series = new Series("Lost", 2007, Category::Drama, 10, 20, 35);

$series->addStar(5);
$series->addStar(4);
$series->addStar(4);

var_dump($series->getStarsRating(), $series->isGood()).PHP_EOL;

$marathonDuration = $series->getDurationInMinutes() + $movie->getDurationInMinutes();

echo "Tempo total da maratona é: $marathonDuration minutos".PHP_EOL;

$episode = new Episode($series, "Pilot",1);

$episode->addStar(0);
$episode->addStar(1);
$episode->addStar(1);

var_dump($episode->getStarsRating()).PHP_EOL;