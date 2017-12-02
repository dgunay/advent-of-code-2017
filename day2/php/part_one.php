<?php

/**
 * The spreadsheet consists of rows of apparently-random numbers. To make sure 
 * the recovery process is on the right track, they need you to calculate the 
 * spreadsheet's checksum. For each row, determine the difference between the 
 * largest value and the smallest value; the checksum is the sum of all of these 
 * differences.
 */

$fp_in = fopen('../input.txt', 'r');

$checksum = 0;
while($line = fgets($fp_in)) {
  preg_match_all('/\d+/', $line, $matches);
  $values = $matches[0];

  $smallest_value = $values[0];
  $largest_value = $values[0];

  foreach ($values as $value) {
    if ($value < $smallest_value) {
      $smallest_value = $value;
    }

    if ($value > $largest_value) {
      $largest_value = $value;
    }
  }

  $difference = $largest_value - $smallest_value;
  $checksum += $difference;
}

echo $checksum;