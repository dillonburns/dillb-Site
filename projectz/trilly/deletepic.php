<?php
if(isset($_GET['id']) && ($_GET['pwd']=='nerp')){
		
	$con = mysql_connect("localhost","admin_admin","password123");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	
	mysql_select_db("admin_db", $con);
	
	$sql="UPDATE `trilly` SET `CAPTION` =  'private' WHERE `ID` ='$_GET[id]';";
	
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }
	echo 'Yup';
	mysql_close($con);
}
else{
echo 'Error';
}

?>