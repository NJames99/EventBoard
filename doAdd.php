<html>
<head>
	<title>adding...</title>
</head>
<body>
<?php
//get new event values from POST
$_POST = str_replace("\\", "", $_POST);
$title       =  $_POST['title'];
$location    =  $_POST['location'];
$contact     =  $_POST['contact'];
$startdate   =  $_POST['startdate']; $startdate = date( "Y-m-d", strtotime($startdate));
$enddate     =  $_POST['enddate']; $enddate = date( "Y-m-d", strtotime($enddate));
$description =  $_POST['description'];
$tags		 =  $_POST['tags'];

try 
{
  //create or open the database
  $database = new SQLiteDatabase('myDatabase.sqlite', 0666, $error);
}
catch(Exception $e) 
{
  echo "died on open";
  die($error);
}


/*
$query = 'CREATE TABLE events ' .
         '(id INTEGER PRIMARY KEY, Title TEXT, Location TEXT, Contact TEXT, Startdate TEXT, Enddate TEXT, Description TEXT, Tags TEXT, Editdate TEXT)';
         
if(!$database->queryExec($query, $error))
{
  echo "died on add table <br/>";
  die($error);
} */

//insert data into database
$query = 
  'INSERT INTO events (Title, Location, Contact, Startdate, Enddate, Description, Tags, Editdate) ' .
  "VALUES ('".sqlite_escape_string($title)."', '".
		   sqlite_escape_string($location)."', '".
			sqlite_escape_string($contact)."', '".
			sqlite_escape_string($startdate)."', '".
			sqlite_escape_string($enddate)."', '".
			sqlite_escape_string($description)."', '".
			sqlite_escape_string($tags)."', '".
			sqlite_escape_string(strval(time()))."')";        
if(!$database->queryExec($query, $error))
{
  echo "<br/>died after insert<br/>";
  die($error);
}

?>
<script>
	window.location.assign("calendar.php?number=&sorttype=p");
</script>
</body>
</html>
