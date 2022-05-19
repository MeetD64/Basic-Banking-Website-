<?php 

include "Dbconfig.php";

 if(!ISSET($_COOKIE['c_id']) ){
     
    echo "please log in again";
    echo "<br>";
    echo "<a href = 'index.html' > Log in  ";

    die() ;

}

else {
       $c_id = $_COOKIE['c_id'];
     //$cookie = 'c_id';

     $kiword = $_GET["keywords"];
   
   //$queri = "Select m.mid,m.code ,m.type, m.amount,s.name as Source ,m.mydatetime , m.note from CPS3740_2022S.Money_darjime m , CPS3740.Customers c, CPS3740.Sources s where  m.cid = c.id and s.id = m.sid and  m.note =  '11111'"; 
   if ( $kiword == '*'){


      

   	 $queri=  "Select m.mid,m.code ,m.type, m.amount,s.name as Source ,m.mydatetime , m.note from CPS3740_2022S.Money_darjime m , CPS3740.Customers c, CPS3740.Sources s where  m.cid = c.id and s.id = m.sid and $c_id = m.cid ";



       }

       else {


      $queri = "Select m.mid,m.code ,m.type, m.amount,s.name as Source ,m.mydatetime , m.note from CPS3740_2022S.Money_darjime m , CPS3740.Customers c, CPS3740.Sources s where  m.cid = c.id and s.id = m.sid and $c_id = m.cid and  m.note like '%$kiword%'";
   
   }
   $res = mysqli_query($con,$queri);
   $rowcount=mysqli_num_rows($res);

   if ($rowcount >= 1 ){
       


     echo " The transactions in Customer" . $_COOKIE['c_name'] . " record matched keyword " . $kiword ; 

  

    echo "<table border = '1'><tr><th>ID </th> <th> Code </th> <th> Type </th> <th> Amount </th><th> Source</th>  <th> Date_Time </th> <th> Note </th> </tr>";
    $sum = 0;
    while ($row  = mysqli_fetch_array($res)){  
          
          //echo "<table border = '1'><tr><th>ID </th> <th> Code </th> <th> Type </th> <th> Amount </th>  <th> Date_Time </th> <th> Note </th> </tr>";

          echo"<tr> <td>$row[0] </td><td>$row[1]</td> ";     
               
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


          

            echo "<td>$rang2 </td> <td>$row[4] </td> <td>$row[5] </td> <td>$row[6] </td> </tr> ";

            //$sum = $sum + $row[3];
            

           

          }
            
          

            
           echo "</table >";
           echo"<br>";
          echo " Total balance : ".$sum;


 }
 else {

 	echo "No transactions found with keyword: $kiword";
 }
  

}
?>