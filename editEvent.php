<!DOCTYPE html>
<html style="background-color : rgb(245,245,230);">
	<head>
		<style>
			h2 {
				display: inline;
			}
			body {
				margin-top : 10em;
				margin-left : auto;
				margin-right : auto;
				max-width : 40em;
				min-width : 40em;
				align : left;
				border : 3px solid #886868;
				background-color : rgb(235,235,215); 
				padding : .3em;
			}
		</style>
		<title>Edit Event</title>
	</head>
	<body>
		<h2>Edit Event</h2>
		<form id="editEvent" method="post" action="doEdit.php">
			<?php
			$whichEvent = $_GET[number];

			echo "<input type='hidden' name='number' value='$whichEvent'/>";
			echo "<input type='hidden' name='del' value='no' />";

			$dbH = sqlite_open('myDatabase.sqlite');
			$query = sqlite_query($dbH, 'SELECT * FROM events WHERE id='.$whichEvent);
			$eventToEdit = sqlite_fetch_array($query, SQLITE_ASSOC);
			
			$title       =  $eventToEdit['Title'];
			$location    =  $eventToEdit['Location'];
			$contact     =  $eventToEdit['Contact'];
			$startdate   =  $eventToEdit['Startdate'];
			$enddate    =  $eventToEdit['Enddate'];
			$description =  $eventToEdit['Description'];
			
			echo 'Event title:<input type="text" size=80 id="title" name="title" value="'.$title.'" /><br/>';
			echo 'Event location:<input type="text" size=80 id="location" name="location" value="'.$location.'" /><br/>';
			echo 'contact: <input type="text" size=80 id="contact" name="contact" value="'.$contact.'" /><br/>';
			echo 'start date:<input type="date" id="startdate" name="startdate" value="'.$startdate.'"/> ';
			echo 'end date: <input type="date" id="enddate" name="enddate" value="'.$enddate.'"/><br/>';
			echo 'Description:<br/><textarea name="description" cols=70 rows=10 placeholder="Enter a description of your event">'.$description.'</textarea>';
			?>
			<br/>
			<select name="tags">
				<option value="#MidwestZone">      #MidwestZone       </option>
				<option value="#NorthAtlanticZone">#NorthAtlanticZone </option>
				<option value="#NorthCentralZone"> #NorthCentralZone  </option>
				<option value="#NorthwestZone">    #NorthwestZone     </option>
				<option value="#SoutheastZone">    #SoutheastZone     </option>
				<option value="#SouthCentralZone"> #SouthCentralZone  </option>
				<option value="#SouthwestZone">    #SouthwestZone     </option>
			</select>
			<input type="submit" id="accept" name="accept" value="Change event" />
			<input type="button" id="cancel" name="cancel" value="Cancel edit" onclick="cancelEdit()" />
			<input type="button" id="delete" name="delete" value="Delete event" onclick="deleteEvent()" />
		</form>
		<script>
			cancelEdit = function() {
				window.location.assign("calendar.php");
				return false;
			}
			
			deleteEvent = function() {
				var orly = confirm("Really? Delete the event?");
				if (orly == true) {
					editEvent.del.value="yes";
					editEvent.submit();
				}
				return false;
			}
		</script>
	</body>
</html>
