<?php
include ("detectlogin.php");
include ("connection.php");
if(isset($_POST['delmsgId'])){
    $getId = $_POST['delmsgId'];
    try{
        $delquery = "DELETE FROM chat WHERE msg_id=$getId";
        $exeprodSQL4=mysqli_query($conn, $delquery);
        echo "Successfully Deleted";
    }catch(Exception $ex){
        echo "Cannot Delete Query";
    }
}
?>