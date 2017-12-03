<?PHP
session_start();
$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	  or die('Could not connect: ' . pg_last_error());

header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
  exit("错误执行");
}
$logname1 = $_POST['logname1'];
$password1 = $_POST['password1'];

if ($logname1=='admin' and $password1=='admin') {
	header("refresh:0;url=a1_admin.php");
}

$query = '
select *
from Login_User
where Login_User.U_logname = \''.$logname1.'\' and Login_User.U_password = \''.$password1.'\';
';


$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$rows=pg_num_rows($result);

if($rows){
          $line = pg_fetch_array($result, null, PGSQL_BOTH);
          $_SESSION['name']=$logname1;
          $_SESSION['u_id']=$line['u_id'];
          header("refresh:0;url=a1_mainpage.php");
          exit;
}else{
        echo "用户名或密码错误";
        echo "
          <script>
              setTimeout(function(){window.location.href='a1_index.html';},5000);
          </script>
        ";
       }

?>
