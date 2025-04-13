<?php

// include 'functions.php';
// require 'functions.php';
require_once 'functions.php';

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

['0001' => $account] = $currentAccounts;
echo join(" ", $account).str_repeat(PHP_EOL, 2);

$updatedCurrentAccounts = makeTransaction('0003', $currentAccounts, 500);

unset($updatedCurrentAccounts['0002']);

foreach ($updatedCurrentAccounts as $id => $currentAccount) {
  showCurrentAccount(['id' => $id, ...$currentAccount]);
}

echo mb_strtoupper('12345ççacaas~aããã-1290()abcd').PHP_EOL;
echo strtoupper('12345ççacaas~aããã-1290()abcd').PHP_EOL;

echo PHP_EOL."====== Pointers =====".PHP_EOL;

$number = 4;

incrementNumberWithPointer($number);

echo "Incremented number: $number".PHP_EOL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Bank</title>
</head>
<body>
  <h2>Contas correntes</h2>

  <dl>
    <?php foreach ($currentAccounts as $cpf => $currentAccount) { ?>
      <dt>
          <h4><?= $currentAccount['holder']; ?> - <?= $cpf ?></h4>
      </dt>
      
      <dd>Saldo: <?= $currentAccount['balance']; ?></dd>
    <?php }?>
  </dl>
</body>
</html>
