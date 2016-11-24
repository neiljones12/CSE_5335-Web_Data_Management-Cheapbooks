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
    while ($rowB= mysql_fetch_assoc($result))
    {
        $basketID = $rowB['basketID'];
        $queryContains = "SELECT * FROM contains where basketID =".$basketID;
        $resultContains=mysql_query($queryContains);
        $numContains=mysql_numrows($resultContains);
        if($numContains > 0)
        {
            while ($row = mysql_fetch_assoc($resultContains))
            {
                $queryStock = "SELECT * FROM stocks where ISBN =".$row['ISBN'];
                $resultStock=mysql_query($queryStock);
                $numStock=mysql_numrows($resultStock);
                if($numStock > 0)
                {
                    while ($rowStock = mysql_fetch_assoc($resultStock))
                    {
                        $num = $rowStock['number'] - $row['number'];
                        $queryStockUpdate = 'UPDATE stocks SET number = '.$num.' WHERE ISBN = '.$row['ISBN'];
                        $resultStockUpdate=mysql_query($queryStockUpdate);

                        $queryDelete = "DELETE FROM contains where basketID =".$basketID;
                        $resultDelete=mysql_query($queryDelete);
                    }
                }
            }
        }
    }
}
else
{

}
?>