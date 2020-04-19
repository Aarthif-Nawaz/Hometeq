
<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB

$pagename="Make your home smart"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
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
echo "<a style='text-decoration:none;color:black;' href=prodInfo.php?u_prod_id=".$arrayp['prodId'].">"; 
echo "<img src=Images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
echo "<p>".$arrayp['prodName']."</p><br>";
echo "</a>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<p><h5>".$arrayp['prodName']."</h5>"; //display product name as contained in the array
echo "<p>".$arrayp['prodDescripShort']."</p>";
echo "<b> $".$arrayp['prodPrice']."</b>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<form action='wishlist.php' method='POST'>";
echo "<input type='hidden' name='wishid' value=".$arrayp['prodId'].">";
echo "<input type='submit' value='Add to Wishlist'>";
echo "</form>";
echo "</td>";
echo "</tr>";
}
echo "</table>";
include ("footfile.html");

echo "</body>";
?>