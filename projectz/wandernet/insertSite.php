<?php
// Opens a connection to a MySQL server
$connection=mysql_connect (localhost, 'admin_dillon','dillon');
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db('admin_school', $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}


// escape variables for security
$siteName = mysql_real_escape_string($_POST['siteName']);
$siteContents = mysql_real_escape_string($_POST['siteContents']);
$lat = mysql_real_escape_string($_POST['lat']);
$long = mysql_real_escape_string($_POST['long']);
$dLevel = mysql_real_escape_string($_POST['dangerLevel']);

$sql="INSERT INTO `admin_school`.`fsites` (`siteID`, `siteName`, `siteContents`, `lat`, `long`, `dangerLevel`) VALUES (NULL,'$siteName', '$siteContents', '$lat','$long','$dLevel')";

if (!mysql_query($sql,$connection))
	  {
	  die('Error: ' . mysql_error());
	  }
		
	mysql_close($connection);
	
	printf("<script>location.href='index.php'</script>");
?>