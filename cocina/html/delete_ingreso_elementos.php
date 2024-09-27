<?php

include("connection.php");
$con = connection();

$id=$_GET["id"];

$sql="DELETE FROM ingreso_elementos WHERE id='$id'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: ingreso_elementos.php");
}else{

}

?>