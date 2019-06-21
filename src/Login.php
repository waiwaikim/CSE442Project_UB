<?php include_once('ValidateEmail.php'); ?>
<?php include_once('LoginSQL.php'); ?>
<?php include_once('ConfirmationCode.php'); ?>



<?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    if (Util::is_valid_email($email)) {

      $conn = sqlConnect();

      //hard-coded values until LOGIN page has a menu to choose from 
      $year = "2019" ;
      $term = "summer"; 
      $class = "cse473";
      //--------------------------------------------------------------
      // DELETE Above once front-end has options/ drop-down menus to choose from
        
      if (!checkValidStudent($conn, $year, $term, $class, $email)){
          echo "You are not a valid active student of the class";
      }
      else{
        $code = ConfirmationCode::get_code($email);

        //runTestSubmissionSQL($email);

        $conn = sqlConnect();
        insertEmail($conn, $year, $term, $class, $email, $code);

        mail($email, "Course Evaluation Confirmation", "Welcome! Your confirmation code is ".$code." \n Please go to: https://www-student.cse.buffalo.edu/CSE442-542/2019-Summer/cse-442d/confirmation.html");
        echo "A confirmation code has been sent to ".$email;
          
  
          
      }

    } else {
      echo "Please enter a valid University at Buffalo email address.";
    }
  }
?>
