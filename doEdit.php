<html>
<head>
</head>
<body>
<?php
//get new event values from POST
$whichEvent  =  $_POST['number'];
$title       =  $_POST['title'];
$location    =  $_POST['location'];
$contact     =  $_POST['contact'];
$startdate   =  $_POST['startdate'];
$enddate     =  $_POST['enddate'];
$description =  $_POST['description'];

$eventSeparator = "////EVENT SEPARATOR////";
$itemSeparator = "////ITEM SEPARATOR////";
$lineSeparator = "////LINE SEPARATOR////";
$changedEvent = $title.$itemSeparator.$location.$itemSeparator.$contact.$itemSeparator.$startdate.$itemSeparator.$enddate.$itemSeparator.$description;

//get existing events from file
$fileName = "calendar.txt";
$fileHandle = fopen($fileName, 'r') or die("can't open file to read");
$previousData = fread($fileHandle, filesize($fileName));
fclose($fileHandle);
$events = explode($eventSeparator, $previousData);
$numberOfEvents = $Events[0];

$events[$whichEvent] = $changedEvent;
$newVersion = implode($eventSeparator, $events);

//write new version of events file
$fileHandle = fopen($fileName, 'w') or die("can't open file to write");
fwrite($fileHandle, $newVersion);
fclose($fileHandle);

echo "event edited!";

?>
<script>
	window.location.assign("http://cffm-events.awardspace.biz/calendar.php");
</script>
</body>
</html>
