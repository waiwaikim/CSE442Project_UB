<?php include_once("LoginSQL.php"); ?>
<?php include_once("ConfirmationCode.php"); ?>
<?php include_once("submissionSQL.php"); ?>
<?php include_once("EvalForm.php"); ?>

<?php
  $timeout = 15;
  if (isset($_POST["submit"])) {
    $input = $_POST["confirmation"];
    $email = ConfirmationCode::get_email($input);
    $class = ConfirmationCode::get_current_class($input);
    
    $conn = sqlConnect();
    
    $year = "2019" ;
    $term = "summer"; 
      
    $code = getConfirmCode($conn, $year, $term, $class, $email);

    if ($input == $code) {
      if (time() - ConfirmationCode::get_time($code) <= $timeout * 60) {
          setcookie("email", $email, 2147483647);
          setcookie("class", $class, 2147483647);
          echo get_form(getTeammates($year, $term, $class, $email));
      } else {
        echo "Failed to log in: Your code is too old. Please request a new one.";
      }
    } else {
      echo "Failed to log in: This confirmation code is incorrect";
    }
  }
?>

