<?php

/* 
Each instruction consists of several parts: the register to modify, whether to 
increase or decrease that register's value, the amount by which to increase or 
decrease it, and a condition. If the condition fails, skip the instruction 
without modifying the register. The registers all start at 0. The instructions 
look like this:

b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10

These instructions would be processed as follows:

Because a starts at 0, it is not greater than 1, and so b is not modified.
a is increased by 1 (to 1) because b is less than 5 (it is 0).
c is decreased by -10 (to 10) because a is now greater than or equal to 1 (it is 1).
c is increased by -20 (to -10) because c is equal to 10.
After this process, the largest value in any register is 1.

You might also encounter <= (less than or equal to) or != (not equal to). 
However, the CPU doesn't have the bandwidth to tell you what all the registers 
are named, and leaves that to you to determine.

What is the largest value in any register, at any point in time, after 
completing the instructions in your puzzle input?
*/

$test_cases = array(
  'b inc 5 if a > 1
  a inc 1 if b < 5
  c dec -10 if a >= 1
  c inc -20 if c == 10' => 10,
);

foreach ($test_cases as $input => $answer) {
  $result = solve($input);
  if ($result !== $answer) {
    exit('Failed test case ' . $input . ', expected ' . $answer . ', got ' . $result);
  }
}

echo solve(file_get_contents('../input.txt'));

/////////////////////
//  Solution
/////////////////////
function solve(string $input) : int {
  // gather each instruction as an array of tokens
  $instructions = array_map(
    function($val) {
      return explode(' ', trim($val));
    }, 
    array_filter(
      explode("\n", $input)
    )
  );
  
  // key registers str => int as first token of each instruction
  $registers = array_fill_keys(
    array_map(
      function ($val) {
        return $val[0];
      }, 
      $instructions
    ),
    0
  );

  $highest_value = 0;
  // execute each instruction
  foreach ($instructions as $instruction) {
    // evaluate 4 - 6
    $evaluate = false;
    $operator = $instruction[5];
    $left = $registers[$instruction[4]];
    $right = $instruction[6];
    switch ($operator) {
      case '==': 
        $evaluate = $left == $right;
        break;
      case '>': 
        $evaluate = $left > $right;
        break;
      case '<': 
        $evaluate = $left < $right;
        break;
      case '>=': 
        $evaluate = $left >= $right;
        break;
      case '<=': 
        $evaluate = $left <= $right;
        break;
      case '!=': 
        $evaluate = $left != $right;
        break;
    }

    if ($evaluate) {
      switch($instruction[1]) {
        case 'inc':
          $registers[$instruction[0]] += $instruction[2];
          break; 
        case 'dec':
          $registers[$instruction[0]] -= $instruction[2];
          break;
      }

      if ($registers[$instruction[0]] > $highest_value) {
        $highest_value = $registers[$instruction[0]];
      }
    }
  }

  return $highest_value;
}