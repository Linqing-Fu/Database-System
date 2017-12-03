<?php
session_start();

$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());
///////////////////////////////
$query = '
select count(*)
from User_Order
where O_status = \'confirmed\';
	';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$line = pg_fetch_array($result, null, PGSQL_BOTH); 
$total_user=$line[0];
////////////////////////////////
///////////////////////////////
$query = '
select sum(O_price) 
from User_Order
where O_status = \'confirmed\';
	';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$line = pg_fetch_array($result, null, PGSQL_BOTH); 
$total_price=$line[0];
////////////////////////////////
///////////////////////////////
$query = '
select User_Order.O_TID, count(*) as Num
from User_Order
where O_status = \'confirmed\'
group by O_TID
order by Num desc;
	';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$totalnum=pg_num_rows($result);
$i = 0;
while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
	$train[$i++]=$line;
}
$_SESSION['hot_train']=$train;
$_SESSION['hot_train_num'] = $totalnum;
////////////////////////////////
///////////////////////////////
$query = '
select Login_User.U_name, Login_User.U_logname, Login_User.U_ID
, Login_User.U_phonenum, Login_User.U_cardid, Login_User.U_password
from Login_User;
	';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$totalnum=pg_num_rows($result);
$i = 0;
while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
	$train[$i++]=$line;
}
$_SESSION['all_user']=$train;
$_SESSION['all_user_num'] = $totalnum;
////////////////////////////////
?>

<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<title>管理员</title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

	<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_admin.php'>管理员首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>


	<h1>欢迎管理员大佬</h1>



	<div class="container w3layouts agileits">



		<div class="login w3layouts agileits">
			<h2>订单总数：<?php echo $total_user?></h2>
			<form action="a1_admin_user.php" method="post">
				<div class="send-button w3layouts agileits">			
			        	<input type="submit" value="用户信息">				
				</div>
                	</form>
			<div class="clear"></div>
		</div>
		<div class="register w3layouts agileits">
			<h2>售出总额：<?php echo $total_price?></h2>
			<form action="a1_admin_train.php" method="post">
				
				<div class="send-button w3layouts agileits">			
			        	<input type="submit" value="热门车次">				
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

