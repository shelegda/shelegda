<?php

  error_reporting(E_ALL & ~E_NOTICE);
header('Content-Type: text/html; charset=utf-8');
  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем блок авторизации
  require_once("../authorize.php");
  // Подключаем SoftTime FrameWork
  require_once("../../config/class.config.dmn.php");
  // Подключаем блок отображения текста в окне браузера
  require_once("../utils/utils.print_page.php");

  // Данные переменные определяют название страницы и подсказку.
  $title = 'Управление блоком "Текстовое наполнение сайта"';
  $pageinfo = '<p class=help>Здесь можно добавить
               блок, отредактировать или
               удалить уже существующий блок.</p>';

  // Включаем заголовок страницы
  require_once("../utils/top.php");
	echo "<a href=newsadd.php?page=$_GET[page]
             title='Добавить новость'>
		<img border=0 src='../utils/img/add.gif' align='absmiddle' />
             Добавить товар</a>";
  try
  {
	$page_link = 3;
	$pagenumber = 20;
	$obj = new pager_mysql($tbl_tovars,'','order by id DESC',$pagenumber,$page_link);
	$news = $obj->get_page();
	
	if(!empty($news))
		{
		?>
		<table width="100%" class="table">
		<tr class='header'>
		<td width="200px">Изображение</td>
		<td>Название</td>
		<td>Текст</td>
		<td class='menuright'>Действие</td>
		</tr>
		<?php
			for($i=0;$i<count($news);$i++)
				{
					$img="<a href='../../media/images/{$news[$i][picture]}'>".
					"<img src='../../media/images/{$news[$i][picturesmall]}'/></a>";
					$url="?id={$news[$i][id]}&page=".$_GET['page'];
					
					if($news[$i]['showhide']=='show') 
							{
							$color_row="";
							$show="<a href='newshide.php$url' title='Скрыть'><img src='../utils/img/folder_locked.gif'/>Скрыть</a>";
							}
					else 
							{
							$color_row=" class='hiddenrow'";
							$show="<a href='newsshow.php$url' title='Отобразить'><img src='../utils/img/show.gif'/>Показать</a>";
							}
				echo "<tr$color_row>".
					"<td>$img</td>".
					"<td>{$news[$i][name]}</td>".
					"<td>{$news[$i][body]}</td>".
					"<td>$show".
					"<br><a href='newsedit.php$url'><img src='../utils/img/kedit.gif'/>Редактировать</a>".
					"<br><a href=# OnClick=\"delete_position('newsdel.php$url','Удалить?')\"><img src='../utils/img/editdelete.gif'/>Удалить</a></td>".
					'</tr>';
				}



		}
	
	
	
	
	
	
	
	?>
	</table>
	<?php
	echo $obj;
  }
  catch(ExceptionMySQL $exc)
  {
    require("../utils/exception_mysql.php"); 
  }

  // Включаем завершение страницы
  require_once("../utils/bottom.php");

echo "";
?>