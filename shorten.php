<?php
	session_start();
	require_once 'classes/Shortener.php';

	$s=new Shortener;

	$count=$_POST['count'];

	for($i=1;$i<=$count;$i++){
		if(isset($_POST[$i])){
			$url=$_POST[$i];
			if($code=$s->makeCode($url)){
				$_SESSION['result']="{$code}";
				http_response_code(200);
				header('Location:index.php');
				exit();
			}else{
				http_response_code(404);
				header('Location:index.php');
				exit();
			}
		}	
	}

	


?>