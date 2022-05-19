<?php

include "Dbconfig.php";

if(!ISSET($_COOKIE['c_id']) ){
     
    echo "please log in again";
    echo "<br>";
    echo "<a href = 'index.html' > Log in  ";

    die() ;

}

else { 
	Echo "<html>";
   Echo ' <a href = "logout.php" target = _blank > logout </a>';
   Echo "</html>";
   echo "<br>";

   
   $c_id = $_COOKIE['c_id'];  

        $update_count = 0;
        $delete_count = 0;

       $sql2222 = "select mid, code, note from CPS3740_2022S.Money_darjime where cid = $c_id";



       $result32 = mysqli_query($con, $sql2222);

         if (!$result32) {
              exit("error:".mysqli_error($con));
           }
         

       while($row = mysqli_fetch_array($result32)){
            $mid = $row["mid"];
            $note = $row["note"];
            $code = $row["code"];
         
         
         //echo "heyyyy22";

       if (isset($_POST[$code])) {

        $updateNote=$_POST[$code];

        //echo "heyyyy3333";
       
        //$updateNote=$_POST['note'];
        

          if ($note != $updateNote ){


        $sqllll = " update CPS3740_2022S.Money_darjime set note = '$updateNote' where mid = '$mid' ";

       
          $result23 = mysqli_query($con, $sqllll);


          //echo "heyyyy3443";

          //echo $result23;
         //echo "<br>";

          if ( mysqli_affected_rows($con) > 0 ) 
            {echo "Successfully update transaction code:" . $sqllll ; 

            $update_count = $update_count + 1;

            echo '<br>';
          }
             
            
      }
          

      }


      }  


        
       
       
        if(isset($_POST['checkbox'])){ 

        $array = $_POST['checkbox'];
       $listCheck = "'" . implode("','", $array) . "'";

       if (empty($array)) {
     echo 'nothing to delete';
          }

       else {   
       foreach($array as $value) {
      $sql69999 = "DELETE FROM CPS3740_2022S.Money_darjime WHERE mid = $value";
       $delete = mysqli_query ($con,$sql69999);    
          
       
       

       if ( mysqli_affected_rows($con) > 0 ) {



       echo " Successfully delete transaction code:" . $sql69999 ;
       echo '<br>';
       $delete_count = $delete_count + 1;

       }  
     }
 }
   }
      echo '<br>';
      echo " Successfully updated ". $update_count. " transactions and deleted ". $delete_count . " transactions";
       
   }  

?>