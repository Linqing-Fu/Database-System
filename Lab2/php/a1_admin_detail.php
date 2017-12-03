<?php
session_start();

$i=$_GET['ticket_num']; 
$zhida = $_SESSION['all_user'];
$zhida_num = $_SESSION['all_user_num'];
$line=$zhida[$i];

$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

$query = '
select User_Order.O_ID, User_Order.O_SDate, User_Order.O_SStation, User_Order.O_TStation, User_Order.O_price, User_Order.O_status
from User_Order
where
	User_Order.O_UID = \''.$line[2].'\';
	';

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$piao_num=pg_num_rows($result);

        $i=0;
	while ($line2 = pg_fetch_array($result, null, PGSQL_BOTH)) {
		$piao[$i++]=$line2;
	}

        $_SESSION['piao'] = $piao;
        $_SESSION['piao_num']=$piao_num;

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>用户订单</title>
</head>
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_admin.php'>管理员首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>

<div class="container w3layouts agileits">

    <table>  
        <caption>订单列表</caption>  
        <thead>  
            <tr>  
                <th>用户姓名 
                <th>订单号
                <th>出发日期
                <th>起点站  
                <th>终点站
                <th>票价（元）  
                <th>订单状态  
        </thead>  
        <tbody>  

        <?php for ($i=0;$i<$piao_num;$i++){$row=$piao[$i]?>
            <tr>  
                <td><?php echo $line['u_id'] ?>
                <td><?php echo $row[0] ?>
                <td><?php echo $row[1] ?>
                <td><?php echo $row[2] ?>
                <td><?php echo $row[3] ?>
                <td><?php echo $row[4] ?>
                <td><?php echo $row[5] ?>
        <?php }?>
        </tbody>  
    </table>  

    <?php echo "<a href='a1_admin_user.php'>返回列表</a>"?>
</div>
</body>
</html>

