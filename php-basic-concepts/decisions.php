<?php

$age = 24;
$name = "Misael1";
$nationality = "Brazil1";

$isAccompanied = false;
$isNotMe = false;

if ($age >= 18 && $name == "Misael" || $nationality == "Brazil") {
  echo "You're of age".PHP_EOL;
} elseif ($isAccompanied) {
  echo "Ok.".PHP_EOL;
} else if (!$isNotMe) {
  echo "Not ok.".PHP_EOL;
} else echo "You're underage".PHP_EOL;

$isJavascript = false;

echo ($isJavascript ? 'Javascript' : 'PHP').PHP_EOL;