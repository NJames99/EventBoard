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
			textarea {
				max-width : 39em;
				min-width : 39em;
			}
		</style>
		<title>Add Event</title>
	</head>
	<body>
		<h2>Add a New Event</h2>
		<form id="addEvent" method="post" action="doAdd.php">
			Event title:<input type="text" size=80 id="title" name="title" onchange="checkReady()" autofocus="autofocus"/>
			<br/>
			Event location:<input type="text" size=80 id="location" name="location" onchange="checkReady()"/>
			<br/>
			contact: <input type="text" size=80 id="contact" name="contact" onchange="checkReady()"/>
			<br/>
			start date:<input type="date" id="startdate" name="startdate" onchange="setStartDate(this.value)"/>
			end date: <input type="date" id="enddate" name="enddate" />
			<br/>
			Description:
			<br/>
			<textarea name="description" cols=70 rows=10 onchange="checkReady()" placeholder="Enter a description of your event"></textarea>
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
			<input type="submit" id="Add event" name="accept" value="Accept" disabled />
		</form>

		<script type="text/javascript">
			setStartDate = function(startDate) {
				if(addEvent.enddate.value == "") addEvent.enddate.value = addEvent.startdate.value;
				checkReady();
				return false;
			}

			checkReady = function() {
				console.log(addEvent.description.value);
				if( (addEvent.title.value != "") && (addEvent.location.value != "") && (addEvent.startdate.value != "") ) {
					addEvent.accept.disabled=false;
				}
				return false;
			}	
		</script>
		<!--[if IE]>
			<script type="text/javascript">
				//IE is lame -- just for the record
				addEvent.accept.disabled=false;
			</script>
		<![endif]-->
	</body>
</html>
