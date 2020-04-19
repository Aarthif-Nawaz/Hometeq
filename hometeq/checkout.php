<?php
session_start();
include ("connection.php"); //include db.php file to connect to DB
include ("detectlogin.php");
$pagename="Your Login Results"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<body>";
date_default_timezone_set("Asia/Colombo");
$subtotal = 0;
$total = 0;
$userId = $_SESSION['userId'];
$currentdatetime = date("Y-m-d H:i:s");
$sql = "INSERT INTO orders (userId, orderDateTime, orderStatus) VALUES ($userId,'$currentdatetime','Placed')";
$exeSQL = mysqli_query($conn, $sql) or die (mysqli_error());
if(mysqli_errno($conn)==0){
    $maxOrder = "SELECT * FROM orders ORDER BY orderNo DESC";
    $exemaxOrder = mysqli_query($conn, $maxOrder) or die (mysqli_error());
    $arrayord = mysqli_fetch_array($exemaxOrder);
    $orderNumber = $arrayord['orderNo'];
    echo "Your Order has been placed Successfullly ".$orderNumber;
    echo "<table>";
    echo "<th> Product Name </th>";
    echo "<th> Price </th>";
    echo "<th> Quantity </th>";
    echo "<th> Sub Total </th>";

    foreach ($_SESSION['basket'] as $index => $value) {
        $prod = "SELECT * FROM product WHERE prodId=$index";
        $exeprod = mysqli_query($conn, $prod) or die (mysqli_error());
        $arrayb =  mysqli_fetch_array($exeprod);
        $subtotal = $arrayb['prodPrice'] * $value;

        $orderLine = "INSERT INTO order_line (orderNo, prodId, quantityOrdered, subTotal) VALUES ($orderNumber,$index,$value,$subtotal)";
        $exeOrderLine = mysqli_query($conn, $orderLine) or die (mysqli_error());
        echo "<tr>";
        echo "<td>".$arrayb['prodName']."</td>";
        echo "<td>".$arrayb['prodPrice']."</td>";
        echo "<td>".$value."</td>";
        echo "<td>".$subtotal."</td>";
        echo "</tr>";
        $total += $subtotal;

    }
    echo "<tr><td colspan='3'> Total </td>";
    echo "<td>".$total."</td></tr>";
    echo "</table>";
    $update = "UPDATE orders SET orderTotal=$total WHERE orderNo=$orderNumber";
    $exeUpdate = mysqli_query($conn, $update) or die (mysqli_error());
    echo "<br>";
    echo "<a href='logout.php'> Logout </a>";
}
else{
    echo "There has been an error placing the order <br>";
}
unset($_SESSION['basket']);
include ("footfile.html");
echo "</body>";
?>