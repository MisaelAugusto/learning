<?php

$currentAccounts = [
  '0001' => [
    'holder' => 'Jhoe',
    'balance' => 1000
  ],
  '0002' => [
    'holder' => 'Mary',
    'balance' => 2000
  ],
  '0003' => [
    'holder' => 'Bob',
    'balance' => 3000
  ]
];

$currentAccounts['0004'] = [
  'holder' => 'New with id',
  'balance' => 4000
];

$currentAccounts[] = [
  'holder' => 'New without id',
  'balance' => 4000
];

echo "# holders:".str_repeat(PHP_EOL, 2);

foreach ($currentAccounts as $account) echo $account['holder'].PHP_EOL;

echo PHP_EOL."# ids:".str_repeat(PHP_EOL, 2);

foreach ($currentAccounts as $id => $account) echo $id.PHP_EOL;