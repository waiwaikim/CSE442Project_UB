<?php include('LoginSQL.php'); ?>
<?php include('ConfirmationCode.php'); ?>
<?php

  if (isset($_POST['submit'])) {
	  $confirmation = $_POST['confirmation'];
	  $conn = LoginSQL::sqlConnect();
	  $email="lukemcda@buffalo.edu";//dummy variable until we can get actual email
	  $checkConfirm = LoginSQL::getConfirmCode($conn, $email);
	  if($checkConfirm == $confirmation){
		  $code = $confirmation;
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
	  else{
		 echo "<br> You have input an invalid confirmation code.<br>";
	  }
  }
?>