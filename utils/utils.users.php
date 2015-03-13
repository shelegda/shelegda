<?php
function enter($login,$password)
{
	global $tbl_users;
	$query = "SELECT * FROM $tbl_users WHERE login = '$login' AND password = '$password' AND blockunblock ='unblock' LIMIT 1";
	$usr = mysql_query($query);
	if(!$usr)
	{
		exit($query);
	}
	if(mysql_num_rows($usr))
	{
		$user = mysql_fetch_array($usr);
		$_SESSION['id_user_position'] = $user['id'];
		$query = "UPDATE $tbl_users SET lastvisit = NOW() WHERE id = ".$user['id'];
		if(!mysql_query($query))
	
		{
			exit($query);
		}
		return TRUE;
	}
	else return FALSE;
}
?>