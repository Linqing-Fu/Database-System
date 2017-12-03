<?php
session_start();

$train = $_SESSION['train'];
$_SESSION['chufa_c']=$train[0][1];
$totalnum = $_SESSION['totalnum'];
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
                <th>序号   
                <th>车站名 
                <th>到站时间  
                <th>硬座价格
                <th>软座价格  
                <th>硬卧上铺价  
                <th>硬卧中铺价   
                <th>硬卧下铺价   
                <th>软卧上铺价  
                <th>软卧下铺价
                <th>购买
        </thead>  
        <tbody>  



        <?php for ($i=0;$i<$totalnum;$i++){$row=$train[$i]?>
            <tr>  
                <td><?php echo $row['v_order'] ?>
                <td><?php echo $row['v_station'] ?>
                <td><?php echo $row['v_stime'] ?>
                <td><?php echo $row['v_hard_price'] ?>
                <td><?php echo $row['v_soft_price'] ?>
                <td><?php echo $row['v_hard_up_price'] ?>
                <td><?php echo $row['v_hard_mid_price'] ?>
                <td><?php echo $row['v_hard_dw_price'] ?>
                <td><?php echo $row['v_soft_up_price'] ?>
                <td><?php echo $row['v_soft_dw_price'] ?>
                <td><?php echo "<a href='a1_buy_train.php?ticket_num={$i}'>购买</a>"?>
        <?php }?>
        </tbody>  
    </table>  


</table>
</div>

</body>
</html>
