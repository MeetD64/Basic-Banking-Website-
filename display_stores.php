<?php


 include'Dbconfig.php';
    echo "<p> The following stores are in the database. </p>";


//echo "<table border = '1'><tr><th>ID </th> <th> Name </th> <th> Address </th> <th> City </th>  <th> State </th> <th> Zipcode </th>  <th> Location </th> </tr>";

$query84788 = "Select sid as ID,Name,address as Address,city as City, State,Zipcode, concat('(',latitude,',' ,longitude,')') as Location  from CPS3740.Stores where Latitude Is not null";

echo "<table border = '1'><tr><th>ID </th> <th> Name </th> <th> Address </th> <th> City </th>  <th> State </th> <th> Zipcode </th>  <th> Location </th> </tr>";

$resultt = mysqli_query( $con, $query84788);
  while($row = mysqli_fetch_array($resultt))
    {
        echo"<tr> <td>$row[0] </td><td>$row[1]</td><td>$row[2] </td><td>$row[3] </td> <td>$row[4] </td> <td>$row[5] </td> <td>$row[6] </td> </td> </tr>";
    }


?>