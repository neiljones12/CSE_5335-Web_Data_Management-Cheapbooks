<?php
$username="root";$password="";$database="cheapbooks";
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query = 'SELECT * FROM Customer';
if (isset($_GET['username'])) {
    $query="SELECT * FROM Customer WHERE username = '".$_GET['username']."'";
}
$result=mysql_query($query);
if($result == false)
{
    echo 'The query failed.';
    echo "<hr/>";
    echo $query;
    echo "<hr/>";
    echo mysql_error();
    exit();
}
else
{
    $num=mysql_numrows($result);
    if($num > 0)
    {
        while ($row = mysql_fetch_assoc($result))
        {
            echo "{$row['username']}";
            echo "{$row['password']}";
        }
    }
    else{
        if(isset($_GET['username']))
        {
            $queryRegister = "INSERT INTO Customer (username,password,email,address,phone)VALUES ('{$_GET['username']}','{$_GET['password']}','{$_GET['username']}','','')";
            $resultRegister=mysql_query($queryRegister);
            if($resultRegister == false)
            {
                echo 'The query failed.';
                echo "<hr/>";
                echo $query;
                echo "<hr/>";
                echo mysql_error();
                exit();
            }
            else
            {
                echo "Success";
            }
        }
        else
        {
            echo "error";
        }
    }
}
?>