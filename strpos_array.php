<?php
function strposa($haystack, $needles=array(), $offset=0) {
	$chr = array();
	foreach($needles as $needle) {
		$res = strpos($haystack, $needle, $offset);
		if ($res !== false) $chr[$needle] = $res;
	}
	if(empty($chr)) return false;
	return min($chr);
}

// How to use
$string = 'Whis string contains word "cheese" and "tea".';
$array  = array('burger', 'melon', 'cheese', 'milk');

if (strposa($string, $array, 1)) {
	echo 'true';
} else {
	echo 'false';
}

echo '<hr>';

// ปรับปรุง: รหัสที่ดีขึ้นกับการหยุดเมื่อแรกของเข็มที่พบ:
echo 'Update: Improved code with stop when the first of the needles is found:';
echo '<br>';

function strposa_new($haystack, $needle, $offset=0) {
	if(!is_array($needle)) $needle = array($needle);
	foreach($needle as $query) {
		if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	}
	return false;
}
$string = 'Whis string contains word "cheese" and "tea".';
$array  = array('burger', 'melon', 'cheese', 'milk');
// var_dump(strposa_new($string, $array)); // will return true, since "cheese" has been found
if (strposa_new($string, $array)) {
	echo 'true';
} else {
	echo 'false';
}