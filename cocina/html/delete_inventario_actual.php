<?php

include("connection.php");
$con = connection();

$id=$_GET["id"];

$sql="DELETE FROM inventario WHERE id='$id'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: inventario_actual.php");
}else{

}

?>