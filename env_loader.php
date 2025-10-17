<?php
$filepath = '.env'; /*may need to change DB_NAMe to group1_DB */

if (!file_exists($filepath)) {
    die("Error: .env file not found."); 
}

$lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    $line = trim($line);
    if ($line && strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        putenv(trim($key) . '=' . trim($value));
        $_ENV[trim($key)] = trim($value);
    }
}


/*This code structure was made in reference to "How to Properly Load Data from .env Files in PHP" by vlogize: 
vlogize. (2025, March 28). How to Properly Load Data from .env Files in PHP. YouTube. https://www.youtube.com/watch?v=f3AB3Wu0Nig

<!-(16/10/2025) The code was further modified to troubleshoot SQL table loading onto browser page with assistence from Chatgpt:
    ChatGPT. (2025, October 16). Debugging and securely loading .env files in PHP [AI conversation]. OpenAI. https://chat.openai.com/ */