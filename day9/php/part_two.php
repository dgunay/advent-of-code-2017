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
 * What's the total score?
 */


echo solve(fopen('../input.txt', 'r'));


function solve($stream) : int {
  $score = 0;
  $depth = 0;

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
        // is it an opener to anything?
        if ($char == '{') {
          $depth++;
          $score += $depth;
        }
        elseif ($char == '}') {
          $depth--;
        }
        elseif ($char == '<') {
          $in_garbage = true;
        }
      }
      elseif ($char === '>') {
        $in_garbage = false;
      }

      $prev_char = $char;
    }
  }

  return $score;
}