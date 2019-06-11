<?php include('ValidateEmail.php'); ?>
<?php include('LoginSQL.php'); ?>


<?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    if (Util::is_valid_email($email)) {

      echo 'A confirmation code has been sent to ' ;
      echo $email;
        
    
      //$code = get_code();
      //dummy code is hardcoded until hash function is fixed     
      $code = "dummy123_until_fix";
        
      $conn = sqlConnect(); 
      insertEmail($conn, $email, $code);
        
    
      $conn = sqlConnect(); 
      $code = getConfirmCode($conn, $email);
    
      mail($email, "Course Evaluation Confirmation", "Welcome! Your confirmation code is ".$code);
      header('Location: https://www-student.cse.buffalo.edu/CSE442-542/2019-Summer/cse-442d/confirmation.html');
        
        
    } else {
      echo "Please enter a valid University at Buffalo email address.";
    }

  }
?>