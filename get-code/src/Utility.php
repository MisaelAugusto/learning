<?php

namespace MisaelAugusto\GetCode;

class Utility
{
    public static function clear()
    {
        system('clear');
    }

    public static function enableRawMode()
    {
        system('stty -icanon -echo');
    }

    public static function disableRawMode()
    {
        system('stty sane');
    }

    public static function readKey()
    {
        $char = stream_get_contents(STDIN, 1);

        if ($char === "\033") { // If the first character is ESC
            $char .= stream_get_contents(STDIN, 2); // Capture the next two characters
        }

        return $char;
    }

    public static function readUserName()
    {
        echo "Type your github username: ";
        $username = trim(fgets(STDIN));
        echo "";

        return $username;
    }

    public static function displayMenu($options, $selectedIndex)
    {
        foreach ($options as $index => $option) {
            if ($index === $selectedIndex) {
                echo "> \033[1;32m$option\033[0m".PHP_EOL;
            } else {
                echo "  $option".PHP_EOL;
            }
        }
    }

    public static function displayLoadingIndicator(string $loadingTitle)
    {
      $this->clear();
      displayHeader($loadingTitle);

      $loadingChars = ['|', '/', '-', '\\'];
      echo "\033[1;33mLoading";
  
      for ($i = 0; $i < 40; $i++) {
          echo "\rLoading " . $loadingChars[$i % count($loadingChars)] . " ";
          usleep(100000);
      }
  
      echo "\r\033[0K";
      echo PHP_EOL;
    }
}
