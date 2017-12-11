<?php

$day = $argv[1];

if (file_exists(__DIR__ . '/day' . $day)) {
  exit('Folder for day ' . $day . ' already exists.');
}

$path_to_day_folder = __DIR__ . '/day' . $day;
mkdir($path_to_day_folder);

mkdir("{$path_to_day_folder}/php");

touch("{$path_to_day_folder}/php/part_one.php");
touch("{$path_to_day_folder}/php/part_two.php");