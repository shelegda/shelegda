<?php
$dblocation='localhost';
$dbname='shelegDA';
$dbuser='root';
$dbpassword='';
//таблицы
$tbl_maintext='maintexts';
$tbl_users = 'users';
$tbl_tovars='tovars';
$tbl_system_accounts='system_accounts';
$tbl_categories = 'categories' ;
$dbuse=mysql_connect($dblocation, $dbuser, $dbpassword);
if(!$dbuse){
exit('server');
}
$dbselectname=mysql_select_db($dbname, $dbuse);
if(!$dbselectname){
exit('db');
}
@mysql_query("SET NAMES'utf8'");
?>