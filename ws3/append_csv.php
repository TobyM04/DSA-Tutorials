<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize the input
    $quote = filter_input(INPUT_POST, 'quote', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $source = filter_input(INPUT_POST, 'source', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dob_dod = filter_input(INPUT_POST, 'dob-dod', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $wplink = filter_input(INPUT_POST, 'wplink', FILTER_SANITIZE_URL);
    $wpimg = filter_input(INPUT_POST, 'wpimg', FILTER_SANITIZE_URL);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Prepare the line to be appended
    $new_line = "$quote|$source|$dob_dod|$wplink|$wpimg|$category\n";

    // Define the path to the CSV file
    $file_path = __DIR__ . DIRECTORY_SEPARATOR . 'quotes.csv';

    // Use file_put_contents with the FILE_APPEND flag to avoid concurrency issues
    if (file_put_contents($file_path, $new_line, FILE_APPEND | LOCK_EX) === false) {
        // Handle error when file can't be written to
        die("Unable to write to file!");
    } else {
        // Redirect or notify of success
        echo "New record created successfully.";
    }
} else {
    // Handle incorrect method
    http_response_code(405);
}
?>