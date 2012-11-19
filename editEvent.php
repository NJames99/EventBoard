<!DOCTYPE html>
<html>
	<head>
		<title>Calendar of Events</title>
	</head>
	<body>
		<h2>Edit Event</h2>
		<form id="editEvent" method="post" action="doEdit.php">
			<?php
			$whichEvent = $_GET[number];
			echo "<input type='hidden' name='number' value='$whichEvent'/>";

			$eventSeparator = "////EVENT SEPARATOR////";
			$itemSeparator = "////ITEM SEPARATOR////";

			//get existing events from file
			$fileName = "calendar.txt";
			$fileHandle = fopen($fileName, 'r') or die("can't open file to read");
			$previousData = fread($fileHandle, filesize($fileName));
			fclose($fileHandle);
			$previousEvents = explode($eventSeparator, $previousData);
			$numberOfPreviousEvents = $previousEvents[0];

			$eventToEdit =  explode($itemSeparator, $previousEvents[$whichEvent]);
			$title       =  $eventToEdit[0];
			$location    =  $eventToEdit[1];
			$contact     =  $eventToEdit[2];
			$startdate   =  $eventToEdit[3];
			$enddate    =  $eventToEdit[4];
			$description =  $eventToEdit[5];
			
			echo "Event title:<input type='text' size=100 id='title' name='title' value='$title' /><br/>";
			echo "Event location:<input type='text' size=96 id='location' name='location' value='$location' /><br/>";
			echo "contact: <input type='text' id='contact' name='contact' value='$contact' /><br/>";
			echo "start date:<input type='date' id='startdate' name='startdate' value='$startdate'/> <br/>";
			echo "end date: <input type='date' id='enddate' name='enddate' value='$enddate'/><br/>";
			echo "Description:<br/><textarea name='description' cols=80 rows=10 placeholder='Enter a description of your event'>$description</textarea>";
			?>
			<input type="submit" id="accept" name="accept" value="Accept" />
			<input type="button" id="cancel" name="cancel" value="Cancel edit" onclick="" />
			<input type="button" id="delete" name="delete" value="Delete event" onclick="" />
		</form>
		<script>
			//todo: cancel and delete events
		</script>
	</body>
</html>
