<?php include('Util.php'); ?>
<?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    if (Util::is_valid_email($email)) {
      echo 'A confirmation code has been sent to ' ;
      echo $email;
      mail($email, "Course Evaluation Confirmation", "Welcome! Your confirmation code is N38DNJ9");
    } else {
      echo "Please enter a valid University at Buffalo email address.";
    }
  }
?>