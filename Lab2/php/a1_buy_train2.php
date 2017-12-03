<?php
session_start();

$zhida = $_SESSION['zhida'];
$zhida_num = $_SESSION['zhida_num'];
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>候选车次</title>
</head>
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_book.php'>".$_SESSION['name']."的订单</a>"?>
            <?php echo "<a href='a1_mainpage.php'>首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>
<div class="container w3layouts agileits">
    <table>  
        <caption>候选车次</caption>  
        <thead>  
            <tr>  
                <th>列车号  
                <th>起点站  
                <th>终点站 
                <th>出发日期
                <th>出发时间
                <th>到达日期
                <th>到达时间  
                <th>座位类型  
                <th>余票（张）
                <th>票价（元）  
        </thead>  
        <tbody>  


        <?php for ($i=0;$i<$zhida_num;$i++){$row=$zhida[$i]?>
            <tr>  
                <td><?php echo $row['ti_trid'] ?>
                <td><?php echo $row['ti_sstation'] ?>
                <td><?php echo $row['ti_tstation'] ?>
                <td><?php echo $row['ti_sdate'] ?>
                <td><?php echo $row['v_stime'] ?>
                <td><?php echo $row['ti_tdate'] ?>
                <td><?php echo $row['v_ttime'] ?>
                <td><?php echo $row['ti_seattype'] ?>
                <td><?php echo $row['ti_quantity'] ?>
                <td><?php echo "<a href='a1_buy_trip.php?ticket_num={$i}'>".$row['ti_price']."</a>"?>
        <?php }?>
        </tbody>  
    </table>  
</table>
</div>
</body>
</html>
