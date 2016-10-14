<?php
function convertToParas($text) {
  $text = trim($text);
  return '<p>' . preg_replace('/[\r\n]+/', '</p><p>', $text) . '</p>';
}
function getFirst($text, $number=2) {
  // use regex to split into sentences
  $sentences = preg_split('/([.?!]["\']?\s)/', $text, $number+1, PREG_SPLIT_DELIM_CAPTURE);
  if (count($sentences) > $number * 2) {
    $remainder = array_pop($sentences);
  } else {
	$remainder = '';
  }
  $result = array();
  $result[0] = implode('', $sentences);
  $result[1] = $remainder;
  return $result;
}
function convertDateToMySQL($month, $day, $year) {
  $month = trim($month);
  $day = trim($day);
  $year = trim($year);
  $result[0] = false;
  if (empty($month) || empty($day) || empty($year)) {
	$result[1] = 'Please fill in all fields';
  } elseif (!is_numeric($month) || !is_numeric($day) || !is_numeric($year)) {
    $result[1] = 'Please use numbers only';
  } elseif (($month < 1 || $month > 12) || ($day < 1 || $day > 31) || ($year < 1000 || $year > 9999)) {
	$result[1] = 'Please use numbers within the correct range';
  } elseif (!checkdate($month,$day,$year)) {
    $result[1] = 'You have used an invalid date';
  } else {
    $result[0] = true;
    $result[1] = "$year-$month-$day";
  }
  return $result;
}