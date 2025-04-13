<?php

function makeTransaction(string $accountId, array $currentAccounts, int $transactionValue): array {
  return [
    ...$currentAccounts,
    $accountId => [
      ...$currentAccounts[$accountId],
      'balance' => $currentAccounts[$accountId]['balance'] + $transactionValue
    ]
  ];
}

function showCurrentAccount(array $currentAccount): void {
  ['id' => $id, 'holder' => $holder, 'balance' => $balance] = $currentAccount;

  echo "Account id: $id".PHP_EOL;
  echo "Account holder: $holder".PHP_EOL;
  echo "Account balance: $balance".PHP_EOL.PHP_EOL;
}

function incrementNumberWithPointer(int &$number): void {
  $number++;
}