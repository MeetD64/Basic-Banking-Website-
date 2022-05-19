<?php 

$username = "darjime";
$password = "1196052";
$Server = "imc.kean.edu";
$dbname = "dreamhome";

$con = mysqli_connect($Server,$username,$password,$dbname);


if (!$con)
    die ("Connection Failed".mysqli_connect_error());
    
?>    