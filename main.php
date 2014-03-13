<?php
require_once("varlist.php");

system("clear");

echo "1) Array functions (" . count($arraylist) . ")\n";
echo "2) String functions (" . count($stringlist) . ")\n";
echo "3) Both functions (" . (count($arraylist)+count($stringlist)) . ")\n";
echo "4) Preg_* functions (" . count($preglist) . ")\n";
echo "5) File functions (" . count($filelist) . ")\n";
echo "6) Stream functions (" . count($streamlist) . ")\n";
echo "7) Session functions (" . count($sessionlist) . ")\n";
echo "8) HTTP Status Code basic (" . count($httpcodes) . ")\n";
echo "9) PDO functions (" . count($pdolist) . ")\n";
echo "10) PDOStatement functions (" . count($pdostmnlist) . ")\n";
echo "11) SimpleXML functions (" . count($simplexmllist) . ")\n";
echo "\nEnter your option: ";
$option = trim(fgets(STDIN));

switch ($option) {
	case 1:
		$varlist = $arraylist;
		break;
	case 2:
		$varlist = $stringlist;
		break;
	case 3:
		$varlist = array_merge($arraylist, $stringlist);
		break;
	case 4:
		$varlist = $preglist;
		break;
	case 5:
		$varlist = $filelist;
		break;
	case 6:
		$varlist = $streamlist;
		break;
	case 7:
		$varlist = $sessionlist;
		break;
	case 8:
		$varlist = $httpcodes;
		break;
	case 9:
		$varlist = $pdolist;
		break;
	case 10:
		$varlist = $pdostmnlist;
		break;
	case 11:
		$varlist = $simplexmllist;
		break;
	default:
		exit;
}

$functions = array();
$i = 0;

foreach ($varlist as $key => $value) {
	$functions[$i++] = array($key => $value);
}

shuffle($functions);

$errors = true;

while ($errors) {
	$errors = test($functions);
}



function test(&$functions) {

	$ok = array();
	$fail = array();

	for ($i=0; $i<count($functions); $i++) {
		echo $i+1 . ") " . current($functions[$i]), ": ";
		$response = trim(fgets(STDIN));

		if (strtoupper($response) == strtoupper(key($functions[$i]))) {
			array_push($ok, array($response, current($functions[$i])));
		} else {
			array_push($fail, array($response, current($functions[$i]), key($functions[$i])));
		}
	}

	$total = count($ok)+count($fail);

	echo "\n\n";
	echo "#################################\n";
	echo "Total questions: $total\nRight questions: " . count($ok) . "\n";
	echo "Failed questions: " . count($fail) . "\n";
	echo "Hit rate: " . round(count($ok)/$total*100,2) . "%\n";
	echo "#################################\n\n";

	if (count($fail) > 0) {
		echo "Failures summary:\n";
		echo "Response                 Function                 Description\n";
		echo "------------------------ ------------------------ ----------------------------------------------------------------------------------\n";
		foreach ($fail as $result) {
			echo str_pad($result[0], 25) . 	str_pad($result[2], 25) . $result[1] . "\n"; 
		}
		echo "\nPress any key to do it again...";
		trim(fgets(STDIN));
		system("clear");
	}

	echo "\n";

	$functions = null;
	$i=0;
	foreach ($fail as $value) {
		$functions[$i++] = array($value[2] => $value[1]);
	}
	if (count($functions) > 0) {
		shuffle($functions);
	}

	return count($fail);

}

?>