<?php
require_once('templates/top.php');
$arr = array(0 => 'Выберите из списка');
$query ="SELECT * FROM $tbl_categories
		WHERE showhide = 'show'";
$cat = mysql_query($query);
if (!$cat) {
	exit($query);
}
while($cats = mysql_fetch_array($cat)){
	$arr[$cats ['id']]=$cats ['name'];
}

    $name        = new field_text("name",
                                  "Название",
                                  false,
                                  $_POST['name']);
    $priceot        = new field_text("priceot",
                                  " Цена от",
                                  false,
                                  $_POST['priceot']);
    $pricedo        = new field_text("pricedo",
                                  "Цена до",
                                  false,
                                  $_POST['pricedo']);
	$naakcii        = new field_checkbox("naakcii",
										  "На акции",
										  $_POST['naakcii']);	
	$image        = new field_checkbox("image",
										  "Наличие изображения",
										  $_POST['image']);									  
	$razdel        = new field_select("razdel",
										  "Категории",
										  $arr,
										  $_POST['razdel']);	
$form = new form(array(
	                       "name" => $name, 
                           "priceot" => $priceot,
                           "pricedo" => $pricedo, 
						   "naakcii" => $naakcii,
						   "image" => $image,
						   "razdel" => $razdel),
                     "Поиск товара",
                     "field");		
if($_POST) {
if($form -> fields['name'] -> value != ''){
	$tmp1="AND name LIKE '%".trim($form->fields['name'] -> value)."%'";
}
if(!empty($form -> fields['priceot'] -> value)){
	$tmp2="AND price > '".$form->fields['priceot']->value."'";
	
}
if(!empty($form -> fields['naakcii'] -> value)){
$tmp3="AND vip=2";
}
$query="SELECT * FROM $tbl_tovars WHERE id>0 AND showhide='show' $tmp1 $tmp2 $tmp3";
//echo $query;
$cat = mysql_query($query);
if (!$cat)
	{
	exit($query);
	}
while($tovs=mysql_fetch_array($cat)){
		if ($tovs['picturesmall'])
{
		$pic="<img src ='media/images/{$tovs['picturesmall']}'/>";
}
echo "<div class=col-md-4 mytovar'>";

echo $tovs['name'].'<br/>';
echo $tovs['price'].'<br/>';
echo $tovs['naakccii'].'<br/>';
echo $pic;
echo "</div>";
}	
}
echo "<div class=col-md-12 mytovar'>";
$form->print_form();
echo "</div>";					 
require_once('templates/bottom.php');
?>