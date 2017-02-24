<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" /><title>\\---plugged-in-life</title>

<style type="text/css">
body{background-color:black;}
h1{color:white;font-family:"Consolas";}
h1.flashing{color:white;font-family:"Consolas";}
p{color:white;font-family:"Consolas";text-size:50%px;}
div{font-family:"Consolas"}
img{border:1px;border-style:solid none;border-color:grey;border-opacity:0.3;}
.border{

}
.deleteuse{
opacity:0;
}
.title
{
position:fixed;
left:38%;
top:5px;
}

#content{
width:375px;
margin:auto;
}

#intheback{
width:375px;
height:100%;
margin:auto;
border:10px;
border-color:white;
border-style:none dashed;
}
.butta{
top:50%;
left:5%;
color:white;
position:fixed;
}
.extracarot{
top:0px;
left:0px;
color:white;
opacity:1.0;
position:fixed;
}
.descdiv{
color:white;
top:0px;
left:0px;
width:0px;
height:10px;
opacity:0.0;
word-spacing:100px;
position:fixed;
transition: width 2s, opacity 2s, word-spacing 1s, transform 2s ease-in;
-moz-transition: width 2s, opacity 2s, word-spacing 1s, -moz-transform 2s ease-in;
-webkit-transition: width 2s, opacity 2s, word-spacing 1s, -webkit-transform 2s ease-in;
-o-transition: width 2s, opacity 2s, word-spacing 1s, -o-transform 2s ease-in;
}
.descdiv:hover{
color:white;
top:0px;
left:0px;
width:350px;
opacity:1.0;
word-spacing:1px;
position:fixed;
transition: width 2s, opacity 2s, word-spacing 1s, transform 2s ease-in;
-moz-transition: width 2s, opacity 2s, word-spacing 1s, -moz-transform 2s ease-in;
-webkit-transition: width 2s, opacity 2s, word-spacing 1s, -webkit-transform 2s ease-in;
-o-transition: width 2s, opacity 2s, word-spacing 1s, -o-transform 2s ease-in;
}

.timestamp
{
width:375px;
font-size:16px;
 text-align: center;
opacity:0.0;
margin:auto;
transition-property:opacity 0.5s ease-in;
-moz-transition:opacity 0.5s ease-in;
-webkit-transition:opacity 0.5s ease-in;
-o-transition:opacity 0.5s ease-in;
}
.timestamp:hover
{
font-size:16px;
 text-align: center;
opacity:1.0;
transition-property:opacity 0.5s ease-in;
-moz-transition:opacity 0.5s ease-in;
-webkit-transition:opacity 0.5s ease-in;
-o-transition:opacity 0.5s ease-in;
}

.imagehover {
width:375px;
opacity:0.0;
font-size:16px;
text-align: center;
margin:auto;
transition-property:opacity 0.5s ease-in;
-moz-transition:opacity 0.5s ease-in;
-webkit-transition:opacity 0.5s ease-in;
-o-transition:opacity 0.5s ease-in;
}
.imagehover:hover {
opacity:1.0;
font-size:16px;
 text-align: center;
 transition-property:opacity 0.5s ease-in;
-moz-transition:opacity 0.5s ease-in;
-webkit-transition:opacity 0.5s ease-in;
-o-transition:opacity 0.5s ease-in;
}
</style>  

<script type='text/javascript' src='http://code.jquery.com/jquery-1.5.min.js'></script>
<script type='text/javascript' src='https://github.com/fcarriedo/jquery-blink/raw/master/lib/jquery.blink.js'></script>
<script type='text/javascript'>

    $(document).ready(function() {

        $('.blinkytext').blink(100);
        
        setTimeout(fade_out, 1500);
        setTimeout(fade_in, 1550);
        setTimeout(fade_reg, 1600);
        setTimeout(fade_out, 1650);
	setTimeout(fade_in, 1700);
        setTimeout(fade_out, 1800);
	
	$('.title').bind('mouseover', function() {

	        setTimeout(fade_in, 50);
	        setTimeout(fade_out, 100);
	        setTimeout(fade_in, 150);
	        setTimeout(fade_reg, 200);
	        setTimeout(fade_out, 250);
		setTimeout(fade_in, 350);
	        setTimeout(fade_out, 400);
	        setTimeout(fade_reg, 425);
	        setTimeout(fade_out, 430);
	
	 });

    });
    
    function fade_out() {
	  $(".title").css({"opacity":"0.0","font-size":"200%"});
    }
    function fade_in(){
    	  $(".title").css({"opacity":"1.0","font-size":"300%"});
    }
    function fade_reg(){
    	  $(".title").css({"opacity":"1.0","font-size":"200%"});
    }

 </script>
 
</head>


<body>





<div class="extracarot">&gt;<span class="blinkytext">_</span></div>
<div class="descdiv">&gt; dillon burns | freshman | rpi</br> this is a personal timeline project of mine. i wrote an accompanying
android app that takes shitty lo-fi pictures and posts them here. mouseover between pictures to see caption/timestamps.</div>
<h1 class="title"><font>\\--plugged-in-life</font></h1>
<div id="intheback">
<div id="content">

<?php
	$con = mysql_connect("localhost","admin_dillon","dillon");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	
	mysql_select_db("admin_db", $con);
	
	$result = mysql_query("SELECT * FROM `trilly` WHERE `caption` != 'private' ORDER BY `ID` DESC");
	
	while($row = mysql_fetch_array($result))
	  {
	 	echo '<img width="375px" height="500px" src="data:image/png;base64,' . $row['IMAGE'] . '" />';
	 	echo '<div class="timestamp">';
	 	echo '<p><br/>^</br><i>'.$row['CAPTION'].'</i></p>';
	 	echo '<p>'.$row['TSTAMP'].'<br/><span class="deleteuse">'.$row['ID'].'</span></p>';
	 	echo'</div>';
	 	
	  }
	
	mysql_close($con);

?>
</div>
</div>
</body></html>