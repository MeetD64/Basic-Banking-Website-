<?php 

 
 //session_start();

include "Dbconfig.php";
 


 if(!ISSET($_COOKIE['c_id']) ){
     
    echo "please log in again";
    echo "<br>";
    echo "<a href = 'index.html' > Log in  ";

    die() ;

}
 
 $c_id = $_COOKIE['c_id'];


Echo "<html>";
   Echo ' <a href = "logout.php" target = _blank > logout </a>';
   Echo "</html>";
   echo "<br>";
   
   echo " You can only udpdate <strong> note </strong> column";


$query91 = "Select m.mid,m.code ,m.type, m.amount,s.name as Source ,m.mydatetime , m.note from CPS3740_2022S.Money_darjime m , CPS3740.Customers c, CPS3740.Sources s where  m.cid = c.id and s.id = m.sid and $c_id = m.cid";

            $result09 = mysqli_query($con,$query91);

            
              echo "<br>";
              

            echo "<form action = 'update_transaction.php' method = 'POST'>";
            echo "<table border = '1'><tr><th>ID </th> <th> Code </th> <th> Type </th> <th> Amount </th><th> Source</th>  <th> Date_Time </th> <th> Note </th> <th> Delete </th> </tr>";
          
          $sum = 0;

          while ($row  = mysqli_fetch_array($result09)){  


           
           
          //echo "<table border = '1'><tr><th>ID </th> <th> Code </th> <th> Type </th> <th> Amount </th>  <th> Date_Time </th> <th> Note </th> </tr>";

          echo"<tr> <td> " . $row['mid'] . " </td> ";

          $code = $row["code"];


          echo "<td>  " . $code  . "</td> ";     
               
         if ($row[2] == 'W') { 
            $rang = " <font color = 'black' > Withdraw</font>";

              }
          else {
             $rang = " <font color = 'black' >Deposit</font>";
           }

           echo " <td> $rang </td>";
          
           
           
           if ($row[2] == 'W'){

               $rang2 =" <font color = 'red' >".'-' .$row[3]. "</font>";

                $sum -= $row[3];

           }
           else {
             $rang2 = " <font color = 'blue' > $row[3] </font>";
              $sum += $row[3];
              
            }


             $un = $row['code'];


           
                 $NOTE = $row['note'];


            echo "<td>$rang2 </td> <td>$row[4] </td> <td>$row[5] </td> <td> <input type = 'text' name = '$code' value = '$NOTE'style = 'background-color: yellow'  >  </td> <td> <input name='checkbox[]' type='checkbox' id='checkbox[]' value='" . $row['mid'] . "'></td>";


            //<input type= 'checkbox' name='checkbox[]' id = 'checkbox[]' value=" . $row[0] ."></td>";
                  // echo"<input type='hidden'name='$row[0][$i]'value='$row[0]'>";
                  // $i++;

              


            //name = 'Delete[$i]' >  </tr> </td>";
            //<td><input type ='checkbox' value ='$id' name='Delete[$i]'>";


            //$sum = $sum + $row[3];
            

           
             
          }
            
          
           //setcookie("c_name",$row[4],time() + 60*60);
            
           echo "</table >"; 
           echo " Total balance : ".$sum;
           echo "<br>";
           echo " <input type = 'submit' value = 'update transaction' >";
           echo "</form>";



?>












