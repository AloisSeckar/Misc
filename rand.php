<!DOCTYPE html>
<!-- JavaScript generator nahodnych cisel -->
<html lang="cs">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Prezentace programování HTML CSS PHP JS" />
	<meta name="keywords" content="Alois Sečkár programování prezentace" />
	<title>Alois Sečkár - webový koutek</title>
	
	<script>
	function randomNumber() {
		var max = document.getElementById('range').value;
		var rand = Math.floor(Math.random() * max);
		document.getElementById('result').innerHTML = ++rand;
	}
	</script>
</head>

<body>
	<h1>JS Generátor náhodných čísel</h1>
	<p>JavaScriptový generátor náhodných celých čísel od 1 do zvoleného rozsahu včetně. Pokud není rozsah explicitně zadán, vrací číslo z intervalu 1-99.</p>
	<div style="border: 2px solid black; text-align: center; background-color: #e6ffe6;">
		<div style="background-color: #b3ffb3; padding: 10px; font-size: 3em;">
			<p id="result"><strong>N/A</strong></p>
		</div>
		<p><strong>Maximum:</strong> <input type="text" id="range" name="range" value="99"></p>
		<p><input type="submit" name="generate" value="Generovat" onClick="randomNumber()"></p>
	</div>
	<p><strong>Verze:</strong> 2017-06-26</p>
	<?php include("footer.php"); ?>
</body>

</html>