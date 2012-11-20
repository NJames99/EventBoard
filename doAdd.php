<html>
<head>
</head>
<body>
<?php
//get new event values from POST
$title       =  $_POST['title'];
$location    =  $_POST['location'];
$contact     =  $_POST['contact'];
$startdate   =  $_POST['startdate'];
$enddate     =  $_POST['enddate'];
$description =  $_POST['description'];

$eventSeparator = "////EVENT SEPARATOR////";
$itemSeparator = "////ITEM SEPARATOR////";
$lineSeparator = "////LINE SEPARATOR////";
$newEvent = $title.$itemSeparator.$location.$itemSeparator.$contact.$itemSeparator.$startdate.$itemSeparator.$enddate.$itemSeparator.$description;
$newEvent = htmlspecialchars($newEvent, ENT_QUOTES); //deal with special characters like ' or \ or " in the text
$newEvent = str_replace("\\", "", $newEvent); //strip all backslash characters
// -- TODO: what happens if I reverse the order of these two lines?^
 
//get existing events from file
$fileName = "calendar.txt";
$fileHandle = fopen($fileName, 'r') or die("can't open file to read");
$previousData = fread($fileHandle, filesize($fileName));
fclose($fileHandle);
$previousEvents = explode($eventSeparator, $previousData);

//write new version of events file
$fileHandle = fopen($fileName, 'w') or die("can't open file to write");
$newVersion = $previousData.$eventSeparator.$newEvent;
fwrite($fileHandle, $newVersion);
fclose($fileHandle);

echo "event added!";

?>
<script>
	window.location.assign("http://cffm-events.awardspace.biz/calendar.php");
</script>
</body>
</html>
