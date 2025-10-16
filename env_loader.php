<?php
$filepath = '.env';

$data = array();

$lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Read file into array
foreach ($lines as $index => $line) {
    if (!empty($line)) { // check if the line isn't empty
        $count = substr_count($line, '='); // Count the number of '='
        
        if ($count > 1) {
            $pos = strpos($line, '='); // Find the position of the first '='
            $param = substr($line, 0, $pos); // Extract the parameter name
            $value = substr($line, $pos + 1); // Extract the value of everything after the first '=' 
        } else {
            list($param, $value) = explode('=', trim($line)); // Split line by '='
        }

        $data[$param] = $value; // Store the key-value pair in the array
    } // closeing "if"
} // closing 'foreach'
?>

<?php
// Test output
echo "<pre>";
print_r($data);
echo "</pre>";
?>

<!--This code was made in reference to "How to Properly Load Data from .env Files in PHP" by vlogize: 
vlogize. (2025, March 28). How to Properly Load Data from .env Files in PHP. YouTube. https://www.youtube.com/watch?v=f3AB3Wu0Nig -!>

‌