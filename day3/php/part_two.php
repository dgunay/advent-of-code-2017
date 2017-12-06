<?php
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


solve(2); exit;


///////////////
//  Solution
///////////////
function solve(int $input) : int {
	// I think I'll need to use a grid of some sort...
	// this kind of sucks, maybe I should use C++...
	$grid = array_fill(0, 30000, array_fill(0, 30000, 0));

	print_r($grid); exit;

}