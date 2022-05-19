
<?php
// Session starts from here 
session_start();
// including my server information and connections
include "Dbconfig.php";

 


      
// if to check username and password is set.
if (isset($_POST["username"]) && isset($_POST["password"])) {

  //using post method getting a username and password
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  //query to check if username exists in our database.
  $query = " SELECT * FROM CPS3740.Customers WHERE login = '$username'";
  $result = mysqli_query($con,$query);
  
  // if there is any result is saved it will go in.
  if ($result) {

     // only goes to if there is no result with the username in database.
    if (mysqli_num_rows($result)==0) {
       
           Echo "<html>";

           //logout link.
             Echo ' <a href = "logout.php" target = _blank > logout </a>';
             Echo "</html>";

         //Gets your IP adrress and prints on web page.
        $ip = $_SERVER['REMOTE_ADDR'];
            echo "<br> Your IP: $ip\n ";
               echo ("<br>");

          // gets you Operating System information and prints on web page.     
                 echo $_SERVER[ 'HTTP_USER_AGENT'];
                   echo "<br/>";

          // checks if your IP is from Kean University or not.


                   
                   $IPV4 = explode(".",$ip);
           if (($IPV4[0] ="131" && $IPV4[1] = "125" || $IPv4[0] = "10")){

           echo "<br> You are from Kean University.\n </br>";
               }
           else {
            echo (" you are not from kean University.");
           }
          
           echo "<br> User ". $username ." is not in the database </br>";

           Echo "<html>";
             Echo ' <a href = "index.html" target = _blank > Project Home page </a>';
             Echo "</html>";


           

           
           
     }
     // goes to else if there is one or more than one result from first if.

    else {

      // Now it checks both if username and password both matches.
      $query = " SELECT * FROM CPS3740.Customers WHERE login = '$username' AND password = '$password'";

      //give connection to our query 
      $result = mysqli_query($con,$query);
      
      //if there is no result then it will go in because only username matched not password.
      if (mysqli_num_rows($result)==0) {
        
        //link to logout

        Echo "<html>";
             Echo ' <a href = "logout.php" target = _blank > logout </a>';
             Echo "</html>";

        $ip = $_SERVER['REMOTE_ADDR'];
            echo "<br> Your IP: $ip\n ";
               
            echo ("<br>");
                 echo $_SERVER[ 'HTTP_USER_AGENT'];
                   echo "<br/>";

                   $IPV4 = explode(".",$ip);
           if (($IPV4[0] ="131" && $IPV4[1] = "125" || $IPv4[0]="10")){

           echo "<br> You are from Kean University.\n </br>";
               }
           else {
            echo (" you are not from kean University.");
           }
              echo "<br>";
             echo "User ". $username ." is in the system, but wrong password was entered.";
           
            echo "<br>";
           Echo "<html>";
             Echo ' <a href = "index.html" target = _blank > Project Home page </a>';
             Echo "</html>";
        

        }
    else {
            Echo "<html>";
             Echo ' <a href = "logout.php" target = _blank >User logout </a>';
             Echo "</html>";

        { $ip = $_SERVER['REMOTE_ADDR'];
            echo "<br> Your IP: $ip\n";
               
            echo ("<br>");
                 echo $_SERVER[ 'HTTP_USER_AGENT'];
                   //echo "<br/>";
                  
                   


            $IPV4 = explode(".",$ip);
           if (($IPV4[0] = "131" && $IPV4[1] = "125" || $IPv4[0] ="10")){

           echo "<br> You are from Kean University.\n";
        }
           else {
            echo (" you are not from kean University.");
           }
        
      
        // if there is a result from table.
        if ($result) {
          while($row=mysqli_fetch_array($result)) {
            
            //fetching data to assign in variables.
            $name = $row["name"];
            $DOB= $row["DOB"];
            $street = $row["street"];
            $city = $row["city"];
            $zipcode = $row["zipcode"];
            $gender = $row["gender"];
            $img = $row["img"];
            $c_id = $row["id"];
                 
                 //assigning cookies to column.

            setcookie("c_id" ,$c_id,time() + 60*60);
            setcookie("c_name",$name,time() + 60*60);
            
            
            echo ("<br>");
            
            //printing out customer name
            echo "Welcome Customer: <strong> ". $name  . " </strong> <br>";
           
              
             // age from birthday
            $_age = floor((time() - strtotime($DOB)) / 31556926);
                              
             // age print
            echo "age: ". $_age ."<br>";

            
           // printing address
            echo "Address: ". $street ."  "  .$city ." ".$zipcode ."<br>";

           
           // printing customer image
            echo '<img src="data:img/jpeg;base64,'.base64_encode($img).'"/>';


           


           // query to get transactions from the customer which logged in.
            $query97609 = "Select m.mid,m.code ,m.type, m.amount,s.name as Source ,m.mydatetime , m.note from CPS3740_2022S.Money_darjime m , CPS3740.Customers c, CPS3740.Sources s where  m.cid = c.id and s.id = m.sid and $c_id = m.cid";

    
            

            //connection to DB
            $result09i88 = mysqli_query($con,$query97609);

            // counting rows in our result.
            $rowcount=mysqli_num_rows($result09i88);

              echo "<br>";
              echo "There are ".$rowcount." transcations for customer  <strong> " .$name .": </strong>";
           
           //table headers
            echo "<table border = '1'><tr><th>ID </th> <th> Code </th> <th> Type </th> <th> Amount </th><th> Source</th>  <th> Date_Time </th> <th> Note </th> </tr>";
          
          $sum = 0;
          //fetching data from table columns
          while ($row  = mysqli_fetch_array($result09i88)){  
          
          
           // tables rows and table data 
          echo"<tr> <td>$row[0] </td><td>$row[1]</td> ";     
               
               //prints as withdraw since there is W in table.
         if ($row[2] == 'W') { 
            $rang = " <font color = 'black' > Withdraw</font>";

              }
          else {
             $rang = " <font color = 'black' >Deposit</font>";
           }

           echo " <td> $rang </td>";
          
           
           //if amount is in W then it prints in red color
           if ($row[2] == 'W'){

               $rang2 =" <font color = 'red' >".'-' .$row[3]. "</font>";

                $sum -= $row[3];

           }
           else {
             $rang2 = " <font color = 'blue' > $row[3] </font>";
              $sum += $row[3];
              
            }


          

            echo "<td>$rang2 </td> <td>$row[4] </td> <td>$row[5] </td> <td>$row[6] </td> </tr> ";

            
            

           

          }
            
          

            
           echo "</table >";

             // sum is less then 0 it prints in red
           if ($sum < 0 ){
            echo  " Balance = <font color = 'red' >".$sum ."</font>";

           }

           else 
           {
              echo  " Balance = <font color = 'blue' >".$sum ."</font>";

           }
           
           //using session to save sum value.
            $_SESSION['c_sum'] = $sum ;


           //setcookie("c_sum" ,$sum,time() + 60*60);

            
            
           
           
           
           
           echo "<br>";
           echo "<br>";
           echo "<br>";
           
             // link to add transaction.
           echo '<a href = "Add_transaction.php" target = _blank ><button> Add transactions</button></a>';
        
          echo "  _______";

          //link to display and update transaction.

           echo '<a href = "display_transcations.php" target = _blank >     Display and update transcations </a>';  
           echo "  _______";

           // link to display Staff.
           echo '<a href = "display_stores.php" target = _blank >       Display Stores </a>';  
           echo "<br>";
           echo "<br>";
           echo "<br>";
           
           //textbox to search for keyword 
           echo '<TR><TD colspan=2><form action="search_transaction.php" method="get">
                Keyword: <input type="text" name="keywords"  required="required" >
                <input type="submit" value="Search transaction">';


           


           echo"</form>";
           
           




            }
          }
        }
      }
    }
  }
}




?>

