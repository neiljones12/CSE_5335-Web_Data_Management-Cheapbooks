<?php
session_start();
$username="root";$password="";$database="cheapbooks";
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query = "SELECT * FROM shoppingbasket WHERE username = '".$_SESSION["username"]."'";

$result=mysql_query($query);
$basketID = 0;
$num=mysql_numrows($result);
if($num > 0)
{
    while ($row= mysql_fetch_assoc($result))
    {
        $basketID = $row['basketID'];
    }
}
else
{
    $queryBasket = "SELECT * FROM shoppingbasket";
    $resultBasket=mysql_query($queryBasket);
    $numBasket=mysql_numrows($resultBasket);

    $newID = $numBasket + 1;

    $queryRegister = "INSERT INTO shoppingBasket (basketID,username)VALUES ('{$newID}','{$_SESSION["username"]}')";
    $resultRegister=mysql_query($queryRegister);
    if($resultRegister == false)
    {
        echo 'The query failed.';
        echo "<hr/>";
        echo $queryRegister;
        echo "<hr/>";
        echo mysql_error();
        exit();
    }
    else
    {
        $basketID = $newID;
    }
}

$queryContains = "SELECT * FROM contains where basketID =".$basketID." AND ISBN=".$_GET['isbn'];
$resultContains=mysql_query($queryContains);
$numContains=mysql_numrows($resultContains);
if($numContains > 0)
{
    while ($row = mysql_fetch_assoc($resultContains))
    {
        $num = $row['number'] + 1;
        $queryUpdateContains = "UPDATE contains SET number =".$num." WHERE basketID =".$basketID." AND ISBN=".$_GET['isbn'];
        $resultUpdateContains=mysql_query($queryUpdateContains);
        if($resultUpdateContains == false)
        {
            echo 'The query failed.';
            echo "<hr/>";
            echo $queryUpdateContains;
            echo "<hr/>";
            echo mysql_error();
            exit();
        }
    }
}
else
{
    $queryInsertContains = "INSERT INTO contains (basketID,ISBN,number)VALUES ('{$basketID}','{$_GET['isbn']}',0)";
    $resultInsertContains=mysql_query($queryInsertContains);
    if($resultInsertContains == false)
    {
        echo 'The query failed.';
        echo "<hr/>";
        echo $queryInsertContains;
        echo "<hr/>";
        echo mysql_error();
        exit();
    }
}

?>