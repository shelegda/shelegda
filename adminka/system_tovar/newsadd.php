<?php
  error_reporting(E_ALL & ~E_NOTICE);
header('Content-Type: text/html; charset=utf-8');
  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем блок авторизации
  require_once("../authorize.php");
  // Подключаем классы формы
  require_once("../../config/class.config.dmn.php");
  // Подключаем утилты
  require_once("../utils/utils.resizeimg.php");


    $title     = 'Добавление товара';
    $pageinfo  = '<p class=help></p>';
    // Включаем заголовок страницы
    require_once("../utils/top.php");
  try
  {
	if(empty($_POST)) { $_REQUEST['showhide']=true; }
	
    $name = new field_text('name','Название',true,$_POST['name']);
	$body = new field_textarea('body','Текст',true,$_POST['body']);
	$price = new field_text('price','Цена',true,$_POST['price']);
	$catid = new field_select('catid','Категория',array('1'=>'быттех','2'=>'кухтех'),$_POST['catid']);
	$showhide = new field_checkbox('showhide','Показать',$_REQUEST['showhide']);
	$vip = new field_select('vip','vip',array('1'=>'1','2'=>'2'),$_POST['vip']);
	$picture = new field_file('picture','Текст',false,$_FILES,'../../media/images/');
	
	
	$addtovar = new form(array(
							'name'=>$name,
							'body'=>$body,
							'price'=>$price,
							'catid'=>$catid,
							'showhide'=>$showhide,
							'vip'=>$vip,
							'picture'=>$picture),
							'Добавить товар','form_input');
	
	
	if(!empty($_POST))
		{
		$error=$addtovar->check();
		if($error)	{ foreach($error as $err) { echo "<br/>'$err"; } }

		$query="SELECT COUNT(*) FROM $tbl_tovars WHERE name='{$addtovar->fields[name]->value}'";
		$result=mysql_query($query);
			if(!$result) { exit("Ошибка проверки дубля"); }

			if(mysql_result($result,0)){ exit('Товар с таким именем с таким URLуже существует'); }
		
		if ($addtovar->fields['showhide']->value){ $show='show'; } else { $show='hide'; }
		
		
		$var=$addtovar->fields['picture']->get_filename();
		if($var) 
		{
			$picture1=date('y_m_d_h_i_').$var;
			$picsmall='S_'.$picture1;
			resizeimg("../../media/images/".$picture1,"../../media/images/".$picsmall,200,200);
		}
		else
		{
		$pic='';$picsmall='';
		}
		
		$query="INSERT INTO $tbl_tovars VALUES (NULL,
					'{$addtovar->fields[name]->value}',
					'{$addtovar->fields[body]->value}',
					'{$addtovar->fields[price]->value}',
					'{$addtovar->fields[catid]->value}',
					'$show',
					'{$addtovar->fields[vip]->value}',
					'$picture1',
					'$picsmall',
					NOW()
					)";
		$result= mysql_query($query);
		if(!$result) { exit("не удалось выполнить запрос"); }
		?>
			<script>document.location.href="index.php"</script>
		<?php
		}
	
	$addtovar->print_form(); 	
  
  }
  catch(ExceptionObject $exc) 
  {
    require("../utils/exception_object.php"); 
  }
  catch(ExceptionMySQL $exc)
  {
    require("../utils/exception_mysql.php"); 
  }
  catch(ExceptionMember $exc)
  {
    require("../utils/exception_member.php"); 
  }

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
?>
