<!DOCTYPE html>
<!-- PHP sifrovani zadanych textu -->
<html lang="cs">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Prezentace programování HTML CSS PHP JS" />
	<meta name="keywords" content="Alois Sečkár programování prezentace" />
	<title>Alois Sečkár - webový koutek</title>
</head>

<?php
	if (isset($_POST["inputString"])) {
		$algo = $_POST["hashMethod"];
		$data = $_POST["inputString"];
	} else {
		$algo = "md5";
		$data = "text";
	}
	$result = hash($algo, $data);
?>

<body>
	<h1>PHP Šifrování</h1>
	<p>PHP šifrování zadaného textového řetězce podle zvolené šifrovací funkce. V nabídce jsou jen některé z <a href="http://php.net/manual/en/function.hash-algos.php">podporovaných algoritmů</a> v PHP.</p>
	<p><strong>POZOR! Jednoduché šifrování bez dalších opatření rozhodně nezaručuje bezpečnost aplikací a hesel!</strong></p>
	<div style="border: 2px solid black; text-align: center; background-color: #e6ccff;">
		<div style="background-color: #d9b3ff; padding: 10px; font-size: 1.5em;">
			<p id="result"><?php echo '<strong>'.strtoupper($algo).' ('.$data.'):</strong> '.$result;?></p>
		</div>
		<form action="hash.php" method="post">
			<p><strong>Text:</strong> <input type="text" id="inputString" name="inputString" value="<?php echo $data;?>"></p>
			<p>
				<strong>Metoda:</strong>
				<select id="hashMethod" name="hashMethod">
					<option value="md5" <?php if ($algo=="md5") echo " selected";?>>md5</option>
					<option value="sha1" <?php if ($algo=="sha1") echo " selected";?>>sha1</option>
					<option value="sha256" <?php if ($algo=="sha256") echo " selected";?>>sha256</option>
					<option value="sha512" <?php if ($algo=="sha512") echo " selected";?>>sha512</option>
					<option value="ripemd128" <?php if ($algo=="ripemd128") echo " selected";?>>ripemd128</option>
					<option value="ripemd320" <?php if ($algo=="ripemd320") echo " selected";?>>ripemd320</option>
					<option value="tiger128,3" <?php if ($algo=="tiger128,3") echo " selected";?>>tiger128,3</option>
					<option value="tiger192,4" <?php if ($algo=="tiger192,4") echo " selected";?>>tiger192,4</option>
					<option value="haval128,3" <?php if ($algo=="haval128,3") echo " selected";?>>haval128,3</option>
					<option value="haval256,5" <?php if ($algo=="haval256,5") echo " selected";?>>haval256,5</option>
				</select>
			</p>
			<p><input type="submit" value="Zašifrovat"></p>
		</form>
	</div>
	<p><strong>Verze:</strong> 2017-06-27</p>
	<?php include("footer.php"); ?>
</body>

</html>