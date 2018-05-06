<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-sm bg-light navbar-light">
			  <ul class="navbar-nav">
			    <li class="nav-item active">
			      <a class="nav-link" href="#"><h3>URL SHORTENER</h3></a>
			    </li>
			  </ul>
			</nav>
		</header>

		<div class="container align-center" id="form">
			<form action="shorten.php" method="POST">
			  <div class="form-group" id="input">
			    <label for="email">Type an URL</label>
			    <?php
				if(isset($_SESSION['result'])){
					if($_SESSION['result']=='400'){
						echo "<p>BAD REQUEST ERROR</p>";
					}
					if($_SESSION['result']=='409'){
						echo "<p>CODE ALREADY EXISTS</p>";
					}
					else if(http_response_code()==200){
						echo "<p>URL SHORTEN SUCCESSFULLY! Check Table</p>";
					}
					unset($_SESSION['result']);
				}else if(http_response_code()==404){
					echo "<p>NOT FOUND</p>";
				}
				?>
			    <input type="url" class="form-control" name="1">
			    <input type="hidden" name="count" id="count">
			  </div>
			  <button type="button" class="btn btn-dark" id="add">+ Add More URL</button>
			  <button type="submit" class="btn btn-primary">Shorten URL</button>
			</form>

		</div>

		<div class="container" id="table">
			<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Long URL</th>
			        <th>Shorten URL</th>
			        <th>Date Created</th>
			        <th>All Clicks</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php
					$con=mysqli_connect("localhost","root","pritam","url");
					// Check connection
					if (mysqli_connect_errno())
					{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,"SELECT * FROM links");
					while($row = mysqli_fetch_array($result))
					{
					echo "<tr>";
					echo "<td><a href=".$row['url']." target='_blank'>" . $row['url'] . "</a></td>";
					echo "<td><a href=".$row['code']." target='_blank'>https://" . $row['code'] . "</a></td>";
					echo "<td>" . $row['created'] . "</td>";
					echo "<td>" . $row['count'] . "</td>";
					echo "</tr>";
					}
					mysqli_close($con);
				?>
				</tbody>
			</table>
		</div>

		<footer class="container-fluid">
			<h4 class="float-right">Created by Pritam Malik</h4>
		</footer>
	</body>

	<script type="text/javascript">
		var add=document.getElementById('add');
		var i=2;
		add.addEventListener('click',function(){
			var input=document.createElement('INPUT');
			input.type="url";
			input.setAttribute('class','form-control');
			input.setAttribute('name',i);
			document.getElementById('count').value=i;
			i++;
			document.getElementById('input').appendChild(input);
		});


		var table=document.getElementById('table');
		table.onclick=function(e) {
			e=e || window.event;
			var element=e.srcElement || e.target;
			if(element.nodeName=='A' && (element.parentNode.parentNode.childNodes[1].firstChild.innerHTML == element.innerHTML)){
			 	var url=element.parentNode.parentNode.firstChild.childNodes[0].innerHTML;
				url="url="+url;
				console.log(url);
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open("POST", "count.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		            	location.reload();
		            }
	        	};
		        xmlhttp.send(url);
			  	}
			};
	</script>
	
</html>