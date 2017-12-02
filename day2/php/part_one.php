<?php

/**
 * The spreadsheet consists of rows of apparently-random numbers. To make sure 
 * the recovery process is on the right track, they need you to calculate the 
 * spreadsheet's checksum. For each row, determine the difference between the 
 * largest value and the smallest value; the checksum is the sum of all of these 
 * differences.
 */

$fp_in = fopen('../input.txt', 'r');

while($line = fgets($fp_in)) {
  preg_match_all('/\d+/', $line, $matches);
  print_r($matches;
  exit;)
}