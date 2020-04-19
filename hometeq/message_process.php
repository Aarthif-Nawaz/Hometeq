<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Message Status"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";

$SenderSQL = "Select * from users where userEmail ='".$_SESSION['userEmail']."'";
$exeSenderSQL=mysqli_query($conn, $SenderSQL);
$UserArrayS = mysqli_fetch_array($exeSenderSQL);
$sender = $UserArrayS['userFname']." ".$UserArrayS['userSname'];

$Select = "SELECT * FROM chat where sender='$sender'";
$exeSelect=mysqli_query($conn, $Select);
while($Arrayu1 = mysqli_fetch_array($exeSelect)){
echo "<p> Sent to : <b>".$Arrayu1['reciever']."</b></p><br>";
echo "<p> Subject : <b>".$Arrayu1['subject']."</b></p><br>";
echo "<p> Message : <b>".$Arrayu1['message']."</b></p><br>";
echo "<form action='update_process.php' method='post'>";
echo "<input type='hidden' name='upID' value=".$Arrayu1['msg_id'].">";
echo "<input type='submit' value='Update'>";
echo "</form>";
echo "<form action='delete_process.php' method='post'>";
echo "<input type='hidden' name='delmsgId' value=".$Arrayu1['msg_id'].">";
echo "<input type='submit' value='Delete'>";
echo "</form>";
}

$reciever = $_POST['name'];
$subject = $_POST['subject'];
$message = $_POST['message'];
if(!empty($reciever) && !empty($subject) && !empty($message)){
    $exeSQL = "Select * from users where userEmail ='".$_SESSION['userEmail']."'";
    try{
        $exeprodSQL=mysqli_query($conn, $exeSQL);
        $UserArray = mysqli_fetch_array($exeprodSQL);
        $sender = $UserArray['userFname']." ".$UserArray['userSname'];
        $exeGetSQL = "Select * from users where userEmail ='".$reciever."'";
        try{
            $exeGETSQL1=mysqli_query($conn, $exeGetSQL);
            $INSERT_SQL = "INSERT INTO chat (sender, subject, message, reciever) VALUES ('$sender','$subject','$message','$reciever')";
            try{
                $exeprodSQL2=mysqli_query($conn, $INSERT_SQL);
                try{
                    $getQuery = "SELECT * from chat ORDER BY msg_id DESC"; // To get the latest sent message
                    $exeprodSQL3=mysqli_query($conn, $getQuery);
                    $messageArray = mysqli_fetch_array($exeprodSQL3);
                    $id = $messageArray['msg_id'];
                    echo "<p> Sent to : <b>".$messageArray['reciever']."</b></p><br>";
                    echo "<p> Subject : <b>".$messageArray['subject']."</b></p><br>";
                    echo "<p> Message : <b>".$messageArray['message']."</b></p><br>";
                    echo "<form action='update_process.php' method='post'>";
                    echo "<input type='hidden' name='upmsgId' value=$id>";
                    echo "<input type='submit' value='Update'>";
                    echo "</form>";
                    echo "<form action='delete_process.php' method='post'>";
                    echo "<input type='hidden' name='delmsgId' value=$id>";
                    echo "<input type='submit' value='Delete'>";
                    echo "</form>";
                }catch(Exception $ex){
                    echo "Message not found";
                }
            
            }catch(Exception $ex){
                echo "Unable to send message";
            }
        }catch(Exception $ex){
            echo "Cant Send message to this reciever..User does not exist";
        }
    }catch(Exception $ex){
        echo "Cant send message, You Need to Login";
        echo "<a href='login.php'>Go back to login page </a>";
    }

}
else{
    echo "Fill in all fields to Send Message !<br>";
    echo "<p>Go Back to Login Page : </p><a href='login.php'>Login</a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>