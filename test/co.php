<?php

$starts = '31.05.2025 00:00';
$ends = '2025-07-01 00:00:00';

// Convert the strings to DateTime objects
$startDateTime = DateTime::createFromFormat('d.m.Y H:i', $starts);
$endDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $ends);

// Check if the date parsing was successful
if ($startDateTime === false || $endDateTime === false) {
    echo "Error: Invalid date format\n";
    exit(1);  // Or throw an exception, depending on your error handling
}

// Calculate the difference
$interval = $startDateTime->diff($endDateTime);

// Get the number of days from the DateInterval object
$daysDifference = $interval->days;

echo "The difference between the two dates is: " . $daysDifference . " days\n";
