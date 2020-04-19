<?php
$pagename="FIRST PAGE";

echo "<html>";
echo "<head>";
echo "<title>My ".$pagename."</title>";
echo "<link rel=stylesheet type=text/css href=simplestyle.css>";
echo "</head>";

echo "<body>";
echo "<center>";
echo "<h1>YOUR FAVOURITE STORE</h1>";
echo "<hr>";
echo date ('l d F Y h:i:s');
echo "<br>London, UK";
echo "<hr>";
echo "<a href=prodindex.php>Product Index</a>";
echo "||<a href=basket.php>My Basket</a>";
echo "||<a href=clearbasket.php>Clear Basket</a>";
echo "<hr>";
echo "<h2>".$pagename."</h2>";

echo "<form method=post action=secondpage.php>" ;
echo "<table border=1>";
echo "<tr><td>Username</td>";
echo "<td><input type=text name=txtbx_usrn size=35></td></tr>";
echo "<tr><td>Password </td>";
echo "<td><input type=password name=txtbx_pwd size=35></td></tr>";
echo "<tr><td><input type=submit value='Login'></td>";
echo "<td><input type=reset value='Clear Form'></td></tr>";
echo "</table>";
echo "</form>" ;

echo "</center>";
echo "</body>";
echo "</html>";
?>













<?php
session_start();
include("db.php");
$pagename="SECOND PAGE";

echo "<html>";
echo "<head><link rel=stylesheet type=text/css href=nicestyle.css></head>";
echo "<body>";
echo "<center>";
echo "<h1> YOUR FAVOURITE STORE </h1>";
echo "<h2>".$pagename."</h2>";

$usrn=$_POST['txtbx_usrn'];
$pwd=$_POST['txtbx_pwd'];

if (empty($usrn) or empty($pwd))
{
	echo "<p>Your form is incomplete";
	echo "<br>Back to <a href=firstpage.php>login</a>";
}
else
{
	$SQL="select * from users where username = '".$usrn."'";
	$exeSQL=mysqli_query($conn,$SQL) or die(mysqli_error($conn));
	$Array=mysqli_fetch_array($exeSQL);

	if ($Array['username']== $usrn and $Array['password']== $pwd)
	{
		$_SESSION['uid']=$Array['userId'];
		$_SESSION['ufn']=$Array['userFirstName'];
		$_SESSION['usn']=$Array['username'];
		echo "<p>Hello, ".$_SESSION['ufn']."! ";
		echo "<br>Your username is ".$_SESSION['usn'];
		echo "<br>Your password is secret";
		echo "<br><a href=index.php>Continue Shopping</a>";
	}
	else
	{
		if ($userArray['username'] <> $usrn)
		{
			echo "<p>Sorry this username was not recognized!";
			echo "<p>Please go back to <a href=firstpage.php>login</a>";
		}
		else
		{
			echo "<p>Sorry this password is not valid!";
			echo "<p>Please go back to <a href=firstpage.php>login</a>";
		}
	}
}
echo "</center>";
echo "</body>";
echo "</html>";
?>
































































































<?php
include ("db.php");
$pagename="Start";
echo "<link rel=stylesheet type=text/css href=sheet.css>";
echo "<title>".$pagename."</title>";
echo "<h1>AdSmart</h1>";
echo "<p></p>";
echo "<h2>".$pagename."</h2>";

echo "<p><b>To view more info, click on one of these:  </b>";
$SQL1="select agencyNo, agencyName from Agency";
$exeSQL1=mysqli_query($c, $SQL1) or die (mysqli_error($c));
while ($thing1=mysqli_fetch_array($exeSQL1))
{
	echo "<a href=details.php?agid=".$thing1['agencyNo'].">";
	echo "<br>".$thing1['agencyName'];
	echo "</a>";
}

echo "<p><b> Alternatively to view more info, choose one of these: </b>";
$SQL2="select designerId, desFullName from Designer";
$exeSQL2=mysqli_query($c, $SQL2) or die (mysqli_error($c));
while ($thing2=mysqli_fetch_array($exeSQL2))
{
	echo "<a href=details.php?desid=".$thing2['designerId'].">";
	echo "<br>".$thing2['desFullName'];
	echo "</a>";
}

?>
<?php
include ("db.php");
$pagename="Details";
echo "<title>".$pagename."</title>";
echo "<h1>adSmart</h1>";
echo "<p></p>";
echo "<h2>".$pagename."</h2>";

$id1=$_GET['agid'];
$id2=$_GET['desid'];

if (!isset($id1) and !isset($id2))
{
	echo "<br>Problem with your choice";
	echo "<br>Back to <a href=startpage.php>start page</a>"; 
}
else
{
	if (isset($id1))
	{
		echo "<p>Info on agencies and their advertising campaigns";
		$SQL3="select agencyName 
		from Agency where agencyNo=".$id1;
		$exeSQL3=mysqli_query($c,$SQL3) or die (mysqli_error($c));
		$thing3=mysqli_fetch_array($exeSQL3);
			
		$SQL4="select cpCode, cpName, cpStartDate, cpEndDate
		from Campaign where agencyNo=".$id1;
		$exeSQL4=mysqli_query($c,$SQL4) or die (mysqli_error($c));
		
		echo "<p><b>".strtoupper($thing3['agencyName'])."</b>";
		
		while ($thing4=mysqli_fetch_array($exeSQL4)) 
		{
			echo "<br>The campaign ".$thing4['cpName'];
			echo " runs from ".$thing4['cpStartDate'];
			echo " to ".$thing4['cpEndDate'];
		}
	}
	else
	{
        echo "<p>Info on designers and their created advertisements";

        $GETDESIGNSQL = "SELECT * FROM Designer WHERE designerId=".$id2;
        $exeGETSQL = mysqli_query($c,$GETDESIGNSQL) or die (mysqli_error($c));
        $results = mysqli_fetch_array($exeGETSQL);

        $SQL5 = "SELECT * FROM Advertisement WHERE designerId=".$id2;
        $exeSQL5=mysqli_query($c,$SQL5) or die (mysqli_error($c));

        echo "<p><b>".strtoupper($results['desFullName'])."</b>";

        while ($thing5=mysqli_fetch_array($exeSQL5)) 
		{
			echo "<br> The Advertisement ".$thing5['adName'];
			echo " costs ".$thing5['adCost'];
			echo " and was advertised on ".$thing5['adDate'];
		}




		
		//CODE FOR QUESTION 7 NEEDS TO FIT RIGHT HERE		
	}
}
?>

