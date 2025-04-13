<?php

$ages = [24, 32, 20, 21, 27];

echo "First age: $ages[0]".PHP_EOL;
echo "Last age: ".end($ages).str_repeat(PHP_EOL, 2);

echo "# original:".PHP_EOL;

foreach ($ages as $age) echo $age.PHP_EOL;

$ages[0] = 18;
$ages[3] = 33;
$ages[99] = 99;
$ages[null] = 123;

echo "# updated:".PHP_EOL;

foreach ($ages as $age) echo $age.PHP_EOL;
