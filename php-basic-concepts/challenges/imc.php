<?php

$height = (float) readline("Type your height (m): ");
$weight = (float) readline("Type your weight (kg): ");

$imc = round($weight / ($height ** 2), 2);

echo PHP_EOL."Your IMC is: $imc".PHP_EOL;

if (18.5 <= $imc && $imc <= 24.9)
  echo "You are at your ideal weight".PHP_EOL;
else 
  echo "You are ".($imc > 24.9 ? "overweight" : "underweight").PHP_EOL;
