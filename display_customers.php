<? php 
session_start();


include'index.html';
include'Dbconfig.php';

?>



<?php 

  include'Dbconfig.php';
    echo "<p> The following customers are in the bank system: </p>";
echo "<table border = '1'><tr><th>id </th> <th> name </th> <th> login </th> <th> password</th>  <th> DOB </th> <th> gender </th>  <th> street </th> <th> city </th> <th> state </th><th> zipcode </th></tr>";

$query = "Select id,name,login,password,DOB,gender,street,city,state,zipcode from CPS3740.Customers";



$new = mysqli_query( $con, $query);
while($row = mysqli_fetch_array($new))
    {
        echo"<tr> <td>$row[0] </td><td>$row[1]</td><td>$row[2] </td><td>$row[3] </td> <td>$row[4] </td> <td>$row[5] </td> <td>$row[6] </td> <td>$row[7] </td> <td>$row[8] </td> <td>$row[9] </td> ";
    }



?>