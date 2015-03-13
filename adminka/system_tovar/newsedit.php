<?php
header('Content-Type: text/html; charset=utf-8');

  error_reporting(E_ALL & ~E_NOTICE);
	// Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем блок авторизации
  require_once("../authorize.php");
  // Подключаем классы формы
  require_once("../../config/class.config.dmn.php");

  // Предотвращаем SQL-инъекцию
  $_GET['id'] = intval($_GET['id']);

  try
  {
  $query = "SELECT * FROM $tbl_categories
			WHERE showhide = 'show'";
	$cat = mysql_query($query);
	if(!$cat)
		{
			exit($query);
		}
	$category_arr=array();
	while($cats = mysql_fetch_array($cat))
		{
			$category_arr[$cats['id']] = $cats['name'];
		}
		
		
    // Извлекаем из таблицы news запись, соответствующую
    // исправляемому новостному сообщению
    $query = "SELECT * FROM $tbl_tovars
              WHERE id=$_GET[id]";
    $new = mysql_query($query);
    if(!$new)
    {
      throw new ExceptionMySQL(mysql_error(), 
                               $query,
                              "Ошибка при обращении
                               к таблице новостей");
    }
    $news = mysql_fetch_array($new);
    if(empty($_POST))
    {
      // Берем информацию для оставшихся переменных из базы данных
      $_REQUEST = $news;
	  $_REQUEST['editor1'] = $_REQUEST['body'];
	  /*
      $_REQUEST['date']['month']  = substr($news['putdate'],5,2);
      $_REQUEST['date']['day']    = substr($news['putdate'],8,2);
      $_REQUEST['date']['year']   = substr($news['putdate'],0,4);
      $_REQUEST['date']['hour']   = substr($news['putdate'],11,2);
      $_REQUEST['date']['minute'] = substr($news['putdate'],14,2);
	  */
      // Определяем, скрыто поле или нет
      //if($news['showhide'] == 'show') $_REQUEST['hide'] = true; else $_REQUEST['hide'] = false;
    }
    $name        = new field_text("name",
                                  "Название",
                                  true,
                                  $_REQUEST['name']);
    $body        = new field_textarea("body",
                                  "Содержимое",
                                  true,
                                  $_REQUEST['body']);
	$price        = new field_text("price",
                                  "Цена",
                                  true,
                                  $_REQUEST['price']);
	$category        = new field_select("category",
                                  "category",
                                 $category_arr,
                                  $_REQUEST['category']);
	
	$vip = new field_select('vip','vip',array('1'=>'1','2'=>'2'),$_REQUEST['vip']);
    // Инициируем форму массивом из двух элементов
    // управления - поля ввода name и текстовой области
    // textarea
      $form = new form(array(
	                        "name" => $name, 
                            "body" => $body,
							"price" => $price,
							"category" => $category,
							'vip'=>$vip), 
	                "Редактировать",
                    "field");

    // Обработчик HTML-формы
    if(!empty($_POST))
    {
      // Проверяем корректность заполнения HTML-формы
      // и обрабатываем текстовые поля
      $error = $form->check();
      if(empty($error))
      {
        // Скрытый или открытый каталог
        //if($form->fields['hide']->value) $showhide = "show"; else $showhide = "hide";

		// Формируем SQL-запрос на добавление новости
        $query = "UPDATE $tbl_tovars 
                  SET name = '{$form->fields['name']->value}',
                      body = '{$form->fields['body']->value}',
					  price = '{$form->fields['price']->value}',
					  cat_id = '{$form->fields['category']->value}',
					  vip   = '{$form->fields['vip']->value}' 
                  WHERE id=".$_GET['id'];
		
		if(!mysql_query($query))
        {
          throw new ExceptionMySQL(mysql_error(), 
                                   $query,
                                  "Ошибка при редактировании 
                                   новостного сообщения");
        }
			// Осуществляем переадресацию на главную страницу
        // администрирования
        ?>
		<script>
		 document.location.href="index.php?page=<?php echo $_GET['page'] ?>";
		</script>
		<?php
      }
    }

    // Данные переменные определяют название страницы и подсказку.
    $title = "Редактирование";
    $pageinfo='<p class="help"></p>';
    // Включаем заголовок страницы
    require_once("../utils/top.php");
  
?>
<div align=left>
<FORM>
<INPUT class="button" TYPE="button" VALUE="На предыдущую страницу" 
onClick="history.back()">
</FORM> 
</div>
<?
    // Выводим сообщения об ошибках, если они имеются
    if(!empty($error))
    {
      foreach($error as $err)
      {
        echo "<span style=\"color:red\">$err</span><br>";
      }
    }
?>
<table width=100%>
<tr>
<td>
<div class="table_user">
<?
    // Выводим HTML-форму 
    $form->print_form();
?>
</div>
</td>
</tr>
</table>
<?
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
