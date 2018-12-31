<!DOCTYPE html>
<!-- JavaScript zobrazovac aktualniho casu -->
<html lang="cs">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Prezentace programování HTML CSS PHP JS" />
	<meta name="keywords" content="Alois Sečkár programování prezentace" />
	<title>Alois Sečkár - webový koutek</title>
	
	<script>
	// https://stackoverflow.com/a/19176102
	function getDateTime() {
		var now     = new Date(); 
		var year    = now.getFullYear();
		var month   = now.getMonth()+1; 
		var day     = now.getDate();
		var hour    = now.getHours();
		var minute  = now.getMinutes();
		var second  = now.getSeconds(); 
		if(month.toString().length == 1) {
			var month = '0'+month;
		}
		if(day.toString().length == 1) {
			var day = '0'+day;
		}   
		if(hour.toString().length == 1) {
			var hour = '0'+hour;
		}
		if(minute.toString().length == 1) {
			var minute = '0'+minute;
		}
		if(second.toString().length == 1) {
			var second = '0'+second;
		}   
		var dateTime = day + "." + month + "." + year + ' ' + hour + ':' + minute + ':' + second;
		
		return dateTime;
	}
	
	// fce na aktualizaci textovych poli
	function setDate() {
		document.getElementById('date').innerHTML = getDateTime();
	}
	
	// periodicky spoustet aktualizaci kazdou vterinu...
	window.setInterval(setDate, 1000);
	</script>
</head>

<body onload="setDate()">
	<h1>JS Aktuální čas</h1>
	<p>Tato stránka nemá žádnou funkci kromě toho, že ukazuje aktuální čas. Aktualizuje se každou vteřinu pomocí JavaScriptu.</p>
	<div style="border: 2px solid black; text-align: center; color: white; background-color: #203082; font-size: 2em;">
		<p><strong>Právě teď je:</strong> <span id="date"></span></p>
	</div>
	<p><strong>Verze:</strong> 2017-06-27</p>
	<?php include("footer.php"); ?>
</body>

</html>