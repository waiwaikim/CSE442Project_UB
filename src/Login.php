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


    $servername = "tethys.cse.buffalo.edu";
    $username = 'waiwaiki';
    $password = '50180101';
    $database = 'cse442_542_2019_summer_teamd_db';

    $conn = new mysqli($servername, $username, $password, $database) or die ("Connection failed: " . mysqli_connect_error());

    echo "<br> Connected Succesfully";

    $code = 'dummy_confirm_code'; 
    // to be replaced by a real code
    // import confirmation code generation code 

    $sql = "INSERT INTO EmailTest (email, code) 
            VALUES ('$email',  '$code')";

    if($conn->query($sql) == TRUE){
            echo "<br> New record created successfully";
        }
        else {
            echo "<br> Error: " . $sql . "<br>" . $conn->error;
        }

    $conn -> close();

  }
?>