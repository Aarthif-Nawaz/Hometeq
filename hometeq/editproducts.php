
<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Edit Products"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
if(isset($_POST['prodID'])){
    $newStock = 0;
    $pridtobeupdated = $_POST['prodID'];
    echo $pridtobeupdated;
    $newPrice = $_POST['price'];
    $newQuantity = $_POST['quantity'];
    $newStock = ((int)$newQuantity);

    $oldQuantity = "SELECT * from product where prodId=$pridtobeupdated";
    $exeoldSQL=mysqli_query($conn, $oldQuantity) or die (mysqli_error());
    $arrayqu = mysqli_fetch_array($exeoldSQL);
    $oldQuan = ((int)$arrayqu['prodQuantity']);
    $newStock += $oldQuan;
    if(!empty($newPrice)){
        $update1Sql = "UPDATE product SET prodPrice=$newPrice, prodQuantity=$newStock WHERE prodId=$pridtobeupdated";
        $exeupdateSQL=mysqli_query($conn, $update1Sql) or die (mysqli_error());
    }
    else{
        $update2Sql = "UPDATE product SET prodQuantity=$newStock WHERE prodId=$pridtobeupdated";
        $exeupdateSQL=mysqli_query($conn, $update2Sql) or die (mysqli_error());
    }   
}
//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select * from Product";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
echo "<table style='border: 0px'>";
//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed.
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysqli_fetch_array($exeSQL))
{
echo "<tr>";
echo "<td style='border: 0px'>";
//display the small image whose name is contained in the array 
echo "<img src=Images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
echo "<p>".$arrayp['prodName']."</p><br>";
echo "</a>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<p><h5>".$arrayp['prodName']."</h5>"; //display product name as contained in the array
echo "<p>".$arrayp['prodDescripShort']."</p>";
echo "Current Price : $ <b>".$arrayp['prodPrice']."</b>";
echo "<br>";
echo "Current Stock : <b>".$arrayp['prodQuantity']."</b>";
echo "</td>";
echo "<form action='editproducts.php' method='post'>";
echo "<td style='border: 0px'>";
echo "<p> New Price : </p>";
echo "<input style='size:10;' type='number' name='price'>";
echo "<br>";
echo "<p> Add Number Of Items : </p>";
echo "<input style='size:10;' type='number' min='0' name='quantity'>";
echo "<br>";
echo "</td>";
echo "<td style='border: 0px'>";
$id = $arrayp['prodId'];
echo "<input type='hidden' name='prodID' value=$id>";
echo "<input type='submit' value='Update'>";
echo "</td>";
echo "</tr>";
echo "</form>";
}
echo "</table>";
include ("footfile.html");

echo "</body>";
?>