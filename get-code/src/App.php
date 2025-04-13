<?php

namespace MisaelAugusto\GetCode;

use MisaelAugusto\GetCode\Utility;
use MisaelAugusto\GetCode\GithubClient;

class App
{
    private GithubClient $githubClient;

    public readonly string $username;

    public function __construct()
    {
        $this->username = '';
        $this->githubClient = new GithubClient();
    }

    public function run()
    {
        $this->displayHeader();

        $this->username = Utility::readUserName();

        $repositoriesNames = $this->githubClient->fetchRepositories($this->username);

        $this->showOptionsMenu($repositoriesNames);
    }

    private function displayHeader(string $screen = '')
    {
        Utility::clear();

        $title = "Get code";
        $description = "This is a cli to get code from a file in a github"
          .PHP_EOL
          ."repository right into your local directory!";

        $borderChar = "#";
        $lineLength = 40;

        echo "\033[1;36m#" . str_repeat($borderChar, $lineLength) . "#\033[0m".PHP_EOL;
        echo "\033[1;36m#" . str_pad($title, $lineLength, ' ', STR_PAD_BOTH) . "#\033[0m".PHP_EOL;
        echo "\033[1;36m#" . str_repeat($borderChar, $lineLength) . "#\033[0m".PHP_EOL;

        echo PHP_EOL."\033[37m" . str_pad($description, $lineLength, ' ', STR_PAD_BOTH) . "\033[0m".PHP_EOL.PHP_EOL;

        if ($screen != '') {
            echo "\033[1;37m" . $screen. "\033[0m".PHP_EOL.PHP_EOL;
        }
    }

    private function showOptionsMenu($options)
    {
        Utility::enableRawMode();

        $selectedIndex = 0;

        $this->displayHeader('Repositories');

        displayMenu($options, $selectedIndex);

        while (true) {
            $key = Utility::readKey();

            switch ($key) {
                case "\033[A":
                    if ($selectedIndex > 0) {
                        $selectedIndex--;
                    }
                    break;
                case "\033[B":
                    if ($selectedIndex < count($options) - 1) {
                        $selectedIndex++;
                    }
                    break;
                case PHP_EOL:
                    Utility::disableRawMode();

                    return $options[$selectedIndex];
            }

            displayHeader('Repositories');

            displayMenu($options, $selectedIndex);
        }
    }
}
