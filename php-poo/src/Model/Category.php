<?php

namespace ScreenMatch\Model;

enum Category {
  case Action;
  case Comedy;
  case Drama;
  case Horror;
  case Romance;

  public function availableForUnderage(): bool {
    return match($this) {
      Category::Comedy,
      Category::Drama,
      Category::Romance => true,
      default => false,
    };
  }
}