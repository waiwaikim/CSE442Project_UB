<?php include('Util.php'); ?>
<?php include('ConfirmationCode.php'); ?>
<?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    if (Util::is_valid_email($email)) {
      echo 'A confirmation code has been sent to ' ;
      echo $email;

      $code = get_code();
      mail($email, "Course Evaluation Confirmation", "Welcome! Your confirmation code is ".$code);
    } else {
      echo "Please enter a valid University at Buffalo email address.";
    }
  }
?>
