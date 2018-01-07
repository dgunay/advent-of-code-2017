<?php


/**
 * A group is enclosed with {}
 * 
 * Within them, are 0 or more comma-separated things:
 * - another group
 * - or garbage. 
 * 
 * Garbage is enclosed by <>.
 * Within garbage, {} can appear, and < has no meaning.
 * 
 * Any character after !, even another !, is ignored.
 * 
 * Each group gets 1 point for its depth. The first group is 1. 
 * 
 * Count all the chars in the garbage, except for <>, cancelled chars, or !
 */


echo solve(fopen('../input.txt', 'r'));


function solve($stream) : int {
  $score = 0;
  $depth = 0;
  $chars_in_garbage = 0;

  $prev_char = null;
  $in_garbage = false;
	while (($char = fgetc($stream)) !== false) {
    // is this character to be ignored?
    if ($prev_char === '!') {
      $prev_char = null;
      continue;
    }
    else {
      if (!$in_garbage) {
        if ($char == '<') {
          $in_garbage = true;
        }
      }
      elseif ($char === '>') {
        $in_garbage = false;
      }
      else {
        if ($char !== '!') {
          $chars_in_garbage++;
        }
      }

      $prev_char = $char;
    }
  }

  return $chars_in_garbage;
}