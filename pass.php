<!DOCTYPE html>
<!-- PHP generator nahodneho hesla -->
<html lang="cs">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Prezentace programování HTML CSS PHP JS" />
	<meta name="keywords" content="Alois Sečkár programování prezentace" />
	<title>Alois Sečkár - webový koutek</title>
</head>

<?php
	$length = "10";
	$uppers = "on";
	$numbers = "on";
	$specials = "on";
	$pass = "- generovat -";
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// deal with user preferences
		if (isset($_POST["length"])) {
			$length = intval($_POST["length"]);
			if ($length < 1) {
				$length = "10";
			}
		}
		if (isset($_POST["uppers"])) {
			$uppers = "on";
		} else {
			$uppers = "off";
		}
		if (isset($_POST["numbers"])) {
			$numbers = "on";
		} else {
			$numbers = "off";
		}
		if (isset($_POST["specials"])) {
			$specials = "on";
		} else {
			$specials = "off";
		}
		
		// build array of possible characters
		$availableLetters =  range('a', 'z');
		if ($uppers == "on") {
			$availableLetters = array_merge($availableLetters, range('A', 'Z'));
		}
		if ($numbers == "on") {
			$availableLetters = array_merge($availableLetters, range('0', '9'));
		}
		if ($specials == "on") {
			$availableLetters = array_merge($availableLetters, array('[', '.', ',', '_', '?', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '{', '|', '}', '=', '+', '~', ']'));
		}
		
		// create random string of given length
		$pass = "";
		for ($i = 0; $i < $length; $i++) {
			$pass .= $availableLetters[rand(0, count($availableLetters)-1)];
		}
	}
?>

<body>
	<h1>PHP Generátor hesla</h1>
	<p>PHP generování náhodného řetězce, který lze použít jako heslo. Používají se písmena A-Z (velká i malá), číslice 0-9 a speciální znaky:</p>
	<pre>[.,_?!@#$%^&*(){|}=+~]</pre>
	<p>Délka řetězce je volitelná (výchozí nastavení je 10) a lze si zvolit prvky, ze kterých bude heslo sestaveno (malá písmena budou použita vždy).</p>
	<div style="border: 2px solid black; text-align: center; background-color: #ffffcc;">
		<div style="background-color: #ffff99; padding: 10px; font-size: 1.5em;">
			<?php echo '<pre>'.$pass.'</pre>'?>
		</div>
		<form action="pass.php" method="post">
			<p><strong>Délka:</strong> <input type="text" id="length" name="length" value="<?php echo $length;?>"></p>
			<p>
				<strong>Malá písmena:</strong> <input type="checkbox" id="letters" name="letters" disabled checked>
				<strong>Velká písmena:</strong> <input type="checkbox" id="uppers" name="uppers" <?php if ($uppers == "on") echo " checked";?>>
				<strong>Číslice:</strong> <input type="checkbox" id="numbers" name="numbers" <?php if ($numbers == "on") echo " checked";?>>
				<strong>Speciální znaky:</strong> <input type="checkbox" id="specials" name="specials" <?php if ($specials == "on") echo " checked";?>>
			</p>
			<p><input type="submit" value="Generovat"></p>
		</form>
	</div>
	<p><strong>Verze:</strong> 2017-07-09</p>
	<?php include("footer.php"); ?>
</body>

</html>