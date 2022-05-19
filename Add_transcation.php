<?php
session_start();

 
 include('Dbconfig.php');
//include ('Display_Money.php');
 Echo ' <a href = "logout.php" target = _blank > logout </a>';

 
echo"<br>";
 //echo '<font size=4><b>Add Transaction</b></font>';
//echo "<br>";


echo "<b>" .$_COOKIE['c_name']  . "</b> current balance is " . $_SESSION['c_sum'] ;
echo"<br>";


echo "<form action = 'insert_transcation.php'>  ";
echo"<br>";

echo" Transcation Code :";
echo "<input type = 'text' name = 'code'>";
echo"<br>";

echo " <input type = 'radio' name = 'type ' value = 'D'>Deposit";
echo " <input type = 'radio' name = 'type ' value = 'W'>Withdraw";


echo ' <br> Amount: <input type="text" name="amount" required="required">';


$query86904 = " select * from CPS3740.Sources";

$result7678 = mysqli_query($con,$query86904);

if ($result7678){

    echo "<br>Select a Source: <SELECT name='source_id'>";

    while ($row = mysqli_fetch_array($result7678)){
     echo"<option value =" .$row['id']." > " .$row['name'];
     echo "</option>";



    }
    echo "</select>";

}
echo "<br>";
echo " note";
echo "<input type = 'text' name = 'note'>";
echo "<br>";
echo" <input type = 'submit' >";







 
         

?>