<?php

/**
 * The message includes a list of the offsets for each jump. Jumps are relative: 
 * -1 moves to the previous instruction, and 2 skips the next one. Start at the 
 * first instruction in the list. The goal is to follow the jumps until one 
 * leads outside the list.
 * 
 * In addition, these instructions are a little strange; after each jump, the 
 * offset of that instruction increases by 1. So, if you come across an offset 
 * of 3, you would move three instructions forward, but change it to a 4 for the 
 * next time it is encountered.
 * 
 * How many steps does it take to jump out of the list?
 */

$test_case = '0
3
0
1
-3';

$result = solve($test_case);
if ($result !== 5) {
  exit('Failed test case (took ' . $result . ' jumps.)');
}

echo solve(file_get_contents('../input.txt'));

/////////////////
//  Solution
/////////////////

function solve(string $input) : int {
  // put list of jumps into an array
  $list = array_map(function($element) {
    return (int) trim($element);
  }, explode("\n", $input));

  $jumps_taken = 0;
  $current_index = 0;
  while (array_key_exists($current_index, $list)) {
    $jump_offset = $list[$current_index];
    $list[$current_index]++;
    $current_index += $jump_offset;
    $jumps_taken++;
  }

  return $jumps_taken;
}