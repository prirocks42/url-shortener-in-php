<?php
					if(isset($_POST['url'])){
						$url=$_POST['url'];					
						$con=mysqli_connect("localhost","root","pritam","url");
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}

						$result = mysqli_query($con,"UPDATE links SET count=count+1 WHERE url='{$url}' ");

						$mysqli_close($con);

					}
					


?>
