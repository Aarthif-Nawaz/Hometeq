<?php
if(isset($_SESSION['userId'])){
    echo "<p style='float:right;width:20%;margin-top:40px;'>" .$_SESSION['fname']." ".$_SESSION['lname']." | ".$_SESSION['userType']." ".$_SESSION['userId']."</p>";
}
?>