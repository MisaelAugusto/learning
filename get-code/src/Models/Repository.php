<?php

class Repository {
  public function __construct(public readonly array $contents)
  {
  }

  public function getContentByName($name)
  {
    return $this->contents[$name];
  }
}