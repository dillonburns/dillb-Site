<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Site</title>
<script type='text/javascript' src='http://code.jquery.com/jquery-1.11.0.min.js'></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBiK045QAZGw-K2VSHsdppEyS4RMT_UVxA&sensor=false"></script>

<link rel="stylesheet" type="text/css" href="latlongPicker/css/jquery-gmaps-latlon-picker.css"/>
<script src="latlongPicker/js/jquery-gmaps-latlon-picker.js"></script>
<script src="glitch.jquery.js"></script>
<script type="application/javascript">
var togglePic = function(){
			$('#gpic').fadeToggle(0.1);
			};
var invertDoc = function(){
			if($('#bdiv').css('color')=='white'){
				
				$('body').css({
							'color': 'black', 
							'background-color': 'white'
						});
			}
			else{
				
				$('#bdiv').css({
							'color': 'white', 
							'background-color': 'black'
						});
			}
};
						
(function loop() {
			var rand = Math.round(Math.random() * (1500)) + 0;
			setTimeout(function() {
					togglePic();
					loop();  
			}, rand);
		}());
(function loop() {
			var rand = Math.round(Math.random() * (2500)) + 0;
			setTimeout(function() {
					invertDoc();
					loop();  
			}, rand);
		}());
</script>
</head>

<body>
<div id="bdiv">
<a href="index.php"><img src="http://i.imgur.com/afCQHcj.png" id="logo"/></a>
<img id ="gpic" src="http://i.imgur.com/kcVwWRK.png"></div>

<form name="input" action="insertSite.php" method="post">
<b>Site Name:</b> <input type="text" name="siteName"></br>
Resources: <input type="text" name="siteContents"></br>
<fieldset class="gllpLatlonPicker">
	<br/><br/>
	<div class="gllpMap"></div>
	<br/>
	lat/lon:
		<input type="text" name="lat" class="gllpLatitude" value="42.721128"/>
		/
		<input type="text" name="long" class="gllpLongitude" value="-73.677146"/>
	<input type="hidden" class="gllpZoom" value="12"/>
</fieldset>
Danger Level: <input type="range" name="dangerLevel" min="0" max="10" step="1" value="5"></br>
<input type="submit" value="Submit">
</form>
</div>
</body>
</html>
