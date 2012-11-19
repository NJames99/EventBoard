<!DOCTYPE html>
<html>
	<head>
		<title>Calendar of Events</title>
		<h3>Calendar of Events</h3>
	</head>
	<BODY background="http://www.cffm.org/images/background-stripes.gif" text=#333333 leftMargin=0 topMargin=20 marginwidth="20" marginheight="0" >

		<form id="calendar" method="get" action="editEvent.php">
			<input type="hidden" name="number" value="no value yet" />
			<input type="button" name="add" value="Add event" onclick="addEvent()" />
			<input type="button" name="sortByStart" value="Sort by start date" onclick="" disabled/>
			<input type="button" name="sortByPost" value="Sort by order of posting" onclick="" disabled/>
			<br/>
			<br/>
			<br/>
			<?php
			//get existing events from file
			$fileName = "calendar.txt";
			$fileHandle = fopen($fileName, 'r') or die("can't open file");
			$previousData = fread($fileHandle, filesize($fileName));
			fclose($fileHandle);

			//split into events
			$previousEvents = explode("////EVENT SEPARATOR////", $previousData);
			$event = 0;
			foreach($previousEvents as $eachEvent) {
				$eventInfo = explode("////ITEM SEPARATOR////", $eachEvent);
				echo "<b>$eventInfo[0]</b>";
				echo "<input type='button' name='edit$event' value='edit' onclick='clickEdit($event)'><br/>";
				$event=$event+1;
				$dates = date("M j, Y", strtotime($eventInfo[3]))." - to - ".date("M j, Y", strtotime($eventInfo[4]));
				echo "when: $dates";
				echo "where: $eventInfo[1]<br/>";
				echo "contact: $eventInfo[2]<br/>";
				//description as an unordered list
				$desc = explode(chr(13), $eventInfo[5]);
				echo "<ul>";
				foreach ($desc as $line){
					if($line != "") {
						echo "<li>$line</li>";
					}
				}	
				echo "</ul><br/>";
			}
			?>
			<br/>
			<br/>
			<br/>
		</form>
		<script>
			clickEdit = function(whichButton) {
				calendar.number.value = whichButton;
				calendar.submit();
				return false;
			}
			
			addEvent = function() {
				window.location.assign("http://cffm-events.awardspace.biz/addevent.html");
				return false;
			}
		</script>
		<p>That's it for now!</p>
	</body>
</html>
