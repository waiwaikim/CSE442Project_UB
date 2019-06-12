<?php include('ValidateEmail.php'); ?>
<?php include('LoginSQL.php'); ?>
<?php include('ConfirmationCode.php'); ?>

<?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    if (Util::is_valid_email($email)) {
      $code = ConfirmationCode::get_code();
      $conn = sqlConnect();
      insertEmail($conn, $email, $code);
    
      mail($email, "Course Evaluation Confirmation", "Welcome! Your confirmation code is ".$code);
      header('Location: https://www-student.cse.buffalo.edu/CSE442-542/2019-Summer/cse-442d/confirmation.html');
        
        
    } else {
      echo "Please enter a valid University at Buffalo email address.";
    }
  }
?>
