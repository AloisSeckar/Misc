<?php
///////////////////////////////////////////////////////////////////////
//                                                                   //
//                      PHP functions MD5 and SH1                    //
//                       Quick hashing maschine                      //
//                                                                   //
//                   Copyright © Ellrohir 2009-2012                  // 
//                                                                   //
//                                                                   //
//    Page Info                                                      //
// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * //
// *  Author:         *  Ellrohir [ ellrohir@seznam.cz ]           * //
// *  Homepage:       *  http://ellrohir.xf.cz                     * //
// *  File:           *  elrh_hash.php                             * //
// *  Purpose:        *  Page for quick on-line string hashing by  * //
// *                  *  MD5 and SH1 hashing functions             * //
// *  System Version: *  -                                         * //
// *  Last Modified:  *  2012-01-02 1845 GMT+1                     * //
// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * //
///////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250" />
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <title>Ellrohir - PHP functions MD5 and SH1</title>
 </head>
 <body>
  <? if (isset($_GET["hash"])) $hash = $_GET["hash"]; else $hash = 0; ?>
  <h2>&nbsp;&nbsp;1) Hashing using MD5($string)</h2>
  <? if ($hash=="1") { ?>
  <div style="border-style: ridge; background-color: #4682b4; width: 400px; padding: 5px; margin: 5px;">
   <table align="center">
    <tr>
     <td><b>$string :</b></td>
     <td width="5"></td>
     <td><b><i><?=$_POST["h_string"];?></i></b></td>
    </tr>
    <tr>
     <td><b>Hash :</b></td>
     <td width="5"></td>
     <td><b><i><?=md5($_POST["h_string"]);?></i></b></td>
    </tr>
   </table>
  </div>
  <? } ?>
  <div style="border-style: ridge; background-color: #483d8b; width: 400px; padding: 5px; margin: 5px;">
   <form action="elrh_hash.php?hash=1" method="post">
    <table align="center">
     <tr>
      <td><b>$string :</b></td>
      <td width="5"></td>
      <td><input type="text" name="h_string" /></td>
     </tr>
     <tr>
      <td colspan="3" height="5"></td>
     </tr> 
     <tr>
      <td colspan="3" align="center"><input type="submit" name="h_send" value="Hash" /></td>
     </tr> 
    </table>
   </form>
  </div>
  <h2>&nbsp;&nbsp;2) Hashing using SHA1($string)</h2>
  <? if ($hash=="2") { ?>
  <div style="border-style: ridge; background-color: #db7093; width: 400px; padding: 5px; margin: 5px;">
   <table align="center">
    <tr>
     <td><b>$string :</b></td>
     <td width="5"></td>
     <td><b><i><?=$_POST["h_string"];?></i></b></td>
    </tr>
    <tr>
     <td><b>Hash :</b></td>
     <td width="5"></td>
     <td><b><i><?=sha1($_POST["h_string"]);?></i></b></td>
    </tr>
   </table>
  </div>
  <? } ?>
  <div style="border-style: ridge; background-color: #dc143c; width: 400px; padding: 5px; margin: 5px;">
   <form action="elrh_hash.php?hash=2" method="post">
    <table align="center">
     <tr>
      <td><b>$string :</b></td>
      <td width="5"></td>
      <td><input type="text" name="h_string" /></td>
     </tr>
     <tr>
      <td colspan="3" height="5"></td>
     </tr> 
     <tr>
      <td colspan="3" align="center"><input type="submit" name="h_send" value="Hash" /></td>
     </tr> 
    </table>
   </form>
  </div>
  <h2>&nbsp;&nbsp;3) Hashing using SHA1(MD5($string))</h2>
  <? if ($hash=="3") { ?>
  <div style="border-style: ridge; background-color: #2e8b57; width: 400px; padding: 5px; margin: 5px;">
   <table align="center">
    <tr>
     <td><b>$string :</b></td>
     <td width="5"></td>
     <td><b><i><?=$_POST["h_string"];?></i></b></td>
    </tr>
    <tr>
     <td><b>Hash :</b></td>
     <td width="5"></td>
     <td><b><i><?=sha1(md5($_POST["h_string"]));?></i></b></td>
    </tr>
   </table>
  </div>
  <? } ?>
  <div style="border-style: ridge; background-color: #008000; width: 400px; padding: 5px; margin: 5px;">
   <form action="elrh_hash.php?hash=3" method="post">
    <table align="center">
     <tr>
      <td><b>$string :</b></td>
      <td width="5"></td>
      <td><input type="text" name="h_string" /></td>
     </tr>
     <tr>
      <td colspan="3" height="5"></td>
     </tr> 
     <tr>
      <td colspan="3" align="center"><input type="submit" name="h_send" value="Hash" /></td>
     </tr> 
    </table>
   </form>
  </div>
  <p>
   &nbsp;&nbsp;<font size="2">© 2009-2012 <a href="http://ellrohir.xf.cz">Ellrohir</a><br /></font>
   &nbsp;<a href="http://validator.w3.org/check?uri=referer">
    <img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
   </a>
  </p>
 </body>
</html>