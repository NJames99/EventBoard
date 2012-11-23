<!DOCTYPE html>
<html style="background-color : rgb(245,245,230);">
	<head>
		<style type="text/css">
		
			h1 {
				display : inline;
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
			table { 
				border : 1px solid black;
				border-collapse : separate;
				border-spacing : .3em;
				background-color : rgb(250,255,245); 
				cell-padding : 0px;
				cell-spacing : 0px;
				margin : auto;
				max-width : 39em;
				min-width : 39em;
				position : relative;
				/* left : 30px; */
			}
			tr {
				margin : 0px;
			}
			td {
				margin : 0px;
				font-size : 120%;
				padding : 0px;
				text-align : left;
				position : relative;
				/*top : -5px;*/
			}
			th {
				margin : 0px;
				font-size : 80% ;
				text-align : right;
				position : relative;
				max-width : 30 em;
				/* top : -5px; */
			}
			ul { 
				display : inline;
				font-size : 90%;
				position : relative;
			}
			li {
				/* display : inline; */
				position : relative;
				left : - 10px;
			}
			input.edit {
				position : relative;
				/* top : -1.8em; */
				left : 40em;
			}
		</style>
		<title>EventBoard</title>
	</head>
	<body>
		<?php
			$offset = $_GET[offset];
			$show = $_GET[show];
			$sorttype = $_GET[sorttype];
			if (!is_numeric($show)) $show = 20;
			if ($sorttype!="p" && $sorttype!="d") $sorttype = "d";
			if (!is_numeric($offset)) $offset = 0;
			echo '
				<form id="calendar" method="get" action="calendar.php">
					<h1>EventBoard</h1>
					<input type="hidden" name="number" value="" />
					<input type="hidden" name="sorttype" value="'.$sorttype.'" />
					skip:<input type="text" name="offset" value="'.$offset.'" size="1" />
					show:<input type="text" name="show" value="'.$show.'" size="1" />
					<input type="submit" value="show events" />
					<br/><br/>
					<input type="button" name="add" value="Add event" onclick="addEvent()" />
				';
	

			if($sorttype=="p") {
				echo '<input type="button" name="sortByStart" value="Sort by date" onclick="dateSort()" />';
				echo '<input type="button" name="sortByPost" value="Recently edited" onclick="postSort()" disabled/>';
			}
			if($sorttype=="d") {
				echo '<input type="button" name="sortByStart" value="Sort by date" onclick="dateSort()" disabled />';
				echo '<input type="button" name="sortByPost" value="Recently edited" onclick="postSort()" />';
			}
			echo "<br/><br/>";
			
				$dbH = sqlite_open('myDatabase.sqlite');
				//$q = 	'CREATE TABLE events(id INTEGER PRIMARY KEY, Title TEXT, Location TEXT, Contact TEXT, Startdate TEXT, Enddate TEXT, Description TEXT)';
				//$query = sqlite_query($dbH, $q)														//LIMIT '.$show.'
				
				//$Rows = sqlite_query($dbH,'SELECT Count(*) FROM events');
				//echo $Rows["Count"]." -- ".$Rows;
				//																								 .--------this is a hack!
				//TODO: fix limit to always be high enough														/
				if($sorttype=="d") $query = sqlite_query($dbH, 'SELECT * FROM events ORDER BY Startdate LIMIT 10000 OFFSET '.$offset);
				if($sorttype=="p") $query = sqlite_query($dbH, 'SELECT * FROM events ORDER BY Editdate DESC LIMIT 10000 OFFSET '.$offset);
				$count=0;
				while ($row = sqlite_fetch_array($query, SQLITE_ASSOC)) {
					$count=$count+1;
					//$row = sqlite_fetch_array($query, SQLITE_ASSOC);
					//echo 'Title: ' . $row['Title'] . '  start: ' . $row['Startdate']."<br/>";
					echo "<table><tr><th>Title:</th><td> <strong>{$row['Title']}</strong></td></tr>";
					echo "<tr><th>Location: </th><td> {$row['Location']}</tr>";
					echo "<tr><th>Contact:</th><td> {$row['Contact']}</tr>";
					echo "<tr><th>Dates:</th><td> ".date("M j, Y", strtotime($row['Startdate']))." - to - ".date('M j, Y', strtotime($row['Enddate']))."</td></tr>";
					$description = explode(chr(13), $row['Description']);
					echo "<tr><td></td><td>";
					$lineCount = 0;
					foreach($description as $descLine) {
						if($lineCount++ >0) echo "<br/>";
						if($descLine != "") echo "$descLine";
					}
					//echo "</tr><tr><th>".$row['Tags']."</th></tr></table>";
					echo "</tr></table>";
					echo "<input type='button' class='edit' name='edit$event' value='edit' onclick='clickEdit(".$row['id'].")'>";
					//echo "<br/><br/>";
					echo $row['Tags']."<hr><br/>";
					if($count>=$show) break;
				}
				
				if(sqlite_has_more($query)) {
					echo "<br/><input type='button' class='more' value='More...' onclick='getMore()' />";
				}
				else {
						echo "<br/>That's it for now!";
				}
					
				
				echo '
						<br/>
						<br/>
						<br/>
						</form>
					';
			?>


		<script>
			clickEdit = function(whichButton) {
				calendar.number.value = whichButton;
				calendar.action = "editEvent.php";
				calendar.submit();
				return false;
			}
			
			addEvent = function() {
				window.location.assign("addEvent.php");
				return false;
			}
			
			dateSort = function() {
				calendar.sorttype.value = "d";
				calendar.action = "calendar.php";
				calendar.submit();
				return false;
			}
			
			postSort = function() {
				calendar.sorttype.value = "p";
				calendar.action = "calendar.php";
				calendar.submit();
				return false;
			}
			
			getMore = function() {
				calendar.offset.value = Number(calendar.offset.value) + Number(calendar.show.value);
				calendar.action = "calendar.php";
				calendar.submit();
				return false;
			}
		</script>
	</body>
</html>
