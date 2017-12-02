<?php

/**
 * It sounds like the goal is to find the only two numbers in each row where one 
 * evenly divides the other - that is, where the result of the division 
 * operation is a whole number. They would like you to find those numbers on 
 * each line, divide them, and add up each line's result.
 */

$fp_in = fopen('../input.txt', 'r');

$checksum = 0;
while($line = fgets($fp_in)) {
  preg_match_all('/\d+/', $line, $matches);
  $values = $matches[0];

  for ($i = 0 ; $i < sizeof($values) ; $i++) {
    for ($j = 0 ; $j < sizeof($values); $j++) {
      if ($j !== $i && !is_float($values[$j] / $values[$i])) {
        $checksum += $values[$j] / $values[$i];
      }
    }
  }
}

echo $checksum;