<?php session_start();?>
<?php
require_once('config/class.config.php');
require_once('config/config.php');
?>
<!Doctype html>
<html>



<head>
<meta charset='utf-8'>
<title>Мой сайт</title>
<meta name='description' content='...'>
<meta name='keywords' content='...'>
<link type='text/css' rel='stylesheet' href='media/bootstrap/css/bootstrap.min.css'>
<link type='text/css' rel='stylesheet' href='media/css/style.css'>
	
	<script src = '/media/js/jquery-2.1.3.min.js'> </script>
 <script>
 $(function(){
	$('.menutop a:eq(0)').bind('mouseover',function(){
			$('#header').css('background' , 'yellow');
	});
		$('.menutop a:eq(1)').bind('mouseover', function(){
			$('#header').css('background' , 'green');
		});
			$('.menutop a:eq(2)').bind('mouseover',function(){
				$('#header').css('background' , 'red');
		});
				$('.menutop a:eq(3)').bind('mouseover',function(){
				$('#header').css('background' , 'blue');
	$('.menutop').bind('mouseout', function(){
	$('#header').css('background', 'url(/media/img/bg.jpg)');
		});
	
	});
 });
 </script>
				

</head>
<body>
<div id='header'>
<img src='media/img.png' class='logo'/>
<h1 style="color:#ffffff">Мой сайт</h1>
</div>
<div class='menutop'>
<a href='index.php?url=index'>Главная</a>
<a href='index.php?url=services'>Услуги</a>
<a href='index.php?url=portfolio'>Портфолио</a>
<a href='index.php?url=contacts'>Контакты</a>
</div>
<div class='main'>
<div class='col-md-2'>
<div class='menuleft'> 
<div class='menuhead'>Разделы</div>
<div class='menubody'>


<?php
	if ($_SESSION['id_user_position']){
?>
<a href='logout.php'class='btn btn-default'>Выход</a>
<a href='cabinet.php'class='btn btn-default'>Кабинет пользователя</a>

<?php
		}else{
?>
<a href='tovars.php'class='btn btn-default'>Товары</a>
<a href='login.php'class='btn btn-default'>Вход</a>
<a href='reg.php'class='btn btn-default'>Регистрация</a>
<?php
		}
?>

		
</div>
</div>
</div>


<div class='col-md-8'>