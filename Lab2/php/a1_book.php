<?php
session_start();
$logname1=$_SESSION['name'];


?>
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>票务查询</title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

	<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all">



</head>
<!-- //Head -->

<!-- Body -->
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_book.php'>".$_SESSION['name']."的订单</a>"?>
            <?php echo "<a href='a1_mainpage.php'>首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>

	<h1>票务查询</h1>



	<div class="container w3layouts agileits">



		<div class="login w3layouts agileits">
			<h2>订单查询</h2>
			<form action="a1_myorders.php" method="post">
				<input type="text" Name="sd" placeholder="起始日期" required="">
				<input type="text" Name="ed" placeholder="截止日期" required="">			
				<div class="send-button w3layouts agileits">			
			        	<input type="submit" value="查询">				
				</div>
                	</form>
	
	
			<div class="clear"></div>
		</div>
		<div class="clear"></div>

	</div>

	

</body>
<!-- //Body -->

</html>
