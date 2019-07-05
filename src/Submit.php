<?php include('submissionSQL.php'); ?>

<?php
  if (isset($_POST['submit'])) {
    $email = $_COOKIE["email"];
    $class = $_COOKIE["class"];
    $year = "2019";
    $term = "summer"; 
      
    $team = getTeammates($year, $term, $class, $email);
 
    foreach($team as $name) {
      $role = "0";
      $leadership = "0";
      $participation = "0";
      $prof = "0";
      $quality = "0";  
    
      $index1 = "role" . $name;
      $index2 = "leadership" . $name;
      $index3 = "participation" . $name;
      $index4 = "prof" . $name;
      $index5 = "quality" . $name;
  
      if(isset($_POST[$index1])) {
        $role = $_POST[$index1];
      }
      
      if(isset($_POST[$index2])) {
        $leadership = $_POST[$index2];
      }

      if(isset($_POST[$index3])) {
        $participation = $_POST[$index3];
      }

      if(isset($_POST[$index4])) {
        $prof = $_POST[$index4];
      }

      if(isset($_POST[$index5])) {
        $quality = $_POST[$index5];
      }
      writeSubmission($year, $term, $class, $email, $name . "@buffalo.edu", $role, $leadership, $participation, $prof, $quality);      
    }
    echo "success";
}
?>
