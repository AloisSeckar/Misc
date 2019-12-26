<!DOCTYPE html>
<!-- Osobni bezecke statistiky (PHP) -->
<html lang="cs">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Prezentace programování HTML CSS PHP JS" />
	<meta name="keywords" content="Alois Sečkár programování prezentace" />
	<title>Alois Sečkár - webový koutek</title>
	<link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
	<style type="text/css">
		.runs{
			padding: 5px;
			padding-left: 10px;
			padding-right: 10px;
		}
		
		/* from https://www.w3schools.com/howto/howto_css_tooltip.asp */
		/* Tooltip container */
		.tooltip {
		  position: relative;
		  display: inline-block;
		  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
		}

		/* Tooltip text */
		.tooltip .tooltiptext {
		  visibility: hidden;
		  width: 600px;
		  background-color: #555;
		  color: #fff;
		  text-align: justify;
		  padding: 5px 10px;
		  border-radius: 6px;

		  /* Position the tooltip text */
		  position: absolute;
		  z-index: 1;
		  bottom: 125%;
		  left: 50%;
		  margin-left: -60px;

		  /* Fade in tooltip */
		  opacity: 0;
		  transition: opacity 0.3s;
		}

		/* Tooltip arrow */
		.tooltip .tooltiptext::after {
		  content: "";
		  position: absolute;
		  top: 100%;
		  left: 50%;
		  margin-left: -5px;
		  border-width: 5px;
		  border-style: solid;
		  border-color: #555 transparent transparent transparent;
		}

		/* Show the tooltip text when you mouse over the tooltip container */
		.tooltip:hover .tooltiptext {
		  visibility: visible;
		  opacity: 1;
		}
	</style>
	<script>
	function loginClick() {
		var login = prompt("Heslo:", "");
		if (SHA256(login) == '00293f13a097a8bda601a03414d50afffe207fd91f188f811897fdeb1aadb2bc') {
			document.body.innerHTML += '<form id="loginForm" action="run.php?action=login" method="post"><input type="hidden" name="jslogin" value="' + login + '"></form>';
			document.getElementById("loginForm").submit();
		} else {
			alert("Nesprávné heslo!");
		}
	}
	
	/**
	*
	*  Secure Hash Algorithm (SHA256)
	*  http://www.webtoolkit.info/
	*
	*  Original code by Angel Marin, Paul Johnston.*
	**/

	function SHA256(s){

		var chrsz   = 8;
		var hexcase = 0;

		function safe_add (x, y) {
			var lsw = (x & 0xFFFF) + (y & 0xFFFF);
			var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
			return (msw << 16) | (lsw & 0xFFFF);
		}

		function S (X, n) { return ( X >>> n ) | (X << (32 - n)); }
		function R (X, n) { return ( X >>> n ); }
		function Ch(x, y, z) { return ((x & y) ^ ((~x) & z)); }
		function Maj(x, y, z) { return ((x & y) ^ (x & z) ^ (y & z)); }
		function Sigma0256(x) { return (S(x, 2) ^ S(x, 13) ^ S(x, 22)); }
		function Sigma1256(x) { return (S(x, 6) ^ S(x, 11) ^ S(x, 25)); }
		function Gamma0256(x) { return (S(x, 7) ^ S(x, 18) ^ R(x, 3)); }
		function Gamma1256(x) { return (S(x, 17) ^ S(x, 19) ^ R(x, 10)); }
		function core_sha256 (m, l) {
			
			var K = new Array(0x428A2F98, 0x71374491, 0xB5C0FBCF, 0xE9B5DBA5, 0x3956C25B, 0x59F111F1, 0x923F82A4, 0xAB1C5ED5, 0xD807AA98, 0x12835B01, 0x243185BE, 0x550C7DC3, 0x72BE5D74, 0x80DEB1FE, 0x9BDC06A7, 0xC19BF174, 0xE49B69C1, 0xEFBE4786, 0xFC19DC6, 0x240CA1CC, 0x2DE92C6F, 0x4A7484AA, 0x5CB0A9DC, 0x76F988DA, 0x983E5152, 0xA831C66D, 0xB00327C8, 0xBF597FC7, 0xC6E00BF3, 0xD5A79147, 0x6CA6351, 0x14292967, 0x27B70A85, 0x2E1B2138, 0x4D2C6DFC, 0x53380D13, 0x650A7354, 0x766A0ABB, 0x81C2C92E, 0x92722C85, 0xA2BFE8A1, 0xA81A664B, 0xC24B8B70, 0xC76C51A3, 0xD192E819, 0xD6990624, 0xF40E3585, 0x106AA070, 0x19A4C116, 0x1E376C08, 0x2748774C, 0x34B0BCB5, 0x391C0CB3, 0x4ED8AA4A, 0x5B9CCA4F, 0x682E6FF3, 0x748F82EE, 0x78A5636F, 0x84C87814, 0x8CC70208, 0x90BEFFFA, 0xA4506CEB, 0xBEF9A3F7, 0xC67178F2);
			
			var HASH = new Array(0x6A09E667, 0xBB67AE85, 0x3C6EF372, 0xA54FF53A, 0x510E527F, 0x9B05688C, 0x1F83D9AB, 0x5BE0CD19);
			var W = new Array(64);
			var a, b, c, d, e, f, g, h, i, j;
			var T1, T2;
			
			m[l >> 5] |= 0x80 << (24 - l % 32);
			m[((l + 64 >> 9) << 4) + 15] = l;
			
			for ( var i = 0; i<m.length; i+=16 ) {
				a = HASH[0];
				b = HASH[1];
				c = HASH[2];
				d = HASH[3];
				e = HASH[4];
				f = HASH[5];
				g = HASH[6];
				h = HASH[7];
				
				for ( var j = 0; j<64; j++) {
					if (j < 16) W[j] = m[j + i];
					else W[j] = safe_add(safe_add(safe_add(Gamma1256(W[j - 2]), W[j - 7]), Gamma0256(W[j - 15])), W[j - 16]);
					T1 = safe_add(safe_add(safe_add(safe_add(h, Sigma1256(e)), Ch(e, f, g)), K[j]), W[j]);
					T2 = safe_add(Sigma0256(a), Maj(a, b, c));
					h = g;
					g = f;
					f = e;
					e = safe_add(d, T1);
					d = c;
					c = b;
					b = a;
					a = safe_add(T1, T2);
				}
				
				HASH[0] = safe_add(a, HASH[0]);
				HASH[1] = safe_add(b, HASH[1]);
				HASH[2] = safe_add(c, HASH[2]);
				HASH[3] = safe_add(d, HASH[3]);
				HASH[4] = safe_add(e, HASH[4]);
				HASH[5] = safe_add(f, HASH[5]);
				HASH[6] = safe_add(g, HASH[6]);
				HASH[7] = safe_add(h, HASH[7]);
			}
			return HASH;
		}
		
		function str2binb (str) {
			var bin = Array();
			var mask = (1 << chrsz) - 1;
			for(var i = 0; i < str.length * chrsz; i += chrsz) {
				bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (24 - i%32);
			}
			return bin;
		}
		
		function Utf8Encode(string) {
			string = string.replace(/\r\n/g,"\n");
			var utftext = "";
			for (var n = 0; n < string.length; n++) {
				var c = string.charCodeAt(n);
				if (c < 128) {
					utftext += String.fromCharCode(c);
				}
				else if((c > 127) && (c < 2048)) {
					utftext += String.fromCharCode((c >> 6) | 192);
					utftext += String.fromCharCode((c & 63) | 128);
				}
				else {
					utftext += String.fromCharCode((c >> 12) | 224);
					utftext += String.fromCharCode(((c >> 6) & 63) | 128);
					utftext += String.fromCharCode((c & 63) | 128);
				}
			}
			return utftext;
		}
		
		function binb2hex (binarray) {
			var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
			var str = "";
			for(var i = 0; i < binarray.length * 4; i++) {
				str += hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8+4)) & 0xF) +
				hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8  )) & 0xF);
			}
			return str;
		}
		
		s = Utf8Encode(s);
		
		return binb2hex(core_sha256(str2binb(s), s.length * chrsz));
	}
 	</script>
</head>

<?php
	
	session_start();
	
	$auth = "run.php";
	include_once '_dbConnect.php';
	include_once '_runHelper.php';
	
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
	
	// deal with possible login
	if (isset($_POST["jslogin"])) {
		if (hash("sha256", $_POST["jslogin"]) == '00293f13a097a8bda601a03414d50afffe207fd91f188f811897fdeb1aadb2bc') {
			$_SESSION["user"] = "admin";
		}
	}
	
	// deal with admin input, if any
	if (isset($_SESSION["user"])) {
		if (isset($_POST["admin_date"]) && isset($_POST["admin_track"]) && isset($_POST["admin_length"]) && isset($_POST["admin_time"])) {
			// prepare values
			$data["admin_input"]["date"] = $_POST["admin_date"];
			$data["admin_input"]["track"] = $_POST["admin_track"];
			if ($data["admin_input"]["track"]>-1) {
				// get length from db
				$track_info = RunHelper::retrieveArray($mysqli, "SELECT length FROM elrh_run_tracks WHERE id='".$data["admin_input"]["track"]."'");
				$data["admin_input"]["length"] = $track_info[0]["length"];
			} else {
				// for single-run-records length is inserted directly
				$data["admin_input"]["length"] = $_POST["admin_length"];
			}
			$data["admin_input"]["time"] = $_POST["admin_time"];
			$data["admin_input"]["speed"] = RunHelper::getAVGSpeed($data["admin_input"]["time"], $data["admin_input"]["length"]); // elaborate average speed from input
			if ($data["admin_input"]["track"]>-1) {
				$data["admin_input"]["length"] = 0; // erease length info again for existing track (is kept in other table)
			}
			$data["admin_input"]["dscr"] = $_POST["admin_dscr"];
			// insert into db
			$result = $mysqli->query("INSERT INTO elrh_run_records (date, track, dscr, length, time, speed) VALUES ('".mysqli_real_escape_string($mysqli, $data["admin_input"]["date"] )."', '".mysqli_real_escape_string($mysqli, $data["admin_input"]["track"])."', '".mysqli_real_escape_string($mysqli, $data["admin_input"]["dscr"])."','".mysqli_real_escape_string($mysqli, $data["admin_input"]["length"])."', '".mysqli_real_escape_string($mysqli, $data["admin_input"]["time"])."', '".mysqli_real_escape_string($mysqli, $data["admin_input"]["speed"])."');");
			if ($result) {
				$data["admin_message"] = '<span style="color: green;">Vložen nový záznam</span>';
			} else {
				$data["admin_message"] = '<span style="color: red;">Vložení selhalo</span>';
			}
		} else {
			$data["admin_input"]["date"] = date("Y-m-d");
			$data["admin_input"]["track"] = "";
			$data["admin_input"]["length"] = "";
			$data["admin_input"]["time"] = "";
			$data["admin_input"]["dscr"] = "";
		}
	}
	//
	
	// handle filter selection
	if (isset($_POST["filter_mode"])) {
		$data["filter"]["mode"] = $_POST["filter_mode"];
	} else {
		$data["filter"]["mode"] = "last30";
	}
	if (isset($_POST["filter_track"])) {
		$data["filter"]["track"] = $_POST["filter_track"];
	} else {
		$data["filter"]["track"] = "all";
	}
	if (isset($_POST["filter_year"])) {
		$data["filter"]["year"] = $_POST["filter_year"];
	} else {
		$data["filter"]["year"] = "all";
	}
	if (isset($_POST["filter_month"])) {
		$data["filter"]["month"] = $_POST["filter_month"];
	} else {
		$data["filter"]["month"] = "all";
	}
	if (isset($_POST["filter_sort"])) {
		$data["filter"]["sort"] = $_POST["filter_sort"];
	} else {
		$data["filter"]["sort"] = "date";
	}
	if (isset($_POST["filter_sort_desc"])) {
		$data["filter"]["sort_desc"] = $_POST["filter_sort_desc"];
	} else {
		$data["filter"]["sort_desc"] = "true";
	}
	
	// prepare filter values
	$data["tracks"] = RunHelper::retrieveArray($mysqli, "SELECT id, name FROM elrh_run_tracks ORDER BY name");
	for ($i=2013;$i<=date("Y");$i++) {
		$data["years"][$i] = $i;
	}
	$data["months"][0] = "01";
	$data["months"][1] = "02";
	$data["months"][2] = "03";
	$data["months"][3] = "04";
	$data["months"][4] = "05";
	$data["months"][5] = "06";
	$data["months"][6] = "07";
	$data["months"][7] = "08";
	$data["months"][8] = "09";
	$data["months"][9] = "10";
	$data["months"][10] = "11";
	$data["months"][11] = "12";
	
	
	// get run records
	// prepare sql statement
	// basic statement
	$sql = "SELECT r.date AS date, r.track AS track_id, r.time AS time, r.speed AS speed, t.name AS track, r.dscr as misc_dscr, t.length AS length, r.length AS r_length FROM elrh_run_records r JOIN elrh_run_tracks t ON r.track = t.id";
	// where clauses (track, year and month - if set)
	$where = "";
	if ($data["filter"]["track"]!="all") {
		$where .= " WHERE r.track=".$data["filter"]["track"];
	}
	if ($data["filter"]["year"]!="all") {
		if ($where == "") {
			$where .= " WHERE ";
		} else { 
			$where .= " AND ";
		}
		$where .= "r.date LIKE '".$data["filter"]["year"]."%'";
	}
	if ($data["filter"]["month"]!="all") {
		if ($where == "") {
			$where .= " WHERE ";
		} else { 
			$where .= " AND ";
		}
		$where .= "r.date LIKE '%-".$data["filter"]["month"]."-%'";
	}
	if ($where != "") {
		$sql .= $where; 
	}
	// order by
	$sql .= " ORDER BY ".$data["filter"]["sort"];
	if ($data["filter"]["sort_desc"]=="true") {
		$sql .= " DESC";
	}
	$sql .= ", r.id DESC";
	// limit part (if set)
	if ($data["filter"]["mode"]=="last10") {
		$sql .= " LIMIT 10";
	} elseif ($data["filter"]["mode"]=="last30") {
		$sql .= " LIMIT 30";
	}
	
	// run records from db
	$data["runs"] = RunHelper::retrieveArray($mysqli, $sql);
	// fix values + count totals from extracted results
	$data["total"]["count"] = 0;
	$data["total"]["length"] = 0;
	$data["total"]["time"] = "00:00:00";
	$row_index = 0;
	foreach ($data["runs"] as $row) {
		if ($data["runs"][$row_index]["track_id"]==-1) {
			$row["length"] = $row["r_length"];
			$data["runs"][$row_index]["length"] = $row["r_length"]; // for single-record-runs, length is kept within run record itself
		}
		//
		$data["total"]["count"]++;
		$data["total"]["length"] += $row["length"];
		$data["total"]["time"] = RunHelper::sumTimes($data["total"]["time"], $row["time"]);
		// get track detail (TODO this is very ineffective way...)
		$sql = "SELECT t.dscr AS track_dscr, t.map_link AS track_map FROM elrh_run_tracks t WHERE t.name = '" . $row["track"] . "'";
		$track_detail = RunHelper::retrieveRow($mysqli, $sql);
		$row["track_detail"] = $track_detail;
		$data["runs"][$row_index] = $row;
		$data["runs"][$row_index]["time"] = RunHelper::lreplace(':', '.', $data["runs"][$row_index]["time"]); // change : to . for miliseconds
		//
		$row_index++;
	}
	// set totals
	if ($data["total"]["length"]>0) {
		$data["total"]["speed"] = RunHelper::getAVGSpeed($data["total"]["time"], $data["total"]["length"]);
	}
	$data["total"]["time"] = RunHelper::lreplace(':', '.', $data["total"]["time"]); // change : to . for miliseconds
	// round length if needed
	if ($data["total"]["length"]>9999) {
		$data["total"]["length"] = round($data["total"]["length"] / 1000, 2) . " km";
	} else {
		$data["total"]["length"] .= " m";
	}
?>

<body>
	<h1>PHP Běžecké statistiky</h1>
	<p>Přehled mých běžeckých výkonů. Uchovává se datum, vzdálenost, čas a průměrná rychlost. Je tu vidět kompletní historie od roku 2013, kdy jsem s běháním začal.</p>
	<p>Ve výchozím zobrazení je vidět posledních 30 běhů, volitelně jde zapnout přehled úplně všech, nebo záznamy filtrovat podle data či trati.</p>
	<p>Po najetí na název trati se zobrazí podrobnosti běhu. Pokud jde o záznam běhu na pravidelné trasye, vede odkaz na plán trasy na mapy.cz a vedle trati je k dispozici ikona pro vyhledání všech běhů na dané trasy (řazených sestupně od nejlepších po nejhorší).</p>
	
	<?php
	// runs section
	echo '<h2>STATISTIKA BĚHŮ</h2>'.PHP_EOL;
	// display filter
	echo '<table style="margin: 10px;"><tr><td>'.PHP_EOL;
		echo '<form id="filterForm" method="post" action="run.php?action=filter">'.PHP_EOL;
			// mode
			echo '<strong>Zobrazit:</strong>&nbsp;'.PHP_EOL;
			echo '<select name="filter_mode">'.PHP_EOL;
				echo '<option value="last30">Posledních 30</option>'.PHP_EOL;
				if ($data["filter"]["mode"]=="last 10") {
					echo ' <option value="last10" selected>Posledních 10</option>'.PHP_EOL;
				} else {
					echo ' <option value="last10">Posledních 10</option>'.PHP_EOL;
				}
				if ($data["filter"]["mode"]=="all") {
					echo ' <option value="all" selected>Všechno</option>'.PHP_EOL;
				} else {
					echo ' <option value="all">Všechno</option>'.PHP_EOL;
				}
			echo '</select>'.PHP_EOL;
			// track
			echo '&nbsp;&nbsp;<strong>Trať:</strong>&nbsp;'.PHP_EOL;
			echo '<select name="filter_track" onChange="submit()">'.PHP_EOL;
				echo '<option value="all">Vše</option>'.PHP_EOL;
				foreach ($data["tracks"] as $row) {
					echo '<option value="'.$row["id"].'"';
					if ($data["filter"]["track"]==$row["id"]) { echo ' selected'; }
					echo '>'.$row["name"].'</option>'.PHP_EOL;
				}
			echo '</select>'.PHP_EOL;
			// year
			echo '&nbsp;&nbsp;<strong>Období:</strong>&nbsp;'.PHP_EOL;
			echo '<select name="filter_year">'.PHP_EOL;
				echo '<option value="all">Vše</option>'.PHP_EOL;
				foreach ($data["years"] as $row) {
					echo '<option value="'.$row.'"';
					if ($data["filter"]["year"]==$row) { echo ' selected'; }
					echo '>'.$row.'</option>'.PHP_EOL;
				}
			echo '</select>'.PHP_EOL;
			// month
			echo '<select name="filter_month">'.PHP_EOL;
				echo '<option value="all">Vše</option>'.PHP_EOL;
				foreach ($data["months"] as $row) {
					echo '<option value="'.$row.'"';
					if ($data["filter"]["month"]==$row) { echo ' selected'; }
					echo '>'.$row.'</option>'.PHP_EOL;
				}
			echo '</select>'.PHP_EOL;
			// sort by
			echo '&nbsp;&nbsp;<strong>Řadit podle:</strong>&nbsp;'.PHP_EOL;
			echo '<select name="filter_sort">'.PHP_EOL;
				echo '<option value="date">Datum</option>'.PHP_EOL;
				echo ' <option value="length"';
					if ($data["filter"]["sort"]=="length") { echo ' selected'; } 
				echo '>Vzdálenost</option>'.PHP_EOL;
				echo ' <option value="time"';
					if ($data["filter"]["sort"]=="time") { echo ' selected'; } 
				echo '>Čas</option>'.PHP_EOL;
				echo ' <option value="speed"';
					if ($data["filter"]["sort"]=="speed") { echo ' selected'; } 
				echo '>Rychlost</option>'.PHP_EOL;
			echo '</select>'.PHP_EOL;
			// sort asc/desc
			echo '<select name="filter_sort_desc">'.PHP_EOL;
				echo '<option value="true">Sestupně</option>'.PHP_EOL;
				echo ' <option value="false"';
					if ($data["filter"]["sort_desc"]=="false") { echo ' selected'; } 
				echo '>Vzestupně</option>'.PHP_EOL;
			echo '</select>'.PHP_EOL;
			// submit
			echo '&nbsp;&nbsp;<input type="submit" value="Filtrovat" />'.PHP_EOL;
		echo '</form>'.PHP_EOL;
		// clear
		echo '</td><td>'.PHP_EOL;
		echo '<form id="filterForm" method="post" action="run.php?action=filter">'.PHP_EOL;
			echo '&nbsp;&nbsp;<input type="submit" value="Obnovit výchozí" />'.PHP_EOL;
			echo '<input type="hidden" name="filter_mode" value="last30">'.PHP_EOL;
			echo '<input type="hidden" name="filter_track" value="all">'.PHP_EOL;
			echo '<input type="hidden" name="filter_year" value="all">'.PHP_EOL;
			echo '<input type="hidden" name="filter_month" value="all">'.PHP_EOL;
			echo '<input type="hidden" name="filter_sort" value="date">'.PHP_EOL;
			echo '<input type="hidden" name="filter_sort_desc" value="true">'.PHP_EOL;
		echo '</form>'.PHP_EOL;
	echo '</td></tr></table>'.PHP_EOL;
	// display run entries (sorted by date desc, filtered by selection)
	if (!empty($data["runs"])) {
		echo '<table>'.PHP_EOL;
			// totals
			echo '<tr>'.PHP_EOL;
				// number of runs
				echo '<td class="runs"><strong>Celkem: '.$data["total"]["count"].'x</strong></td>'.PHP_EOL;
				// run track
				echo '<td class="runs"></td>'.PHP_EOL;
				// run length
				echo '<td class="runs"><strong>'.$data["total"]["length"].'</strong></td>'.PHP_EOL;
				// run time
				echo '<td class="runs"><strong>'.$data["total"]["time"].'</strong></td>'.PHP_EOL;
				// avg speed
				echo '<td class="runs"><strong>'.$data["total"]["speed"].' km/h</strong></td>'.PHP_EOL;
			echo '</tr>'.PHP_EOL;
			//
			foreach ($data["runs"] as $row) {
				echo '<tr>'.PHP_EOL;
					// run date
					echo '<td class="runs"><strong>'.$row["date"].'</strong></td>'.PHP_EOL;
					// run track
					echo '<form id="filterForm" method="post" action="run.php?action=filter" style="margin: 0; padding: 0;">'.PHP_EOL;
					echo '<td class="runs-center">'.PHP_EOL;
					if ($row["track_id"] != -1) {
							echo '<input type="image" name="submit" alt="find track" src="sort.jpg">'.PHP_EOL;
							echo '<input type="hidden" name="filter_track" value="'.$row["track_id"].'">'.PHP_EOL;
							echo '<input type="hidden" name="filter_mode" value="all">'.PHP_EOL;
							echo '<input type="hidden" name="filter_sort" value="speed">'.PHP_EOL;
							echo '<input type="hidden" name="filter_sort_desc" value="true">'.PHP_EOL;
					} else {
						echo '<img src="no-sort.jpg" />'.PHP_EOL;
					}
					echo '</td">'.PHP_EOL;
					echo '</form>'.PHP_EOL;
					//
					echo '<td class="runs-center">'.PHP_EOL;
					echo '<a href="'.$row["track_detail"]["track_map"].'">'.PHP_EOL;
					echo '<div class="tooltip">'.$row["track"].'<span class="tooltiptext">';
					if (!empty($row["misc_dscr"])) {
						echo $row["misc_dscr"];
					} else {
						echo $row["track_detail"]["track_dscr"];
					}
					echo '</span></div></a></td>'.PHP_EOL;
					// run length
					echo '<td class="runs">'.$row["length"].' m</td>'.PHP_EOL;
					// run time
					echo '<td class="runs">'.$row["time"].'</td>'.PHP_EOL;
					// avg speed
					echo '<td class="runs">'.$row["speed"].' km/h</td>'.PHP_EOL;
				echo '</tr>'.PHP_EOL;
			}
			// totals
			echo '<tr>'.PHP_EOL;
				// run date
				echo '<td class="runs"><strong>Celkem: '.$data["total"]["count"].'x</strong></td>'.PHP_EOL;
				// run track
				echo '<td class="runs"></td>'.PHP_EOL;
				// run length
				echo '<td class="runs"><strong>'.$data["total"]["length"].'</strong></td>'.PHP_EOL;
				// run time
				echo '<td class="runs"><strong>'.$data["total"]["time"].'</strong></td>'.PHP_EOL;
				// avg speed
				echo '<td class="runs"><strong>'.$data["total"]["speed"].' km/h</strong></td>'.PHP_EOL;
			echo '</tr>'.PHP_EOL;
			//
		echo '</table>'.PHP_EOL;
	} else {
		// no runs
		echo '<p style="text-align: center;">'.PHP_EOL;
			echo 'Nenalezeny žádné záznamy podle zvolených kritérií'.PHP_EOL;
		echo '</p>'.PHP_EOL;
	}
	// input form for admin
	if (isset($_SESSION["user"])) {
		echo '<p><br /></p>';
		echo '<h3>Vložit nový běh</h3>';
		echo '<form method="post" action="run.php">'.PHP_EOL;
			echo '<table>'.PHP_EOL;
				if (isset($data["admin_message"])) {
					echo '<tr><td colspan="2">'.$data["admin_message"].'</td></tr>'.PHP_EOL;
				}
				echo '<tr>'.PHP_EOL;
					echo '<td><strong>Datum:</strong></td>'.PHP_EOL;
					echo '<td><input type="text" name="admin_date" style="width: 100%;"';
						if (isset($data["admin_input"]["date"])) { echo ' value="'.$data["admin_input"]["date"].'"'; }
					echo ' /></td>'.PHP_EOL;
				echo '</tr>'.PHP_EOL;
				echo '<tr>'.PHP_EOL;
					echo '<td><strong>Trasa:</strong></td>'.PHP_EOL;
					echo '<td>'.PHP_EOL;
						echo '<select name="admin_track" style="width: 100%;">'.PHP_EOL;
						foreach ($data["tracks"] as $row) {
							echo '<option value="'.$row["id"].'"';
							if ($row["id"]==$data["admin_input"]["track"]) { echo ' selected'; }
							echo '>'.$row["name"].'</option>'.PHP_EOL;
						}
						echo '</select>'.PHP_EOL;
					echo '</td>'.PHP_EOL;
				echo '</tr>'.PHP_EOL;
				echo '<tr>'.PHP_EOL;
					echo '<td><strong>Vzdálenost:</strong></td>'.PHP_EOL;
					echo '<td><input type="text" name="admin_length" style="width: 100%;"';
						if (isset($data["admin_input"]["length"])) { echo ' value="'.$data["admin_input"]["length"].'"'; } else { echo ' value=" "'; } 
					echo ' /></td>'.PHP_EOL;
				echo '</tr>'.PHP_EOL;
				echo '<tr>'.PHP_EOL;
					echo '<td><strong>Čas:</strong></td>'.PHP_EOL;
					echo '<td><input type="text" name="admin_time" style="width: 100%;"';
						if (isset($data["admin_input"]["time"])) { echo ' value="'.$data["admin_input"]["time"].'"'; }
					echo ' /></td>'.PHP_EOL;
				echo '</tr>'.PHP_EOL;
				echo '<tr>'.PHP_EOL;
					echo '<td><strong>Popis:</strong></td>'.PHP_EOL;
					echo '<td><textarea name="admin_dscr" style="width: 250px" rows="3">';
						if (isset($data["admin_input"]["dscr"])) { echo $data["admin_input"]["dscr"]; }
					echo '</textarea></td>'.PHP_EOL;
				echo '</tr>'.PHP_EOL;
				echo '<tr>'.PHP_EOL;
					echo '<td colspan="2"><input type="submit" value="Odeslat" /></td>'.PHP_EOL;
				echo '</tr>'.PHP_EOL;
			echo '</table>'.PHP_EOL;
		echo '</form>'.PHP_EOL;
	}
	?>
	
	<p><strong>Verze:</strong> 2019-12-26 <a href="#" title="Login" onClick="loginClick();"><i class="fa fa-lock" aria-hidden="true"></i></a></p>
	<?php include("footer.php"); ?>
</body>

</html>