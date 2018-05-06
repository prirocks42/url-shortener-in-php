<?php

require_once "classes/Shortener.php";
if(isset($_POST['url'])){

$s=new Shortener;
$url=$_POST['url'];

$s->count_update($url);
	
}
					

?>