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
  $result = solve($input);
  if ($result !== $answer) {
    exit('Failed case ' . $input 
      . '. Result was '. $result . ', should be ' . $answer);
  }
}

echo solve(file_get_contents('../input.txt'));

////////////////////
//  Solution
////////////////////

function solve(string $input) : bool {
  $lines = explode("\n", $input);

  foreach ($lines as $line) {
    // collect words 
    $words = explode(' ', $line);

    foreach ($words as $comparison_word) {
      $occurences = 0;
      foreach ($words as $word) {
        if ($word === $comparison_word) {
          $occurences++;

          if ($occurences > 1) {
            
          }
        }
      }
    }
  }
}

function is_valid(string $passphrase) : bool {

}