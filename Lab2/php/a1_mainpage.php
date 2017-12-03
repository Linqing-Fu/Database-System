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
			<h2>车次查询</h2>
			<form action="a1_qtrain.php" method="post">
				<input type="text" Name="checi" placeholder="车次序号" required="">
				<input type="text" Name="riqi" placeholder="日期">			
				<div class="send-button w3layouts agileits">			
			        	<input type="submit" value="查询">				
				</div>
                	</form>
	
	
			<div class="clear"></div>
		</div>
		<div class="register w3layouts agileits">
			<h2>行程查询</h2>
			<form action="a1_qtrip.php" method="post">
				<input type="text" Name="chufa_c" placeholder="出发城市" required="">
				<input type="text" Name="daoda_c" placeholder="到达城市" required="">
				<input type="text" Name="chufa_r" placeholder="出发日期" >
				<input type="text" Name="chufa_s" placeholder="出发时间" >
				<ul class="tick w3layouts agileits">
					<li>
						<input type="checkbox" Name='checkbox[]' id="brand1" value="1">
						<label for="brand1"><span></span>显示换乘方案</label>

						<input type="checkbox" Name='checkbox2[]' id="brand2" value="1">
						<label for="brand2"><span></span>查询返程</label>
					</li>
				</ul>

				<div class="send-button w3layouts agileits">			
			        	<input type="submit" value="查询">				
				</div>
                	</form>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>

	</div>

	<div class="footer w3layouts agileits">
		
	</div>

</body>
<!-- //Body -->

</html>
