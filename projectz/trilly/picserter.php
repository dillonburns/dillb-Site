<?php
if(isset($_POST['image']) && isset($_POST['caption'])){
		
	$con = mysql_connect("localhost","admin_admin","password123");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	
	mysql_select_db("admin_db", $con);
	
	$sql="INSERT INTO trilly (IMAGE, CAPTION, TSTAMP) VALUES ('$_POST[image]','$_POST[caption]','$_POST[tstamp]')";
	
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }
	
	//echo '<h3 style="text-align:center; line-height:10em; id="stop looking at my source code" >one pic added</h3></br>';
	
	mysql_close($con);
}
else
{
	//echo '<h3 style="text-align:center; line-height:10em; id="stop looking at my source code" >nice try, thief</h3></br>';
}

//word

?>