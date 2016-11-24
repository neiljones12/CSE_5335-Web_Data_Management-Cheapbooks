<?php
session_start();
$username="root";$password="";$database="cheapbooks";
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query = "SELECT * FROM book b , writtenby w, author a, contains c, shoppingbasket sb WHERE b.ISBN = w.ISBN AND w.ssn = a.ssn AND c.ISBN = b.ISBN AND sb.basketID = c.basketID AND sb.username = '".$_SESSION["username"]."'";

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
        $gTotal = 0;
        $json = array();
        while ($row= mysql_fetch_assoc($result))
        {
            $total = $row['number'] *$row['price'];
            $gTotal = $gTotal + $total;
            $data = array(
                'number' => $row['number'],
                'isbn' => $row['ISBN'],
                'name' => $row['name'],
                'title' => $row['title'],
                'publisher' => $row['publisher'],
                'price' => $row['price'],
                'year' => $row['year'],
                'address' => $row['address'],
                'phone' => $row['phone'],
                'total' => $total,
                'gtotal' => $gTotal,
                );

            array_push($json, $data);
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    else{
        echo "0";
    }
}
?>