<!DOCTYPE html>
<html>
<head>
<title>Calendar of Events</title>
</head>
<body>
	<h2>Add a New Event</h2>
	<form id="addEvent" method="post" action="addEvent.php">
		Event title:<input type="text" size=100 id="title" name="title" onchange="checkReady()" autofocus="autofocus"/>
		<br/>
		Event location:<input type="text" size=96 id="location" name="location" onchange="checkReady()"/>
		<br/>
		contact: <input type="text" id="contact" name="contact" onchange="checkReady()"/>
		<br/>
		start date:<input type="date" id="startdate" name="startdate" onchange="setStartDate(this.value)"/>
		end date: <input type="date" id="enddate" name="enddate" />
		<br/>
		Description:
		<br/>
		<textarea name="description" cols=80 rows=10 onchange="checkReady()" placeholder="Enter a description of your event"></textarea>
		<br/>
		<input type="submit" id="accept" name="accept" value="Accept" disabled="disabled"/>
	</form>

	<script>
		setStartDate = function(startDate) {
			if(addEvent.enddate.value == "") addEvent.enddate.value = addEvent.startdate.value;
			checkReady();
			return false;
		}

		checkReady = function() {
			if( (addEvent.title.value != "") && (addEvent.location.value != "") && (addEvent.startdate.value != "") ) {
				addEvent.accept.disabled=false;
			}
			return false;
		}	
		
		//todo: not currently using this... instead will submit form
		clickAccept = function() {
			window.location.assign("http://njames.awardspace.com")
			return false;
		}
	</script>
</body>
</html>
