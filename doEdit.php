<html>
<head>
<title>"editing"</title>
</head>
<body>
<?php

	//get new event values from POST
	$_POST = str_replace("\\", "", $_POST);
	//$_POST = htmlspecialchars($_POST, ENT_QUOTES);
	//$_POST = sqlite_escape_string($_POST);
	$whichEvent  =  $_POST['number'];
	$title       =  htmlspecialchars(sqlite_escape_string($_POST['title']));
	$location    =  htmlspecialchars( sqlite_escape_string($_POST['location']) );
	$contact     =  htmlspecialchars( sqlite_escape_string($_POST['contact']) );
	$startdate   =  htmlspecialchars( sqlite_escape_string( $_POST['startdate']) ); $startdate = date( "Y-m-d", strtotime($startdate));
	$enddate     =  htmlspecialchars( sqlite_escape_string( $_POST['enddate']) ); $enddate = date( "Y-m-d", strtotime($enddate));
	$description =  htmlspecialchars( sqlite_escape_string( $_POST['description'] ) );
	$tags		 =  htmlspecialchars( sqlite_escape_string( $_POST['tags'] ) );
	
	//delete this event instead of editing it?
	if ($_POST['del'] == "yes") {
		echo "deleting...";
		$dbH = sqlite_open('myDatabase.sqlite');
		$query = sqlite_query($dbH, 'DELETE FROM events WHERE id='.$whichEvent);
	}
	else
	{
		$dbH = sqlite_open('myDatabase.sqlite');
		//echo sqlite_error_string(sqlite_last_error($dbH))."<br/>";
		$q = "UPDATE events SET".
		" Title='$title',". // Location = '$location' WHERE id=".$whichEvent;/*.
		" Location='$location',".
		" Contact='$contact',".
		" Startdate='$startdate',".
		" Enddate='$enddate',".
		" Description='$description',".
		" Tags='$tags',".
		" Editdate='".strval(time())."'".
		" WHERE id=".$whichEvent;
		//echo $q;
		$query = sqlite_query($dbH, $q);
		//echo sqlite_error_string(sqlite_last_error($dbH))."<br/>";
		// "SQL logic error or missing database" probably means you left out a comma between columns
	}
?>
<script>
	window.location.assign("calendar.php?number=&sorttype=p&offset=0&show=20");
</script>
</body>
</html>
