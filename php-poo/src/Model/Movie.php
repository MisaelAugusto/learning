<?php

namespace ScreenMatch\Model;

use Override;

class Movie extends Title {

  public function __construct(
    string $name,
    int $year,
    Category $category,
    public readonly int $durationInMinutes
    ) {
      parent::__construct($name, $year, $category);
  }

  #[Override]
  public function getDurationInMinutes(): int {
    return $this->durationInMinutes;
  }
}