<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Process Orders"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
if(isset($_POST['id'])){
    $status = $_POST['placed'];
    
}
$SQL = "SELECT orders.orderNo, orders.orderDateTime,orders.userId,users.userFname,users.userSname,orders.orderStatus,product.prodName,order_line.quantityOrderedFROM orders
JOIN users, product, order_line
WHERE orders.orderStatus = 'Placed' and orders.userId=users.userId and orders.orderNo=order_line.orderNo and order_line.prodId = product.prodId";
$exeOrder = mysqli_query($conn, $SQL) or die (mysqli_error());
echo "<table>";
echo "<th>Order No</th>";
echo "<th>Order Date & Time </th>";
echo "<th>User ID</th>";
echo "<th>User FirstName</th>";
echo "<th>user SurName</th>";
echo "<th>Order Status</th>";
echo "<th>Product Name</th>";
echo "<th>Quantity Ordered </th>";
while($arrayord = mysqli_fetch_array($exeOrder)){
    echo "<tr>";
    echo "<td>".$arrayord['orderNo']."</td>";
    echo "<td>".$arrayord['orderDateTime']."</td>";
    echo "<td>".$arrayord['userId']."</td>";
    echo "<td>".$arrayord['userFname']."</td>";
    echo "<td>".$arrayord['userSname']."</td>";
    echo "<form action='processorders.php' method='post'>";
    if($arrayord['orderStatus']=="Placed"){
        echo "<select name='placed'>";
        echo "<option value='Placed'> Placed </option>";
        echo "<option value='Ready to Collect'>Ready to Collect</option>";
        echo "</select>";
        echo "<input type='submit' value='update'>";
        echo "<input type='hidden' name='id' value=".$arrayord['orderNo'].">";
    }
    else{
        echo "<select name='placed'>";
        echo "<option value='Ready to Collect'> Ready to Collect </option>";
        echo "<option value='Collected' >Collected</option>";
        echo "</select>";
        echo "<input type='submit' value='update'>";
        echo "<input type='hidden' name='id' value=".$arrayord['orderNo'].">";
    }
    echo "</form>";
    echo "<td>".$arrayord['orderStatus']."</td>";
    echo "<td>".$arrayord['prodName']."</td>";
    echo "<td>".$arrayord['quantityOrdered']."</td>";
    echo "</tr>";
}
echo "</table>";
include ("footfile.html");
echo "</body>";
?>