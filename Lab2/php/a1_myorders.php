


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>我的订单</title>

<?php
session_start();

$sd=$_POST['sd'];
$ed=$_POST['ed'];

$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

$query = '
select User_Order.O_ID, User_Order.O_Tid, User_Order.O_SDate, User_Order.O_SStation, User_Order.O_TStation, User_Order.O_seattype, User_Order.O_price, User_Order.O_status
from User_Order
where User_Order.O_UID = \''.$_SESSION['u_id'].'\' and User_Order.O_SDate >= \''.$sd.'\' and User_Order.O_SDate <= \''.$ed.'\';

';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$totalnum=pg_num_rows($result);
$i = 0;

while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
	$myorders[$i++]=$line;
}

$_SESSION['myorders']=$myorders;

?>

</head>
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_book.php'>".$_SESSION['name']."的订单</a>"?>
            <?php echo "<a href='a1_mainpage.php'>首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>
<div class="container w3layouts agileits">
    <table>  
        <caption>订单详情</caption>  
        <thead>  
            <tr>  
                <th>订单号  
                <th>列车号  
                <th>出发日期  
                <th>始发站 
                <th>终点站
                <th>座位类型
                <th>价钱
                <th>订单状态  
                <th>操作  
        </thead>  
        <tbody>  


        <?php for ($i=0;$i<$totalnum;$i++){$row=$myorders[$i]?>
            <tr>  
                <td><?php echo $row[0] ?>
                <td><?php echo $row[1] ?>
                <td><?php echo $row[2] ?>
                <td><?php echo $row[3] ?>
                <td><?php echo $row[4] ?>
                <td><?php echo $row[5] ?>
                <td><?php echo $row[6] ?>
                <td><?php echo $row[7] ?>
                <td><?php 
if ($row[7]=='confirmed') 
    echo "<a href='a1_mydelete.php?ticket_num={$i}'>删除订单</a>";
else 
    echo "已取消";

?>
        <?php }?>
        </tbody>  
    </table>  
</div>
</body>
</html>


