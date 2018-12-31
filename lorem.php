<!DOCTYPE html>
<!-- PHP generator lorem ipsum za použití elfských slov -->
<html lang="cs">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Prezentace programování HTML CSS PHP JS" />
	<meta name="keywords" content="Alois Sečkár programování prezentace" />
	<title>Alois Sečkár - webový koutek</title>
</head>

<?php

	$length = "5";
	$minSentences = "3";
	$maxSentences = "25";
	$minWords = "3";
	$maxWords = "25";
	$loremIpsum = "- generovat -";
	
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		// deal with user preferences
		if (isset($_POST["length"])) {
			$length = intval($_POST["length"]);
			if ($length < 1) {
				$length = "5";
			}
		}
		if (isset($_POST["minSentences"])) {
			$minSentences = intval($_POST["minSentences"]);
			if ($minSentences < 1) {
				$minSentences = "3";
			}
		}
		if (isset($_POST["maxSentences"])) {
			$maxSentences = intval($_POST["maxSentences"]);
			if ($maxSentences < $minSentences) {
				$maxSentences = "25";
			}
		}
		if (isset($_POST["minWords"])) {
			$minWords = intval($_POST["minWords"]);
			if ($minWords < 1) {
				$minWords = "3";
			}
		}
		if (isset($_POST["maxWords"])) {
			$maxWords = intval($_POST["maxWords"]);
			if ($maxWords < $minWords) {
				$maxWords = "25";
			}
		}
		
		// build array of possible words from DB
		$auth = "lorem.php";
		include_once '_dbConnect.php';
		
		// db connection
		$mysqli = new mysqli($ELRH_MySQL_Host, $ELRH_MySQL_User, $ELRH_MySQL_Pass, $ELRH_MySQL_Db);
		
		// work with DB
		if ($mysqli->connect_errno) {
			// notify that error occured and connection is not established
			die("Chyba MySQL databáze... Prosím <a href='mailto:seckar@svobodni.cz'>dejte mi vědět</a>, že mi to nefunguje.");
		} else {
			// set db encoding
			$mysqli->set_charset("utf8");
		}
		
		// read words
		$result = mysqli_query($mysqli, "SELECT word FROM elrh_elven_words");
		$availableWords = $result->fetch_assoc();
		while ($word = $result->fetch_assoc()) {
			array_push($availableWords, $word);
		}
		
		// create random string of given paragraphs
		// 1 paragraph consists of x-y sentences made by x-y words
		$loremIpsum = "";
		for ($pa = 0; $pa < $length; $pa++) {
			$loremIpsum .= "<p>";
			for ($se = 0; $se < rand($minSentences, $maxSentences); $se++) {
				// first word in sentence must have first letter capitalized
				$randWord = $availableWords[rand(0, count($availableWords)-1)]["word"];
				$firstWord = strtoupper($randWord[0]).substr($randWord,1);
				$loremIpsum .= $firstWord;
				// rest of words in sentence
				for ($wo = 0; $wo < rand($minWords - 1, $maxWords - 1); $wo++) {
					$loremIpsum .= " ".$availableWords[rand(0, count($availableWords)-1)]["word"];
				}
				// end of sentence
				$loremIpsum .= ". ";
			}
			$loremIpsum .= "</p>";
		}
	}
?>

<body>
	<h1>PHP Lorem ipsum</h1>
	<p>PHP generování lorem ipsum textu, který je sestaven z elfských slov. Lze zvolit počet odstavců (výchozí nastavení je 5), minimální a maximální počet vět v jednom odstavci a minimální a maximální počet slov ve větě. Výchozí nastavení je 3-25 a maximum musí být větší nebo rovno minimu.</p>
	<div style="border: 2px solid black; text-align: center; background-color: #b3ff99;">
		<div style="background-color: #66ff33; padding: 10px; font-size: 1.2em; text-align: justify;">
			<?=$loremIpsum;?>
		</div>
		<form action="lorem.php" method="post">
			<table style="margin: 0px auto;">
				<tr><td style="text-align: right;"><strong>Odstavců: </strong></td><td><input type="text" id="length" name="length" value="<?php echo $length;?>"></td></tr>
				<tr style="text-align: right;"><td><strong>Min. vět v odstavci: </strong></td><td><input type="text" id="minSentences" name="minSentences" value="<?php echo $minSentences;?>"></td></tr>
				<tr style="text-align: right;"><td><strong>Max. vět v odstavci: </strong></td><td><input type="text" id="maxSentences" name="maxSentences" value="<?php echo $maxSentences;?>"></td></tr>
				<tr style="text-align: right;"><td><strong>Min. slov ve větě: </strong></td><td><input type="text" id="minWords" name="minWords" value="<?php echo $minWords;?>"></td></tr>
				<tr style="text-align: right;"><td><strong>Max. slov ve větě: </strong></td><td><input type="text" id="maxWords" name="maxWords" value="<?php echo $maxWords;?>"></td></tr>
			</table>
			<p><input type="submit" value="Generovat"></p>
		</form>
	</div>
	<p><strong>Verze:</strong> 2017-07-09</p>
	<?php include("footer.php"); ?>
</body>

</html>