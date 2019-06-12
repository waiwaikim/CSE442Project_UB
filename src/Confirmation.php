<?php include('LoginSQL.php'); ?>
<?php include('ConfirmationCode.php'); ?>
<?php

  if (isset($_POST['submit'])) {
	  $confirmation = $_POST['confirmation'];
	  //write custom function to check the table for our code
	  //use this with Confirmcode to get old time, 
	  //check that with new time
	  
	  $code = 
	  $time = strtotime(ConfirmationCode::get_time($code));
	  $newTime = time();
	  $endTime = strtotime("+15 minutes", $time);
	  if($endTime>$newTime){
		//failure
		echo "<br> You have input an expired confirmation code.<br>";
	  }
	  else{
		  //success
		  echo "<br> You have input a correct confirmation code.<br>";
	  }
	  
	  
  }
?>