<?php require_once('templates/top.php'); 
 $login = new field_text(
"login",
"Логин",
true,
$_POST["login"]
 );   
 $email = new field_text_email(
"email",
"E-mail",
true,
$_POST["email"]
 );
  $password = new field_password(
"password",
"Пароль",
true,
$_POST["password"]
 ); 
 $repass = new field_password(
"repass",
"Повтор пароля",
true,
$_POST["repass"]
 );
 $login -> css_class ="reg";
 $email -> css_class ="reg";
 $password -> css_class ="reg";
 $repass -> css_class ="reg";
 $form = new form(array("login"=>$login,"email"=>$email,"password"=>$password,"repass"=>$repass,),
 "Регистрация","field");
 if($_POST)
 {
	 $error = $form-> check();
	if($form->fields['password'] -> value != $form->fields['repass'] -> value)
	{
	    $error [] = 'Поля пароль и повтор пароля не совпадают';
	}

	$query = " SELECT COUNT(*) FROM $tbl_users WHERE login = '{$form->fields['login'] -> value}'";
	$user = mysql_query($query);
	if(mysql_result($user, 0))
	{
	    $error [] = 'Пользователь с таким именем уже существует';
	}
 
	 if(!$error)
	 {
	$query = "INSERT INTO $tbl_users VALUE
	(NULL,
	'{$form->fields['login'] -> value}',
	'{$form->fields['password'] -> value}',
	'{$form->fields['email'] -> value}',
	NOW(),
	NOW(),
	'unblock'
	)";
	$cat = mysql_query($query);
		if(!$cat)
		{
		exit ($query);
		}
	?>
	<script>
	    document.location.href = 'index.php';
	</script>
	<?
	 }
	 if($error)
	 {
		 foreach($error as $err)
		 {
		 echo"<span style='color:red'>$err</span><br/>";
		 }
	   }
 }
 
 $form ->print_form();
 
require_once('templates/bottom.php');?>
