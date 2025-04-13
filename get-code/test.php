<?php

// Put terminal in raw mode to capture key presses
function enableRawMode()
{
    system('stty -icanon -echo');
}

// Restore terminal to default mode
function disableRawMode()
{
    system('stty sane');
}

// Capture key presses including arrow keys
function readKey()
{
    $key = '';
    $char = stream_get_contents(STDIN, 1);

    if ($char === "\033") { // If the first character is ESC
        $char .= stream_get_contents(STDIN, 2); // Capture the next two characters
    }

    return $char;
}

// Display the header
function displayHeader()
{
    $title = "My CLI App";
    $description = "Navigate the options below using arrow keys.";

    // Border characters
    $borderChar = "#";
    $lineLength = 40;

    // Create a top border
    echo "\033[1;36m" . str_repeat($borderChar, $lineLength) . "\033[0m\n"; // Top border in cyan
    echo "\033[1;36m" . str_pad($title, $lineLength, ' ', STR_PAD_BOTH) . "\033[0m\n"; // Title in cyan
    echo "\033[1;36m" . str_repeat($borderChar, $lineLength) . "\033[0m\n"; // Bottom border of the title

    // Description
    echo "\033[1;37m" . str_pad($description, $lineLength, ' ', STR_PAD_BOTH) . "\033[0m\n"; // Description in white
    echo "\033[1;36m" . str_repeat($borderChar, $lineLength) . "\033[0m\n\n"; // Bottom border for the header
}

echo "\033[32mThis text is green!\033[0m\n"; // Green text
echo "\033[31;47mThis text is red on a white background!\033[0m\n"; // Red text on white background
echo "\033[1;34mThis text is bold blue!\033[0m\n"; // Bold blue text
echo "\033[4;35mThis text is underlined magenta!\033[0m\n"; // Underlined magenta text



// Display the loading indicator
function displayLoadingIndicator()
{
    $loadingChars = ['|', '/', '-', '\\'];
    echo "\033[1;33mLoading";

    // Animate the loading indicator
    for ($i = 0; $i < 20; $i++) { // Run for a fixed duration
        echo "\rLoading " . $loadingChars[$i % count($loadingChars)] . " ";
        usleep(100000); // Sleep for 0.1 seconds
    }

    echo "\r\033[0K"; // Clear the line
    echo "\n"; // New line after loading
}

// Simulate fetching repositories (you can replace this with actual fetching logic)
function fetchRepositories()
{
    displayLoadingIndicator(); // Show loading indicator
    sleep(2); // Simulate a delay for fetching data (replace with actual fetching)
}

// Display the menu options
function displayMenu($options, $selectedIndex)
{
    foreach ($options as $index => $option) {
        if ($index === $selectedIndex) {
            echo "> \033[1;32m$option\033[0m\n"; // Highlight the selected option
        } else {
            echo "  $option\n";
        }
    }
}

// Main menu logic
function menu($options)
{
    $selectedIndex = 0;
    displayHeader(); // Display the header
    displayMenu($options, $selectedIndex);

    while (true) {
        $key = readKey();

        switch ($key) {
            case "\033[A": // Up arrow
                if ($selectedIndex > 0) {
                    $selectedIndex--;
                }
                break;
            case "\033[B": // Down arrow
                if ($selectedIndex < count($options) - 1) {
                    $selectedIndex++;
                }
                break;
            case "\n": // Enter key
                disableRawMode();
                return $selectedIndex; // Return the selected option
        }

        displayHeader(); // Display the header again
        displayMenu($options, $selectedIndex);
    }
}

// Options for the menu
$options = [
    "Option 1: Say Hello",
    "Option 2: Say Goodbye",
    "Option 3: Exit"
];

// Enable raw mode to read arrow keys
enableRawMode();

// Simulate fetching repositories
fetchRepositories(); // Call the fetch function to simulate loading

// Display the menu and capture the user's selection
$selectedOption = menu($options);

// Handle the selected option
switch ($selectedOption) {
    case 0:
        echo "Hello!\n";
        break;
    case 1:
        echo "Goodbye!\n";
        break;
    case 2:
        echo "Exiting...\n";
        break;
}

// Restore the terminal settings
disableRawMode();
