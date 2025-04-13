<?php

require 'vendor/autoload.php';

use MisaelAugusto\GetCode\GithubCache;

function clear()
{
    system('clear');
}

function enableRawMode()
{
    system('stty -icanon -echo');
}

function disableRawMode()
{
    system('stty sane');
}

function readKey()
{
    $char = stream_get_contents(STDIN, 1);

    if ($char === "\033") { // If the first character is ESC
        $char .= stream_get_contents(STDIN, 2); // Capture the next two characters
    }

    return $char;
}

function displayHeader(string $screen = '')
{
    clear();

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

function displayLoadingIndicator(string $loadingTitle = '')
{
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

function displayErrorMessage()
{
    displayHeader();

    echo "\033[1;31mError copying file!\033[0m". PHP_EOL;
}

function displaySuccessMessage()
{
    displayHeader();

    echo "\033[1;32mFile copied successfully!\033[0m". PHP_EOL;
}

function copyFile($content, $client, $username, $selectedRepositoryName, $selectedContentName)
{
    try {
        displayLoadingIndicator('Copying file...');

        if (isset($content['content'])) {
            $decodedFile = base64_decode($content['content']);
            system("echo '$decodedFile' > {$content['name']}");
        } else {
            throw new CopyDirectoryException();
        }

        displaySuccessMessage();
    } catch (CopyDirectoryException) {
        $subContents = fetchContent($client, $username, $selectedRepositoryName, $selectedContentName);

        $selectedSubContentName = contentsMenu(contentsNames: $subContents);

        $subContent = fetchContent($client, $username, $selectedRepositoryName, $selectedSubContentName);

        copyFile($subContent, $client, $username, $selectedRepositoryName, $selectedContentName);
    } catch (Throwable) {
        displayErrorMessage();
    }
}

function fetchContent($client, $username, $selectedRepositoryName, $selectedContentName)
{
    displayLoadingIndicator('Fetching content...');

    $content = $client->api('repo')->contents()->show($username, $selectedRepositoryName, $selectedContentName);

    return $content;
}

function fetchRepositoryContents($client, $username, $selectedRepositoryName)
{
    displayLoadingIndicator('Fetching contents...');

    $contents = $client->api('repo')->contents()->show($username, $selectedRepositoryName, '');

    $contentsNames = array_map(function ($content) {
        return $content['name'];
    }, $contents);

    return $contentsNames;
}

function fetchRepositories($client, $username)
{
    displayLoadingIndicator(loadingTitle: 'Fetching repositories...');

    $repositories = $client->user()->repositories($username);

    $repositoriesNames = array_map(function ($repo) {
        return $repo['name'];
    }, $repositories);

    return $repositoriesNames;
}

function displayMenu($options, $selectedIndex)
{
    foreach ($options as $index => $option) {
        if ($index === $selectedIndex) {
            echo "> \033[1;32m$option\033[0m".PHP_EOL;
        } else {
            echo "  $option".PHP_EOL;
        }
    }
}

function contentsMenu($contentsNames)
{
    enableRawMode();

    $selectedIndex = 0;

    displayHeader('Contents');
    displayMenu($contentsNames, $selectedIndex);

    while (true) {
        $key = readKey();

        switch ($key) {
            case "\033[A":
                if ($selectedIndex > 0) {
                    $selectedIndex--;
                }
                break;
            case "\033[B":
                if ($selectedIndex < count($contentsNames) - 1) {
                    $selectedIndex++;
                }
                break;
            case PHP_EOL:
                disableRawMode();
                return $contentsNames[$selectedIndex];
        }

        displayHeader('Contents');
        displayMenu($contentsNames, $selectedIndex);
    }
}

function repositoriesMenu($repositoriesNames)
{
    enableRawMode();

    $selectedIndex = 0;

    displayHeader('Repositories');
    displayMenu($repositoriesNames, $selectedIndex);

    while (true) {
        $key = readKey();

        switch ($key) {
            case "\033[A":
                if ($selectedIndex > 0) {
                    $selectedIndex--;
                }
                break;
            case "\033[B":
                if ($selectedIndex < count($repositoriesNames) - 1) {
                    $selectedIndex++;
                }
                break;
            case PHP_EOL:
                disableRawMode();
                return $repositoriesNames[$selectedIndex];
        }

        displayHeader('Repositories');
        displayMenu($repositoriesNames, $selectedIndex);
    }
}


function showHelp()
{
    echo "Como utilizar o get-code".str_repeat(PHP_EOL, 2);
    echo "Options:".PHP_EOL;
    echo "  -p  --problem=<number>     The Beecrowd problem code (ex: --problem=1000)".PHP_EOL;
    echo "  -l  --language=<string>    The programming language used for the solution (ex: --language=php)".PHP_EOL;
    echo "  -h  --help                 Show this help message.".PHP_EOL;
    exit;
}

$client = new \Github\Client();


$githubCache = new GithubCache();

var_dump($githubCache->repositories);
// displayHeader();

// echo "Type your github username: ";
// $username = trim(fgets(STDIN));
// echo "";

// $repositoriesNames = fetchRepositories($client, $username);

// foreach ($repositoriesNames as $repositoryName) {
//     $repositories[$repositoryName] = [];
// }

// $selectedRepositoryName = repositoriesMenu($repositoriesNames);

// $contentNames = fetchRepositoryContents($client, $username, $selectedRepositoryName);

// foreach ($contentNames as $contentName) {
//     $repositories[$selectedRepositoryName][$contentName] = [];
// }

// $selectedContentName = contentsMenu($contentNames);

// $content = fetchContent($client, $username, $selectedRepositoryName, $selectedContentName);

// $contentText = base64_decode($content['content']);

// $repositories[$selectedRepositoryName][$selectedContentName] = $contentText;

// copyFile($content, $client, $username, $selectedRepositoryName, $selectedContentName);

// $jsonData = json_encode($repositories, JSON_PRETTY_PRINT);

// file_put_contents('repositories.json', $jsonData);

// copy file to local

// $options = getopt("p::l::h", ["problem::", "language::", "help"]);

// if (isset($options['h']) || isset($options['help'])) {
//     showHelp();
// }

// var_dump($options);
