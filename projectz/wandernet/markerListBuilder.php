<?php

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

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

// Select all the rows in the markers table
$query = "SELECT * FROM fsites WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'siteID="' . parseToXML($row['siteID']) . '" ';
  echo 'siteName="' . parseToXML($row['siteName']) . '" ';
  echo 'siteContents="' . parseToXML($row['siteContents']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'long="' . $row['long'] . '" ';
  echo 'dangerLevel="' . $row['dangerLevel'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>