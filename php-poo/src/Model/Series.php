<?php

namespace ScreenMatch\Model;

use Override;

class Series extends Title {

  public function __construct(
    string $name,
    int $year,
    Category $category,
    public readonly int $seasons,
    public readonly int $episodesPerSeason,
    public readonly int $durationInMinutesPerEpisode
    ) {
      parent::__construct($name, $year, $category);
  }

  #[Override]
  public function getDurationInMinutes(): int {
    return $this->seasons * $this->episodesPerSeason * $this->durationInMinutesPerEpisode;
  }
}