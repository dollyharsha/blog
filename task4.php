<?php

function sortanarray(&$a, $arr_size)
{
	$first = 0;
	$second = 0;
	$third = $arr_size - 1;

	while ($second <= $third)
	{
		switch ($a[$second])
		{
	
		case 0:
			swap($a[$first++], $a[$second++]);
			break;
		
		case 1:
			$second++;
			break;
		
		case 2:
			swap($a[$second], $a[$third--]);
			break;
		}
	}
}

function swap(&$a, &$b)
{
	$temp = $a;
	$a = $b;
	$b = $temp;
}

function printArray(&$forsort_array, $arrycount)
{
	for ($i = 0; $i < $arrycount; $i++)
		echo $forsort_array[$i]." ";
	echo "\n";
}

$forsort_array = array(0, 1, 1, 0, 1, 2,
			1, 2, 0, 0, 0, 1);


// $forsort_array=array(0, 1, 2, 0, 1, 2);


$arrycount = sizeof($forsort_array);

sortanarray($forsort_array, $arrycount);

printArray($forsort_array, $arrycount);

?>
