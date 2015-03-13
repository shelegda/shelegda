<?php require_once('templates/top.php');
	if($_SESSION['id_user_position'])
	{
	
	$query="SELECT * FROM $tbl_users WHERE id= ".$_SESSION ['id_user_position'];
	$cat=mysql_query($query);
		if(!$cat)
		{
		exit($query);
		}
	$user=mysql_fetch_array($cat);
	echo"<h2>".$user['login']."</h2>";
	echo"<h3>".$user['email']."</h3>";
	}
	else
	{
	echo 'Ошибка входа';
	}
require_once('templates/bottom.php');
?>
