<?php include("LoginSQL.php"); ?>
<?php include("ConfirmationCode.php"); ?>

<?php
  $timeout = 15;
  if (isset($_POST["submit"])) {
    $input = $_POST["confirmation"];
    $email = ConfirmationCode::get_email($input);
    $conn = sqlConnect();
    $code = getConfirmCode($conn, $email);

    if ($input == $code) {
      if (time() - ConfirmationCode::get_time($code) <= $timeout * 60) {
        echo "Logged in successfully!";
      } else {
        echo "Failed to log in: Your code is too old. Please request a new one.";
      }
    } else {
      echo "Failed to log in: This confirmation code is incorrect";
    }

  }
?>
