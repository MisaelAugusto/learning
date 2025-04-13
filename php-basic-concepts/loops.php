<?php

$counter = 0;
$loops = 3;

while ($counter <= $loops) {
  echo "#while - $counter".PHP_EOL;

  $counter++;
}

$counter = 0;

for ($counter = 0; $counter <= $loops; $counter++) {
  echo "#for - $counter".PHP_EOL;
}

$counter = 0;

do {
  echo "#do while - $counter".PHP_EOL;

  $counter++;
} while ($counter <= $loops);
