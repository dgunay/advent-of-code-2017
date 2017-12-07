<?php

require_once('../../tester/test_functions.php');

/**
 * For added security, yet another system policy has been put in place. Now, a 
 * valid passphrase must contain no two words that are anagrams of each other - 
 * that is, a passphrase is invalid if any word's letters can be rearranged to 
 * form any other word in the passphrase.
 * 
 * For example:
 * 
 * abcde fghij is a valid passphrase.
 * abcde xyz ecdab is not valid - the letters from the third word can be 
 * rearranged to form the first word.
 * a ab abc abd abf abj is a valid passphrase, because all letters need to be 
 * used when forming another word.
 * iiii oiii ooii oooi oooo is valid.
 * oiii ioii iioi iiio is not valid - any of these words can be rearranged to 
 * form any other word.
 * 
 * Under this new system policy, how many passphrases are valid?
 */


$test_cases = array(
  'abcde fghij'               => true,
  'abcde xyz ecdab'           => false,
  'a ab abc abd abf abj'      => true,
  'iiii oiii ooii oooi oooo'  => true,
  'oiii ioii iioi iiio'       => false,
);

// var_dump(is_anagram('lbdal', 'ball'));
// exit;
// run_tests($test_cases, 'contains_anagrams');

foreach ($test_cases as $input => $answer) {
  $result = !contains_anagrams($input);
  if ($result !== $answer) {
    echo "Case {$input} failed (expected {$answer}, got {$result})";
    exit;
  }
}


echo solve(file_get_contents('../input.txt'));

//////////////////
//  Solution
//////////////////

function solve(string $input) : int {
  $lines = explode("\n", $input);

  $valid = 0;
  foreach ($lines as $line) {
    if (!contains_anagrams($line)) {
      $valid++;
    }
  }

  return $valid;
}

function contains_anagrams(string $line) : bool {
  $words = explode(' ', trim($line));

  for ($i = 0 ; $i < count($words) ; $i++) {
    for ($j = 0; $j < count($words); $j++) {
      if ($j !== $i) {
        if (is_anagram($words[$i], $words[$j])) {
          return true;
        }
      }
    }
  }

  return false;
}

function is_anagram(string $a, string $b) : bool {
  return (count_chars(trim($a), 1) == count_chars(trim($b), 1));
}