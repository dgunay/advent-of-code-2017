<?php

/**
 * ...review a sequence of digits (your puzzle input) and find the sum of all 
 * digits that match the next digit in the list. The list is circular, so the 
 * digit after the last digit is the first digit in the list.
 */

$test_sequences = array(
  '1122'      => 3,
  '1111'      => 4,
  '1234'      => 0,
  '91212129'  => 9,
);

foreach ($test_sequences as $input => $answer) {
  $result = solve($input);
  if ($result != $answer) {
    exit("Test input {$input} was incorrect (result: {$result}).");
  }
}

// all tests pass, let's try the real input
$answer = solve(file_get_contents('../input.txt'));

echo $answer;


///////////////////
//  Solution
///////////////////
function solve(string $list) {      
  $sum = 0;
  for ($i = 0 ; $i < strlen($list) ; $i++) { 
    $current_char = $list[$i];

    // handle the case for the last char in the list
    $next_char = ($i == strlen($list) - 1) ? $list[0] : $list[$i + 1];

    // does it match the next char?
    if ($current_char == $next_char) {
      $sum += $current_char;      
    }
  }

  return $sum;
}