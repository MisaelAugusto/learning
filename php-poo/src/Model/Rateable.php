<?php

namespace ScreenMatch\Model;

interface Rateable {
  public function addStar(int $star): void;
  public function getStarsRating(): float;
}