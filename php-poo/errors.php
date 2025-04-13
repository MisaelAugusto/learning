<?php

use ScreenMatch\Exception\InvalidEpisodeStarNumberException;
use ScreenMatch\Model\{
  Series, Category, Episode
};

require 'autoload.php';

$series = new Series("Lost", 2007, Category::Drama, 10, 20, 35);

$episode = new Episode($series, "Pilot", 1);

echo $episode->getStarsRating().PHP_EOL;

try {
  $episode->addStar(-1);
} catch (Throwable $e) {
  echo $e->getMessage().PHP_EOL;
}

try {
  $episode->addStar(2);
} catch (InvalidEpisodeStarNumberException $e) {
  echo $e->getMessage().PHP_EOL;
}