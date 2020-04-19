<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Product Added Details"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
$prodName = $_POST['prodName'];
$prodPicSmall = $_POST['prodSmall'];
$prodPicLarge = $_POST['prodLarge'];
$prodShortDes = $_POST['shortDes'];
$prodLongDes = $_POST['longDes'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

if(!empty($prodName) && !empty($prodPicSmall) && !empty($prodPicLarge) && !empty($prodShortDes) && !empty($prodLongDes) && !empty($price) && !empty($quantity)){

    $insertSQL = "INSERT INTO product(prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity) VALUES ('$prodName','$prodPicSmall','$prodPicLarge','$prodShortDes','$prodLongDes',$price,$quantity)";
    $exeSQL = mysqli_query($conn, $insertSQL);
    
    if(mysqli_errno($conn)==0){
        echo "Your Product Was Added Successfully ! <br>";
        echo "Continue to Index Page <a href='aboutus.php'> Home </a>";
    }
    else{
        echo " Unable to Add Product ! <br>";
        if(mysqli_errno($conn)==1062){
            echo 'Product Name Already Exists !<br>';
            echo "<p>Go Back to Index Page : </p><a href='aboutus.php'> Home </a>";
        }
        elseif(mysqli_errno($conn)==1064){
            echo 'Invalid Characters entered !<br>';
            echo "<p>Go Back to Index Page : </p><a href='aboutus.php'> Home </a>";
        }
        elseif(mysqli_errno($conn)==1054){
            echo 'Illegal Characters have been entered !<br>';
            echo "<p>Go Back to Index Page : </p><a href='aboutus.php'> Home </a>";
        }
    }
}
else{
    echo "Fill in all fields to Add a Product !<br>";
    echo "<p>Go Back to Index Page : </p><a href='aboutus.php'> Home </a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>