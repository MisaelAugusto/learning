<?php

spl_autoload_register((function (string $className) {
  $path = str_replace('ScreenMatch', 'src', $className).'.php';
  $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

  $absolutePath = __DIR__.DIRECTORY_SEPARATOR.$path;
  
  // var_dump($absolutePath);

  if (file_exists($absolutePath)) require_once $absolutePath;
}));