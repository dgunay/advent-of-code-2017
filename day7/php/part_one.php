<?php

/**
 * Reconstruct the tree and then try and find the root.
 */


$test_cases = array();



echo solve(file_get_contents(__DIR__ . '/../input.txt'));

///////////////////
//  Solution
///////////////////

function solve(string $input) : string {
  $program_map = array();

  $lines = explode("\n", $input);
  foreach ($lines as $line) {
    $tokens = explode(' ', $line);
    $program_name = $tokens[0];
    $weight = str_replace(['(',')'], '', $tokens[1]);

    $program_map[$program_name] = array(
      'weight' => $weight,
      'links'  => array(),
    );

    if (isset($tokens[2])) {
      $program_map[$program_name]['links'] = array_map(
        function($val) {
          return str_replace(',', '', $val);
        },
        array_slice($tokens, 3)
      );
    }
  }

  foreach ($program_map as $program => $data) {
    foreach ($program_map as $compare_prog => $comp_data) {
      if ($program !== $compare_prog) {
        if (in_array($program, $comp_data['links'])) {
          continue 2;
        }
      }
    }

    return $program;
  }

  throw new Exception('Failed to find a program.');
}