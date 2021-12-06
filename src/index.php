<?php
header('Cache-Control: no-cache, must-revalidate');
define('login', 'login');
define('success', 'auth=success');
define('fail', 'auth=failed');
define('logout', 'logout=ok');

function getLeft($urlstring, $key) 
{
	$key_pos = strpos($urlstring, $key);
	return substr($urlstring, 0, $key_pos);
}

function getRight($urlstring, $key) 
{
	$key_pos = strpos($urlstring, $key);
	return substr($urlstring, $key_pos);
}

$myqury = $_SERVER['QUERY_STRING'];
$auth_string = 'fgtauth';
$magic = 'magic=';
$needle = '&';
$fgt_post = "post=";

if (stristr($myqury, login)) {
	$pos = strpos($myqury, $fgt_post);
	if ( $pos > 0 ) {
		$start = $pos + strlen($fgt_post);
		$fgt_url = substr($myqury, $start);
		$post_url = getLeft($fgt_url, $auth_string);
		$other_var = getRight($fgt_url, $magic);
		$magic_pair = getLeft($other_var, $needle);
		$magic_id = substr($magic_pair, strlen($magic));

		$pre_act ='<html><head><title>Please Log In</title></head>
<body background="/background.png">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action='; 
		$post_act = '>
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<input type="hidden" name="magic" value=';
		$post_magic = '> 
<tr> 
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="username" type="text" id="username">
</td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="password" type="text" id="password"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>';
		$login_form = $pre_act . $post_url . $post_act . $magic_id . $post_magic;
		echo $login_form;
	} else {
		echo "login command without post url";
	}
}

$mycmd = strtolower($myqury);

switch($mycmd) {
	case success:
		echo "here is success page";
		break;
	case fail:
		echo "here is fail page";
		break;
	case logout:
		echo "here is logout page";
		break;
}

?>
