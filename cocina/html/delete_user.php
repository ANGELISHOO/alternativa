<?php

include("connection.php");
$con = connection();

$id=$_GET["id"];

$sql="DELETE FROM Usuarios WHERE id='$id'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: crud_usuarios.php");
}else{

}

?>