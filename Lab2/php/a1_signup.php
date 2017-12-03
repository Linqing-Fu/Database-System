<?php 
header("Content-Type: text/html; charset=utf8");
 
if(!isset($_POST['submit'])){
    exit("错误执行");
}//判断是否有submit操作


$logname1 = $_POST['logname1'];
$password=$_POST['password'];
$name=$_POST['name'];
$id=$_POST['id'];
$phonenum=$_POST['phonenum'];
$cardid=$_POST['cardid'];
 
$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

$query = '
insert into Login_User (U_name, U_ID, U_phonenum, U_cardID, U_logname, U_password)
values (\''.$name.'\', \''.$id.'\', \''.$phonenum.'\', \''.$cardid.'\', \''.$logname1.'\', \''.$password.'\');
';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>用户注册</title>
</head>
<body>
<p>注册成功！</p>
<p>用户名：<?php echo $logname1 ?></p>
<p>密码：<?php echo $password ?></p>
<p>姓名：<?php echo $name ?></p>
<p>身份证号：<?php echo $id ?></p>
<p>电话号码：<?php echo $phonenum ?></p>
<p>信用卡号：<?php echo $cardid ?></p>
<a href="a1_index.html">返回</a>
</body>
</html>

<?php 
pg_close($dbconn);
?>
