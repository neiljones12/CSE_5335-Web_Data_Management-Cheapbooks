<?php
session_start();
$username="root";$password="";$database="cheapbooks";
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query = "SELECT * FROM shoppingbasket s, contains c WHERE s.basketID = c.basketID AND s.username = '".$_SESSION["username"]."'";

$result=mysql_query($query);

$num=mysql_numrows($result);
if($num > 0)
{
    $num = 0;
    while ($row = mysql_fetch_assoc($result))
    {
        if($row['number'] > 0)
        {
            $num = $num + $row['number'];
        }
        else
        {
            $num += 1;
        }
    }
    echo $num;
}
else
{
    echo "(Empty)";
}


?>