<?php include_once('submissionSQL.php'); ?>

<?php
  $email = $_COOKIE["email"];
  $team_members = getTeamates($email);

  foreach($team_members as $name) {
    $role = $_POST["role'.$name.'"];
    $leadership = $_POST["leadership'.$name.'"];
    $participation = $_POST["participation'.$name.'"];
    $prof = $_POST["prof'.$name.'"];
    $quality = $_POST["quality'.$name.'"];
    
    writeSubmission($email, $name, $role, $leadership, $participation, $prof, $quality);
    echo "submission success";

  //   if (!empty($_POST["role0'.$name.'"])) {
  //     $role = 0;
  //   } else if(!empty($_POST["role1'.$name.'"])) {
  //     $role = 1;
  //   } else if(!empty($_POST["role2'.$name.'"])) {
  //     $role = 2;
  //   } else if(!empty($_POST["role3'.$name.'"])) {
  //     $role = 3;
  //   } else {
  //     echo "please make sure to check at least one box for every teammate";
  //   }

  //   if (!empty($_POST["leadership0'.$name.'"])) {
  //     $leadership = 0;
  //   } else if(!empty($_POST["leadership1'.$name.'"])) {
  //     $leadership = 1;
  //   } else if(!empty($_POST["leadership2'.$name.'"])) {
  //     $leadership = 2;
  //   } else if(!empty($_POST["leadership3'.$name.'"])) {
  //     $leadership = 3;
  //   } else {
  //     echo "please make sure to check at least one box for every teammate";
  //   }

  //   if (!empty($_POST["participation0'.$name.'"])) {
  //     $participation= 0;
  //   } else if(!empty($_POST["participation1'.$name.'"])) {
  //     $participation = 1;
  //   } else if(!empty($_POST["participation2'.$name.'"])) {
  //     $participation = 2;
  //   } else if(!empty($_POST["participation3'.$name.'"])) {
  //     $participation = 3;
  //   } else {
  //     echo "please make sure to check at least one box for every teammate";
  //   }

  //   if (!empty($_POST["prof0'.$name.'"])) {
  //     $prof = 0;
  //   } else if(!empty($_POST["prof1'.$name.'"])) {
  //     $prof = 1;
  //   } else if(!empty($_POST["prof2'.$name.'"])) {
  //     $prof = 2;
  //   } else if(!empty($_POST["prof3'.$name.'"])) {
  //     $prof = 3;
  //   } else {
  //     echo "please make sure to check at least one box for every teammate";
  //   }

  //   if (!empty($_POST["quality0'.$name.'"])) {
  //     $quality = 0;
  //   } else if(!empty($_POST["quality1'.$name.'"])) {
  //     $quality = 1;
  //   } else if(!empty($_POST["quality2'.$name.'"])) {
  //     $quality = 2;
  //   } else if(!empty($_POST["quality3'.$name.'"])) {
  //     $quality = 3;
  //   } else {
  //     echo "please make sure to check at least one box for every teammate";
  //   }


  // }     
?>
