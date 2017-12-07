<?php


/**
 * A new system policy has been put in place that requires all accounts to use a 
 * passphrase instead of simply a password. A passphrase consists of a series of 
 * words (lowercase letters) separated by spaces.
 * 
 * To ensure security, a valid passphrase must contain no duplicate words.
 * 
 * For example:
 * 
 * aa bb cc dd ee is valid.
 * aa bb cc dd aa is not valid - the word aa appears more than once.
 * aa bb cc dd aaa is valid - aa and aaa count as different words.
 * 
 * The system's full passphrase list is available as your puzzle input. How many 
 * passphrases are valid?
 */

$test_cases = array(
  'aa bb cc dd ee' => true,
  'aa bb cc dd aa' => false,
  'aa bb cc dd aaa' => true,
);

foreach ($test_cases as $input => $answer) {
  $result = is_valid($input);
  if ($result !== $answer) {
    exit('Failed case ' . $input 
      . '. Result was '. $result . ', should be ' . $answer);
  }
}

echo solve(file_get_contents('../input.txt'));


////////////////////
//  Solution
////////////////////

function solve(string $input) : int {
  $lines = explode("\n", $input);

  $valid_passphrases = 0;
  foreach ($lines as $line) {
    $words = explode(' ', trim($line));
    if (count($words) == count(array_unique($words))) {
      $valid_passphrases++;
    }
  }

  return $valid_passphrases;
}

function is_valid(string $passphrase) : bool {
  // collect words 
  $words = explode(' ', $passphrase);

  $counts = array();
  foreach ($words as $word) {
    if (!array_key_exists($word, $counts)) {
      $counts[$word] = 1;
    }
    else {
      return false;
    }    
  }

  return true;
}