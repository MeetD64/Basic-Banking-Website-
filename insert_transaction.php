<?php
  session_start();
  include("Dbconfig.php");

  
 $transaction_code = $_POST["code"];
 $transaction_type = $_POST["type"];
 $transaction_amount = $_POST["amount"];
 $transaction_sourceid = $_POST["source_id"];
 $transaction_note = $_POST["note"];
 $c_id = $_COOKIE['c_id'];
 //$c_sum = $_COOKIE['c_sum'];
     
  //$_SESSION['c_sum']


    if ($_SESSION['c_sum'] < $transaction_amount){

            if  ($transaction_type =='W'){

              echo " Error! Customer can not withraw more then total amount in Bank account";
              die();
       }
   }


    if($transaction_amount < 0){

      echo " please add positive amount ";
      die();
      
    }          

    
   

     //(code ,type, amount,sid ,mydatetime , cid , note) values ( '$transaction_code','$transaction_type', $transaction_amount,$transaction_sourceid, 'NOW()', $c_id, '$transaction_note')


   //$query9865 = (" insert into CPS3740_2022S.Money_darjime (mid ,code,amount,mydatetime,note ) values ( 99 , $transaction_code,  $transaction_amount, 'NOW()', '$transaction_note') ");


   $query9865 = (" insert into CPS3740_2022S.Money_darjime (code ,cid, type,amount,mydatetime,note,sid) values ( $transaction_code,$c_id,
    '$transaction_type',$transaction_amount,NOW(),'$transaction_note', $transaction_sourceid)");

   $result8999 = mysqli_query($con,$query9865);

   if( !$result8999 ){

   	echo  "Error: " . $query9865 . "<br>" . mysqli_error($con) ;
    
  
   }
     


   


   else {
      echo ' you have sucessfully inserted.';


      if ($transaction_type =='W'){

          echo"<br>";
          echo"<br>";

          $total = $_SESSION['c_sum'] -  $transaction_amount ;
         echo " final balance ". $total ;
      }

      else 
      {
        echo"<br>";
          echo"<br>";

          $total = $_SESSION['c_sum'] +  $transaction_amount ;
         echo " final balance ". $total ;
      
      }
   }

	?>