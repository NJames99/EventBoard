<!DOCTYPE html>
<html>
	<head>
		<title>Calendar of Events</title>
		<h3>Calendar of Events</h3>
	</head>
	<body>
		<form id="calendar" method="get" action="editEvent.php">
			<input type="hidden" name="number" value="no value yet" />
			<?php
			//get existing events from file
			$fileName = "calendar.txt";
			$fileHandle = fopen($fileName, 'r') or die("can't open file");
			$previousData = fread($fileHandle, filesize($fileName));
			//echo $previousData; echo "<br/>";
			fclose($fileHandle);

			//split into events
			$previousEvents = explode("////EVENT SEPARATOR////", $previousData);
			$numberOfPreviousEvents = $previousEvents[0];
			for($event=1; $event <= $numberOfPreviousEvents; $event += 1){
				$eventInfo = explode("////ITEM SEPARATOR////", $previousEvents[$event]);
				echo "<input type='button' name='edit$event' value='edit' onclick='clickEdit($event)'>";
				echo "<table border=1><tr><th colspan=2>$eventInfo[0]</th></tr>";
				echo "<tr><td>Location:</td><td>$eventInfo[1]</td></tr>";
				echo "<tr><td>Contact:</td><td>$eventInfo[2]</td></tr>";
				echo "<tr><td>Starts on:</td><td>$eventInfo[3]</td></tr>";
				echo "<tr><td>Ends on:</td><td>$eventInfo[4]</td></tr>";
				echo "</table>";
				$desc = explode(chr(13), $eventInfo[5]);
				foreach ($desc as $line){
					echo "...$line<br/>";
				}
				
				echo "<br/><br/>";
			}

			?>
		</form>
		<script>
			clickEdit = function(whichButton) {
				calendar.number.value = whichButton;
				calendar.submit();
				return false;
			}
		</script>
		<p>That's it for now!</p>
	</body>
</html>
