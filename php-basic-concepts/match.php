<?php

abstract class Question {}
class Single extends Question {}
class Multiple extends Question {}

$input = 'question-type';

$question = match($input) {
  'single' => new Single(),
  'multiple' => new Multiple(),
  default => null // comment this line to get an exception
};