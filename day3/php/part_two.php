<?php

require_once(__DIR__ . '/Direction.php');

/**
 * 147  142  133  122   59
 * 304    5    4    2   57
 * 330   10    1    1   54
 * 351   11   23   25   26
 * 362  747  806--->   ...
 * 
 * So, the first few squares' values are chosen as follows:
 *  - Square 1 starts with the value 1.
 *  - Square 2 has only one adjacent filled square (with value 1), so it also 
 *    stores 1.
 *  - Square 3 has both of the above squares as neighbors and stores the sum of 
 *    their values, 2.
 *  - Square 4 has all three of the aforementioned squares as neighbors and 
 *    stores the sum of their values, 4.
 *  - Square 5 only has the first and fourth squares as neighbors, so it gets 
 *    the value 5.
 * 
 * What is the first value written that is larger than your puzzle input?
 */


echo solve(file_get_contents('../input.txt'));


///////////////
//  Solution
///////////////
function solve(int $input) : int {
	// I think I'll need to use a grid of some sort...
  $grid = array_fill(0, 30, array_fill(0, 30, 0));
  
  $x = count($grid) / 2;
  $y = $x;

  $grid[$x][$y] = 1;

  $run_distance = 0;
  for ($run = 0; $run <= $input ; $run++) {
    // every two runs, increment distance to travel
    if ($run % 2 == 0) {
      $run_distance++;
    }

    $direction = $run % 4;

    // make the run
    for ($j = 0; $j < $run_distance; $j++) {
      switch ($direction) {
        case Direction::UP:
          $y++;
          break;
        case Direction::DOWN:
          $y--;
          break;
        case Direction::LEFT:
          $x--;
          break;
        case Direction::RIGHT:
          $x++;
          break;
        default: throw new Exception('Invalid direction');
      }

      $grid[$x][$y] = sum_of_neighbors($grid, $x, $y);

      if ($grid[$x][$y] > $input) {
        return $grid[$x][$y];
      }
    }
  }
}

function sum_of_neighbors(array &$grid, int $x, int $y) {
  // relative coords of all the neighbors
  $pairs = array(
    [0,0],
    [0,1],
    [0,-1],
    [1,0],
    [1,1],
    [1,-1],
    [-1,0],
    [-1,1],
    [-1,-1],
  );

  $sum = 0;
  foreach ($pairs as $pair) {
    if (isset($grid[$x + $pair[0]][$y + $pair[1]])) {
      $sum += $grid[$x + $pair[0]][$y + $pair[1]];
    }
  }

  return $sum;
}