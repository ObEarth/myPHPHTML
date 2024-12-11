<?php

function myTest()
{
echo "今天是 " . date("Y/m/d") . "<br>";
echo "今天是 " . date("Y.m.d") . "<br>";
echo "今天是 " . date("Y-m-d") . "<br>";
echo "今天是 " . date("l")."<br>";
echo "当前时间是 " . date("h:i:sa")."<br>";

echo "<br>****************Array***********************<br>";
$cars=array("Volvo1","BMW","Toyota"); 
echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";
echo "<br>";

$cars=array("Volvo","BMW","Toyota");
$arrlength=count($cars);

for($x=0;$x<$arrlength;$x++)
  {
  echo $cars[$x];
  echo "<br>";
  }

$age=array("Bill"=>"60","Steve"=>"56","Mark"=>"31");

foreach($age as $x=>$x_value)
  {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
  }

// 二维数组：
$cars=array
  (
  array("Volvo",100,96),
  array("BMW",60,59),
  array("Toyota",110,100)
  );

echo $cars[0][0].": Ordered: ".$cars[0][1].". Sold: ".$cars[0][2]."<br>";
echo $cars[1][0].": Ordered: ".$cars[1][1].". Sold: ".$cars[1][2]."<br>";
echo $cars[2][0].": Ordered: ".$cars[2][1].". Sold: ".$cars[2][2]."<br>";
}

function userSignUp($userNameData,$userPasswordData)
 {
  // 在此处编写你想要执行的PHP代码
//MYSQL
$servername = "localhost";
$username = "root";
$password = "121212";
$database = "mysql";
$newDatabase = "my_db";
$tableName = "userData";

// 创建连接
$con = new mysqli($servername, $username, $password, $database);

// 检查连接
if ($con->connect_error) {
    die("连接失败: " . $con->connect_error);
}

mysqli_select_db($con,$newDatabase);//选择名为newDatabase的数据库进行操作
//在数据库中检查用户名是否已注册
$sql_insert = "select userPassword from $tableName where username = '$userNameData'";//在数据库中表名为tableName的数据中,是否有用户名为$userNameData的数据
$result = mysqli_query($con,$sql_insert );//执行mysqli的查询操作
if($result->num_rows)//sql已有此用户名
{
  echo '2';
  mysqli_close($con);
  return;
}
$sql_insert = "INSERT INTO $tableName (userName,userPassword)
    VALUES ('$userNameData','$userPasswordData')";//如果没有此用户名的数据,则进行注册操作,把用户名和密码插入数据库中
mysqli_query($con,$sql_insert );//执行mysqli的插入操作.

mysqli_close($con);
echo 1;
}

function userLogin($userNameData,$userPasswordData)
 {
  // 在此处编写你想要执行的PHP代码
//MYSQL
$servername = "localhost";
$username = "root";
$password = "121212";
$database = "mysql";
$newDatabase = "my_db";
$tableName = "userData";

// 创建连接
$con = new mysqli($servername, $username, $password, $database);

// 检查连接
if ($con->connect_error) {
    die("连接失败: " . $con->connect_error);
}

mysqli_select_db($con,$newDatabase);
//在数据库中检查用户名是否存在
$sql_insert = "select userPassword from $tableName where username = '$userNameData'";
$result = mysqli_query($con,$sql_insert );
if($result->num_rows)//sql已有此用户名
{
  if($result->fetch_assoc()['userPassword'] == $userPasswordData)//检测用户$userNameData输入的密码与数据库中保存的密码是否相同
  {
     echo 0;//密码正确,登录成功 
  }
  else
  {
    echo 3;//密码不正确
  }
  mysqli_close($con);
  return;
}
else
{
  echo 4;
  mysqli_close($con);
  return;
}
}

function getUserData($userNameData)
 {
$servername = "localhost";
$username = "root";
$password = "121212";
$database = "mysql";
$newDatabase = "my_db";
$tableName = "userData";

// 创建连接
$con = new mysqli($servername, $username, $password, $database);

// 检查连接
if ($con->connect_error) {
    die("连接失败: " . $con->connect_error);
}
mysqli_select_db($con,$newDatabase);
$sql_insert = "select userPassword from $tableName where username = '$userNameData'";
$result = mysqli_query($con,$sql_insert );
// 数据查询 
    if($result)
    {
        $rows = $result->num_rows;//获取查询结果的行数
        if($rows)//如果不为0,说明找到的数据
       {
            while($row = $result->fetch_assoc())//输出已找到的数据
           {
                echo $row['userPassword'];
            }
        }
        else
        {
            echo 4;
        }
    }
   else
    {
        echo 'MySQL语句有误。<br>'.$mysqli->error.'<br>';
    }
}

function userSaveChatRecord($userNameData,$timeData,$chatRecordData)
 {
  // 在此处编写你想要执行的PHP代码
//MYSQL
$servername = "localhost";
$username = "root";
$password = "121212";
$database = "mysql";
$newDatabase = "my_db";
$tableName = "chatData";

// 创建连接
$con = new mysqli($servername, $username, $password, $database);

// 检查连接
if ($con->connect_error) {
    die("连接失败: " . $con->connect_error);
}

mysqli_select_db($con,$newDatabase);//选择名为newDatabase的数据库进行操作

$sql_insert = "INSERT INTO $tableName (userName,chatDate,chatRecord)
    VALUES ('$userNameData','$timeData',$chatRecordData)";//如果没有此用户名的数据,则进行注册操作,把用户名和密码插入数据库中
mysqli_query($con,$sql_insert );//执行mysqli的插入操作.

mysqli_close($con);
echo 5;
}
/*function loginPOST()
 {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    // 打印所有POST参数
    foreach ($_POST as $key => $value) 
    {
        echo $key . ':' . $value .'\n';
    }
        // 构造响应结果
  $response = array('status' => 'success', 'message' => "POST success!");
  
  // 将响应结果返回给客户端
  echo json_encode($response);
  } 
  else 
  {
    echo 'No POST data received.';
  }
}*/

function createUserTable()
 {
  $servername = "localhost";
  $username = "root";
  $password = "121212";
  $database = "mysql";
  $newDatabase = "my_db";
  $tableName = "userData";
  
  // 创建连接
  $con = new mysqli($servername, $username, $password, $database);
  
  // 检查连接
  if ($con->connect_error) {
      die("连接失败: " . $con->connect_error);
  }
  
  $resultDatabase = $con->query("SHOW DATABASES LIKE '" . $newDatabase. "'");//查询是否存在同名的数据库
  if ($resultDatabase->num_rows > 0) 
  {
  echo "已存在数据库".$newDatabase;
  }
  else
  {
  echo "database not exist";
  //Create database
  if (mysqli_query($con,"CREATE DATABASE $newDatabase"))//创建名为$newDatabase的数据库
    {
    echo "Database created";
    }
  else
    {
    echo "Error creating database: " . mysqli_error();
    }
  }
  echo "<br>";
  // Create table in my_db database
  mysqli_select_db($con,$newDatabase);
  $resultTable = $con->query("SHOW TABLES LIKE '" . $tableName. "'");//查询是否存在同名的表
  if ($resultTable->num_rows > 0) 
  {
  echo "数据库".$newDatabase."已存在表". $tableName;
  }
  else
  {
  echo "database not exist";
  $sql_create = "CREATE TABLE $tableName 
  (
  personID int NOT NULL AUTO_INCREMENT, 
  PRIMARY KEY(personID),
  userName varchar(15),
  userPassword varchar(15)
  )";
  mysqli_query($con,$sql_create);//创建名为$tableName的数据库
  }
}

function createChatTable()
 {
  $servername = "localhost";
  $username = "root";
  $password = "121212";
  $database = "mysql";
  $newDatabase = "my_db";
  $tableName = "chatData";
  
  // 创建连接
  $con = new mysqli($servername, $username, $password, $database);
  
  // 检查连接
  if ($con->connect_error) {
      die("连接失败: " . $con->connect_error);
  }
  
  $resultDatabase = $con->query("SHOW DATABASES LIKE '" . $newDatabase. "'");//查询是否存在同名的数据库
  if ($resultDatabase->num_rows > 0) 
  {
  echo "已存在数据库".$newDatabase;
  }
  else
  {
  echo "database not exist";
  //Create database
  if (mysqli_query($con,"CREATE DATABASE $newDatabase"))//创建名为$newDatabase的数据库
    {
    echo "Database created";
    }
  else
    {
    echo "Error creating database: " . mysqli_error();
    }
  }
  echo "<br>";
  // Create table in my_db database
  mysqli_select_db($con,$newDatabase);
  $resultTable = $con->query("SHOW TABLES LIKE '" . $tableName. "'");//查询是否存在同名的表
  if ($resultTable->num_rows > 0) 
  {
  echo "数据库".$newDatabase."已存在表". $tableName;
  }
  else
  {
  echo "database not exist";
  $sql_create = "CREATE TABLE $tableName 
  (
  personID int NOT NULL AUTO_INCREMENT, 
  PRIMARY KEY(personID),
  userName varchar(15),
  chatDate  varchar(30),
  chatRecord varchar(255)
  )";
  mysqli_query($con,$sql_create);//创建名为$tableName的数据库
  }
}

/*
$host = '192.168.0.101';
$port = '89';
 
function send_udp_message($host, $port, $message)
{
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    @socket_connect($socket, $host, $port);
 
    $num = 0;
    $length = strlen($message);
    do
    {
        $buffer = substr($message, $num);
        $ret = @socket_write($socket, $buffer);
        $num += $ret;
    } while ($num < $length);
 
    socket_close($socket);
 
    // UDP 是一种无链接的传输层协议, 不需要也无法获取返回消息
    return true;
}
 
send_udp_message($host, $port, $message);
 
function receive_udp_message($host, $port, $callback)
{
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
 
    @socket_bind($socket, $host, $port);
    @set_time_limit(0);
 
    while (true)
    {
        usleep(1000);
 
        $ret = @socket_recvfrom($socket, $request, 16384, 0, $remote_host, $remote_port);
        if ($ret)
        {
            $callback($remote_host, $remote_port, $request);
        }
 
        // 不需要返回给客户端任何消息, 继续循环
    }
}
 
// 客户端来的任何请求都会打印到屏幕上
receive_udp_message($host, $port, $callback);
// 如果程序没有出现异常，该进程会一直存在
*/

// 检查是否存在名为getAction的GET参数
if (isset($_GET['getAction']))
 {
$gAction = $_GET['getAction'];
// 根据getAction参数的值调用对应的PHP函数gAction =$ _GET['getAction'];
switch ($gAction) {
    case 'getUserData':
      getUserData();
        break;
case 'createUserTable':
        createUserTable();
        break;
    case	'myTest':
       myTest();
        break;
    // 其他case语句
    default:
        // 默认操作
 echo " default:1";
        break;
}
}

// 检查是否存在名为postAction的POST参数
if (isset($_POST['postType']))
 {
  if($_POST['postType'] === "0")//判断postType 0 注册 1 查询 2 登录 3 保存聊天记录
  {
    userSignUp($_POST['username'],$_POST['userPassword']);
  }
  if($_POST['postType'] === "1")
  {
    getUserData($_POST['username']);
  }
  if($_POST['postType'] === "2")
  {
    userLogin($_POST['username'],$_POST['userPassword']);
  }
  if($_POST['postType'] === "3")
  {
    userSaveChatRecord($_POST['username'],$_POST['chatDate'],$_POST['charRecord']);
  }
}
?>