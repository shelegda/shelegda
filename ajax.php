<?php
require_once('config/config.php');
$id=(int)$_POST['id'];
$query= "SELECT * FROM $tbl_tovars WHERE id= $id";
$cat=mysql_query($query);
if(!$cat){
exit($query);
}
$text=mysql_fetch_array($cat);
?>
<h2><?=$text['name']?> </h2>