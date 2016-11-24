<?php
session_start();
$username="root";$password="";$database="cheapbooks";
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query = 'SELECT * FROM book b , writtenby w, author a, stocks s WHERE b.ISBN = w.ISBN AND w.ssn = a.ssn AND s.ISBN = b.ISBN';
if (isset($_GET['author'])) {
    $query="SELECT * FROM book b , writtenby w, author a, stocks s WHERE b.ISBN = w.ISBN AND w.ssn = a.ssn AND s.ISBN = b.ISBN AND a.name LIKE '%".$_GET['author']."%'";
}
else if(isset($_GET['title']))
{
    $query="SELECT * FROM book b , writtenby w, author a, stocks s WHERE b.ISBN = w.ISBN AND w.ssn = a.ssn AND s.ISBN = b.ISBN AND b.title LIKE '%".$_GET['title']."%'";
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
        $json = array();
        while ($row= mysql_fetch_assoc($result))
        {
            $incart = 0;

            $queryInCart = "SELECT * FROM shoppingbasket sb, contains c where c.basketID = sb.basketID AND sb.username = '".$_SESSION["username"]."' AND c.ISBN =".$row['ISBN'];;
            $resultInCart=mysql_query($queryInCart);
            if($resultInCart == false)
            {
                echo 'The query failed.';
                echo "<hr/>";
                echo $queryInCart;
                echo "<hr/>";
                echo mysql_error();
                exit();
            }
            else
            {
                $numInCart=mysql_numrows($resultInCart);
                if($numInCart > 0)
                {
                    while ($rowInCart= mysql_fetch_assoc($resultInCart))
                    {

                        $incart = $rowInCart['number'];
                    }
                }
            }
            $stock = $row['number'] - $incart;
            $data = array(
                    'inCart'=> $incart,
                    'number' => $stock,
                    'isbn' => $row['ISBN'],
                    'name' => $row['name'],
                    'title' => $row['title'],
                    'publisher' => $row['publisher'],
                    'price' => $row['price'],
                    'year' => $row['year'],
                    'address' => $row['address'],
                    'phone' => $row['phone']
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