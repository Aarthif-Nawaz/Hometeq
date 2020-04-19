<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Your Login Results"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
$email = $_POST['email'];
$pass = $_POST['pass'];
if(!empty($email) && !empty($pass)){
    // echo  "<p> Entered Email ID :".$email."</p>";
    // echo  "<p> Entered Password :".$pass."</p>";
    $exeSQL = "Select * from users where userEmail = '".$email."'";
    $exeprodSQL=mysqli_query($conn, $exeSQL) or die (mysqli_error());
    $UserArray = mysqli_fetch_array($exeprodSQL);
    if($UserArray['userEmail']!=$email){
        echo "Email Not Recognized";
    }
    else{
        if($UserArray['userPassword']!=$pass){
            echo "Password not recognized !";
        }
        else{
            echo "Login Success !";
            $_SESSION['userEmail'] = $UserArray['userEmail'];
            $_SESSION['userId'] = $UserArray['userId'];
            $_SESSION['fname'] = $UserArray['userFname'];
            $_SESSION['lname'] = $UserArray['userSname'];
            if($UserArray['userType']==1){
                $_SESSION['userType'] = "Administrator";
                echo "Welcome Administrator ".$_SESSION['fname'].$_SESSION['lname'];
                echo "<a href='aboutus.php'> Home </a>";
            }
            else{
                $_SESSION['userType'] = "Customer";
                echo "Welcome ".$_SESSION['fname']." ".$_SESSION['lname'];
                echo "<br>";
                echo "Welcome You are Precious ".$_SESSION['userType'];
                echo "<br>";
                echo "<p>Continue Shopping : </p><a href='aboutus.php'>HomeTech</a>";
                echo "<br>";
                echo "<p>Your Basket : </p><a href='basket.php'>Basket</a>";

            }
        }

    }
}
else{
    echo "Fill in all fields to Login !<br>";
    echo "<p>Go Back to Login Page : </p><a href='login.php'>Login</a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>