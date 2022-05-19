<?php
session_start();
     
     include ("Dbconfig.php");
      
      

       //$query97609 = "Select m.mid,m.code ,m.type, m.amount,s.name as Source ,m.mydatetime , m.note from CPS3740_2022S.Money_darjime m , CPS3740.Customers c, CPS3740.Sources s where  m.cid = c.id and s.id = m.sid and $c_id = m.cid";

       //"select m.mid as ID ,m.code as Code ,m.type as Type ,m.amount as Amount ,m.mydatetime as Date_Time ,m.note as Note from CPS3740_2022S.Money_darjime m inner join CPS3740.Customers c on m.cid = c.id where $c_id = m.cid";
      

        $query97609 = "Select m.mid,m.code ,m.type, m.amount,s.name as Source ,m.mydatetime , m.note from CPS3740_2022S.Money_darjime m , CPS3740.Customers c, CPS3740.Sources s where  m.cid = c.id and s.id = m.sid and $c_id = m.cid";

      $result09i88 = mysqli_query($con,$query97609);

        $rowcount=mysqli_num_rows($result09i88);

              echo "<br>";
              echo "There are ".$rowcount." transcations for customer  <strong> " .$name .": </strong>";
       
       echo "<table border = '1'><tr><th>ID </th> <th> Code </th> <th> Type </th> <th> Amount </th><th> Source</th>  <th> Date_Time </th> <th> Note </th> </tr>";
          
          $sum = 0;
          while ($row  = mysqli_fetch_array($result09i88)){  
          
          //echo "<table border = '1'><tr><th>ID </th> <th> Code </th> <th> Type </th> <th> Amount </th>  <th> Date_Time </th> <th> Note </th> </tr>";

          echo"<tr> <td>$row[0] </td><td>$row[1]</td> ";     
               
          if ($row[2] == 'W') 
            $rang = " <font color = 'black' > Withdraw</font>";
              
          else 
             $rang = " <font color = 'black' >Deposit</font>";

           echo " <td> $rang </td>";

           if ($row[2] == 'W')
               $rang2 =" <font color = 'red' > $row[3] </font>";
           
           else 
             $rang2 = " <font color = 'blue' >$row[3] </font>";

            echo "<td>$rang2 </td> <td>$row[4] </td> <td>$row[5] </td> <td>$row[6] </td> </tr> ";

            $sum = $sum + $row[3];
            

           

          }
            
          

            
           echo "</table >";

           if ($sum < 0 ){
            echo  " Balance = <font color = 'red' >".$sum ."</font>";

           }

           else 
           {
              echo  " Balance = <font color = 'blue' >".$sum ."</font>";

           }

            $_SESSION['c_sum'] = $sum ;

            
            
           
           //setcookie("c_sum",$sum,time() + 60*60);
           
           
           echo "<br>";
           echo "<br>";
           echo "<br>";
           

           echo '<a href = "Add_transaction.php" target = _blank ><button> Add transactions</button></a>';

          
           echo '<a href = "display_transcations.php" target = _blank >     Display and update transcations </a>';  
           echo '<a href = "display_stores.php" target = _blank >       Display Stores </a>';  
           echo "<br>";
           echo "<br>";
           echo "<br>";

           echo '<TR><TD colspan=2><form action="search_transaction.php" method="get">
                Keyword: <input type="text" name="keywords"  required="required" >
                <input type="submit" value="Search transaction">';
         


           echo"</form>";

           echo $_SESSION['c_sum'];
         
           
       
         
     	

       
?>
