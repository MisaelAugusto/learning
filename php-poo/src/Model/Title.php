<?php

namespace ScreenMatch\Model;

use DivisionByZeroError;

abstract class Title implements Rateable {
  use Rating;

  // private const float MIN_STARS_RATING = 3;
  protected static float $minStarsRating = 3.0;

  public function __construct(
    public readonly string $name,
    public readonly int $year,
    public readonly Category $category
    ) {
  }

  public function addStar(int $star): void {
    if (0 < $star && $star < 6) $this->stars[] = $star;
  }
  
  public function getStarsRating(): float {
    $starsSum = array_sum($this->stars);

    try {
      $result = round($starsSum / count($this->stars), 2);
    } catch (DivisionByZeroError) {
      $result = 0;
    }

    return $result;
  }

  public function isGood(): bool {
    return $this->getStarsRating() >= self::$minStarsRating;
  }

  public function isAvailableForUnderage(): bool {
    return $this->category->availableForUnderage();
  }

  abstract public function getDurationInMinutes(): int;
}