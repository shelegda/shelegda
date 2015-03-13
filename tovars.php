<?php
require_once("templates/top.php");

$query ="SELECT * FROM $tbl_tovars
		WHERE showhide = 'show'";
$cat = mysql_query($query);
if (!$cat)
	{
	exit($query);
	}
while ($tovar = mysql_fetch_array ($cat))
	{
	echo "<div class='col-md-4 mytovar'>";
	echo "<a href http:'#' data = '".$tovar['id']."'>".$tovar['name']. "</a>";
	echo "</div>";
	}
	
?>
<script>
 $(function(){
    var fx = {
	"initModal" : function() {
		if($(".modal-window").length ==0) {
$('<div>').attr('id','jquery-overlay').fadeIn(2000).appendTo('body');
				return $('<div>').addClass('modal-window').fadeIn(2000).appendTo('body');
			}else{
				return $('.modal-window');
			}
				
		}
	}
		$('.mytovar a ').bind ('click' ,function(e) {
		   e.preventDefault();
		   var data = $(this).attr('data');
		   modal=fx.initModal();
	$('<a>').attr('href', '#').addClass('modal-close-btn').html('&times;').click (function(e){
					e.preventDefault();
					$('#jquery-overlay').fadeOut('slow', function(){
							$(this).remove();
					});
					modal.fadeOut('slow', function(){
							$(this).remove();
					});
	}).appendTo(modal);
	
	$.ajax({
		type: 'Post',
		url : 'ajax.php',
		data : 'id='+data,
		success : function(data){
			modal.append(data);
			
		},
		error : function(msq){
			modal.append(msq);
		}
		
	});
		});
 });
 </script>
<?php
require_once("templates/bottom.php");