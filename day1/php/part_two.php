<?php

/**
 * ...consider the digit halfway around the circular list. That is, if your list 
 * contains 10 items, only include a digit in your sum if the digit 10/2 = 5 
 * steps forward matches it. Fortunately, your list has an even number of 
 * elements.
 */

$test_sequences = array(
  '1212'      => 6,
  '1221'      => 0,
  '123425'    => 4,
  '123123'    => 12,
  '12131415'  => 4,
);

foreach ($test_sequences as $input => $answer) {
  $result = solve($input);
  if ($result != $answer) {
    exit("Test input {$input} was incorrect (result: {$result}).");
  }
}

echo solve(file_get_contents('../input.txt'));

////////////////
//  Solution
////////////////
function solve(string $list) {
  $sum = 0;
  $len = strlen($list);
  for ($i = 0; $i < $len; $i++) {
    if ($list[$i] == $list[($i + ($len / 2)) % $len]) {
      $sum += $list[$i];
    }
  }

  return $sum;
}