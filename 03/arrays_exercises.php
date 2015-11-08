<?php

// -----------------------------------
//           CREATE ARRAY - ASSOCIATED
// -----------------------------------

# array is construct rather than method
$prices = array ('Tires' => 100, 'oil' => 10, 'spark plugs' => 4);


// -----------------------------------
//           TRAVERSE
// -----------------------------------


// we can use the foreach construct
foreach ($prices as $key => $value) { 
	echo $key . " - " .$value . "<br />";
}

// or we can use the while - each construct

// -- very important, we need to rest the array before next access
reset($prices);
while ($element = each($prices)) { 
	echo  $element['key'];
	echo " - ";
	echo $element['value'];
	echo '<br />';
}


// -- while, each and list construct 
reset($prices);
while (list($product, $price) = each($prices)) { 
	echo "$product - $price";
}

echo "\n";

// multiple dimention array
$products = array( array('TIR', 'Tires', 100),
	array('OIL', 'oil', 10),
	array('SPK', 'Spark Plugs', 4));

for ($row=0; $row < 3; $row++) { 
	for ($column=0; $column < 3; $column++) { 
		echo '| ' . $products[$row][$column];
	}
}

echo '|<br />';
echo "\n ";

// -----------------------------------
//           MULTI-DIMENSION ARRAY
// -----------------------------------
// multiple association array 
$products = array( array('Code' => 'TIR',  'Description' => 'Tires', 'Price' => 100),
	array('Code' => 'OIL',  'Description' => 'Oil', 'Price' => 10),
	array('Code' => 'SPK',  'Description' => 'Spark Plugs', 'Price' => 4));

for ($row=0; $row < 3; $row++) { 
	echo '| ' . $products[$row]['Code'] . '| ' . $products[$row]['Description'] . '| ' . $products[$row]['Price'];
}
echo '|<br />';
echo "\n ";

echo "ending....";
reset($products);
for ($row=0; $row < 3; $row++) { 
	while (list($key, $value) = each ($products[$row])) { 
		echo " |$value";
	}
}

echo '|<br />';
echo "\n "; 

// -----------------------------------
//                  SORT
// -----------------------------------


$prices = array(100, 10, 4);
sort($prices); // the same as sort($prices, SORT_REGULAR|SORT_NUMERIC|SORT_STRING);
foreach ($prices as $price) { 
	echo $price;
}

echo "\n";

$prices = array ('Tires' => 100, 'Oil' => 10, 'Spark Plugs' => 4);


// asort sort by the value
asort($prices);

foreach ($prices as $product => $price) { 
	echo $product . " | " .$price . ';';
}
echo "\n";

// ksort sort by the key
ksort($prices);

foreach ($prices as $product => $price) { 
	echo $product . " | " .$price . ';';
}
echo "\n";


// -----------------------------------
//               USER DEFINED SORT
// -----------------------------------
$products = array (array ('TIR', 'Tires', 100),
	array ('OIL', 'Oil', 10),
	array ('SPK', 'Spark Plugs', 4)	);

function compare($x, $y) {
	if ($x[1] < $y[1])  {
		return 0;
	} else if ($x[1] < $y[1]) { // we can use else if - elseif 
		return -1;
	} else {
		return 1;
	}
}

usort($products, 'compare');

for ($i = 0; $i < count($products); $i++) {
	for ($j = 0; $j < count($products[$i]); $j++) {
		echo $products[$i][$j] . ' |';
	}

	echo "\n";
}


function compare1($x, $y) { 
	if ($x[2] == $y[2])  { 
		return 0;
	} elseif ($x[2] < $y[2]) { 
		return -1;
	} else {
		return 1;
	}
}

usort($products, 'compare1'); // the took has '$compare1' which I put into console, incorrect!

for ($i = 0; $i < count($products); $i++) {
	for ($j = 0; $j < count($products[$i]); $j++) {
		echo $products[$i][$j] . ' |';
	}

	echo "\n";
}

// -----------------------------------
//               REVERSE, RANGE, 
// -----------------------------------
$numbers = array();

for ($i = 10; $i > 0; $i--) { 
	array_push($numbers, $i);
}


for ($i = 0; $i < count($numbers); $i++) { 
	echo $i . " ";
}
echo "\n";


$numbers = range(1, 10);
$numbers = array_reverse($numbers);

$numbers = range(10, 1, -1);


// -----------------------------------
//               OTHER OPERATIONS
// -----------------------------------


// - reverse traverse an array  - prev, current, end, next, pos, each, reset .. 
$value = end($numbers);
while ($value) { 
	echo "$value |";
	$value = prev($numbers);
}
echo "\n";

// - array walk
function my_print($value) {
	echo "$value |";
}

reset($numbers);

array_walk($numbers, 'my_print');
echo "\n";

function my_multiply(&$value, $key, $factor) {  // array_walk method signature is as my_function(&$value, $key, $userdata)
	$value *= $factor;
}

reset($numbers);
array_walk($numbers, 'my_multiply', 3); 

reset($numbers);
$value = current($numbers);
while ($value) {
	echo "$value |";
	$value = next($numbers);
}
echo "\n";

// -- count() and sizeof() are the same
echo "numbers of array is " . count($numbers) . "\n";
echo "numbers of array is " . sizeof($numbers) . "\n";


// -- array count values 
$array = array (4, 5, 1, 2, 3, 1, 2, 1);

$ac = array_count_values($array);
echo "----------------\n";
foreach ($ac as $key => $value) {
	echo "$key\t$value\n";
}

// -----------------------------------
//               EXTRACT
// -----------------------------------

// -- extract extract varaibles out of associated array 

$array = array( 'key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3');
extract($array);
echo "$key1 $key2 $key3\n";

extract($array, EXTR_PREFIX_ALL, 'my_prefix'); // default value is EXTR_OVERWRITE
echo "$my_prefix_key1 $my_prefix_key2 $my_prefix_key3\n";
?>