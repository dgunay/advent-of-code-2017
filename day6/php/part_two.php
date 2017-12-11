<?php

/**
 * In this area, there are sixteen memory banks; each memory bank can hold any 
 * number of blocks. The goal of the reallocation routine is to balance the 
 * blocks between the memory banks.

 * The reallocation routine operates in cycles. In each cycle, it finds the 
 * memory bank with the most blocks (ties won by the lowest-numbered memory 
 * bank) and redistributes those blocks among the banks. To do this, it removes 
 * all of the blocks from the selected bank, then moves to the next (by index) 
 * memory bank and inserts one of the blocks. It continues doing this until it 
 * runs out of blocks; if it reaches the last memory bank, it wraps around to 
 * the first one.
 * 
 * Same thing as part one, but how many times until you see the same sequence again?
 */


$test_cases = array(
  '0  2 7 0' => 4,
);

foreach ($test_cases as $input => $answer) {
  $result = solve($input);
  if ($result !== $answer) {
    exit('Failed test case ' . $input . ', expected ' . $answer . ', got ' . $result);
  }
}

echo solve(file_get_contents('../input.txt'));

//////////////////
//  Solution
//////////////////

function solve(string $input) : int {
  preg_match_all('/\d+/', $input, $matches);
  $banks = $matches[0];

  $len = count($banks);

  // loop in cycles, find bank w most blocks. lower index wins ties.
  $same_sequence_encounters = 0;
  $configurations_seen_before = array();
  $num_cycles = 0;
  while($num_cycles < 40000) {
    // find bank with the most blocks
    $most_blocks = 0;
    $index_of_most_blocks = 0;
    for ($i = 0 ; $i < $len ; $i++) {
      if ($banks[$i] > $most_blocks) {
        $index_of_most_blocks = $i;
        $most_blocks = $banks[$i];
      }
    }

    // remove all blocks from the index of most blocks
    $blocks_to_redistribute = $banks[$index_of_most_blocks];
    $banks[$index_of_most_blocks] = 0;

    // redistribute one at a time from then on (wrap around)
    for ($i = ($index_of_most_blocks + 1) % $len ; $i < $len + $i ; $i++) {
      if ($blocks_to_redistribute > 0) {
        $banks[$i % $len]++;
        $blocks_to_redistribute--;
      }
      else {
        break;
      }
    }

    // only count after we've seen the combo once
    if ($same_sequence_encounters > 0) {
      $num_cycles++;    
    }

    // have we seen this combination?
    if (in_array($banks, $configurations_seen_before, true)) {
      // start counting for real
      if ($same_sequence_encounters == 0) {
        $same_sequence_encounters++;

        // dump the memory
        $configurations_seen_before = array();
      }
      else { // we found it
        return $num_cycles;
      }
    }

    // if not, remember it.
    $configurations_seen_before[] = $banks;
  }

  throw new Exception('Failed to reach answer.');
}