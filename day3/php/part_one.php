<?php

/**
 * 17  16  15  14  13
 * 18   5   4   3  12
 * 19   6   1   2  11
 * 20   7   8   9  10
 * 21  22  23---> ...
 * 
 * How many steps away is our number, if you move only up down left or right?
 */

$test_cases = array(
  // 1     => 0,
  // 12    => 3,
  // 23    => 2,
  1024  => 31,
);

foreach ($test_cases as $input => $answer) {
  $result = solve($input);
  if ($result !== $answer) {
    exit("Failed test case ({$input} : {$result}). Should be {$answer}");
  }
}

$input = file_get_contents('../input.txt');

echo solve($input);


//////////////////
//  Solution
//////////////////
function solve(int $input) : int {
  // $distances = array(
  //   Direction::RIGHT => 0, 
  //   Direction::UP    => 0, 
  //   Direction::LEFT  => 0, 
  //   Direction::DOWN  => 0, 
  // );

  $axes = array(
    'x' => 0,
    'y' => 0,
  );

  $number = 1;
  $run_distance = 1;
  $direction = Direction::RIGHT;
  for ($i = 0 ; $i <= $input ; $i++) {
    $direction = $i % 4;
    
    // one one, two two, three three, four four    
    for ($j = 0; $j < $run_distance; $j++) {
      $number++;
      // echo $direction . '(dist: ' . $run_distance . ')' . PHP_EOL;
      
      // echo $direction . PHP_EOL;
      // echo (($direction + 2) % 4) . PHP_EOL;
      // exit;

      // decrement the opposite direction
      // $distances[$direction]++;
      // $distances[($direction + 2) % 4]--;

      switch ($direction) {
        case Direction::UP:
          $axes['y']++;
          break;
        case Direction::DOWN:
          $axes['y']--;
          break;
        case Direction::LEFT:
          $axes['x']--;
          break;
        case Direction::RIGHT:
          $axes['x']++;
          break;
      }

      if ($number == $input) {
        print_r($axes); exit;

        return array_sum(array_map(function($val) { 
          return abs($val);
        }, $axes));
      }
    }

    // every two runs, increment distance to travel
    if ($i % 2 == 0) {
      $run_distance++;
    }
  }
}

abstract class Direction {
  const RIGHT = 0;
  const UP    = 1;
  const LEFT  = 2;
  const DOWN  = 3;
}
