<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250" />
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <title>Ellrohir - PHP function Rand</title>
  <style type="text/css">
	div { border-style: ridge; width: 400px; padding: 5px; margin: 5px; }
	div.d1 { background-color: #c0c0c0; }
	div.d2 { background-color: #a0a0a0; }
  </style>
 </head>
 <body>
  <? if (isset($_GET["rand"])) $rand = 1; else $rand = 0; ?>
  <h2>&nbsp;&nbsp;1) Random numbers generator</h2>
  <? if ($rand=="1") { ?>
  <div class="d1">
   <table align="center">
    <tr>
     <td><b>Random :</b></td>
     <td width="5"></td>
     <td><b><i>
     <?
     $range = $_POST["r_range"];
     echo mt_rand(0,$range);
     ?>
     </i></b></td>
    </tr>
   </table>
  </div>
  <? } ?>
  <div class="d2">
   <form action="elrh_rand.php?rand=1" method="post">
    <table align="center">
     <tr>
      <td><b>Range :</b></td>
      <td width="5"></td>
      <td><input type="text" name="r_range" value="<?=$range;?>" /></td>
     </tr>
     <tr>
      <td colspan="3" height="5"></td>
     </tr> 
     <tr>
      <td colspan="3" align="center"><input type="submit" name="h_send" value="Randomize" /></td>
     </tr> 
    </table>
   </form>
  </div>
  <p>
   &nbsp;&nbsp;<font size="2">© 2009-2015 <a href="http://alois-seckar.cz">Ellrohir</a><br /></font>
   &nbsp;<a href="http://validator.w3.org/check?uri=referer">
    <img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
   </a>
  </p>
 </body>
</html>