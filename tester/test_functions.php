<?php

function run_tests(array $test_cases, callable $solution) {
  foreach ($test_cases as $input => $answer) {
    $result = call_user_func($solution, $input);
    if ($result !== $answer) {
      $msg = "Case {$input} failed (expected {$solution}, got {$result}";
      throw new Exception($msg);
    }
  }
}