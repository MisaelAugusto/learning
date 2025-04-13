<?php

namespace ScreenMatch\Exception;

class InvalidEpisodeStarNumberException extends \InvalidArgumentException {
  public function __construct() {
    parent::__construct("Invalid star number, it should be 0 or 1");
  }
}
