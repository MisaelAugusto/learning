<?php

namespace ScreenMatch\Model;

// use DivisionByZeroError;
// use Exception;

use ScreenMatch\Exception\InvalidEpisodeStarNumberException;
use Throwable;

class Episode implements Rateable {
  use Rating;

  public function __construct(
    public readonly Series $series,
    public readonly string $title,
    public readonly int $number
  ) {
  }

  /**
   * Adds a star number to episode
   * @param int $star
   * @throws InvalidEpisodeStarNumberException Se a nota for diferente de 0 e 1
   * @return void
   */
  public function addStar(int $star): void {
    if (0 > $star || $star > 1) throw new InvalidEpisodeStarNumberException();
    else $this->stars[] = $star;
  }
  
  /**
   * Calculates the rating based on stars number
   * @return float
   */
  public function getStarsRating(): float {
    $starsSum = array_sum($this->stars);

    try {
      $result = round($starsSum * 5 / count($this->stars), 2);
    } catch (Throwable) {
      $result = 0;
    } finally {
      echo "Finished calculation".PHP_EOL;
    }

    return $result;
  }
}