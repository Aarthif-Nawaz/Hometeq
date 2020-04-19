<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); 
$pagename="Send Message"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<form action='message_process.php' method='post'>";
echo "<table>";
echo "<tr>";
echo "<td> <label> To </label></td>";
echo "<td> <input type='email' name='name' placeholder='Please Enter Recievers Name '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Subject </label></td>";
echo "<td> <input type='text' name='subject' placeholder='Please Enter the Subject'></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Message </label></td>";
echo "<td> <textarea colspan=5 rowspan=10 name='message' placeholder='Please Enter Message '></textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <input type='submit' value='Send'></td>";
echo "<td> <input type='reset'  value='Clear'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>