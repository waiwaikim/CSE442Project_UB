<?php include('../src/submissionSQL.php'); ?> 


<?php

$email = 'jmsiegel@buffalo.edu';

echo "Testing submissionSQL.php for " .$email . "<br> Compare the results against the stored SQL data. <br> <br>";
runTestSubmissionSQL($email);

function runTestSubmissionSQL($email){
    // test submissionSQL.php 
    
    
    /*---------------Test checkSubmission() --------------------*/
    echo "Test checkSubmission() <br>   ";
    if (checkSubmission($email)){
        echo "evaluation has been submitted. <br>";
    }
    else{
        echo "evaluation has not been submitted. <br>";
    }
    echo "<br>";
    
    
    /*---------------Test readSubmission() --------------------*/
    echo "Test readSubmission() <br>   ";
    $self_sub_result =  readSumbission($email, $email);
    echo "role: " . $self_sub_result[0]. " leadership: " .$self_sub_result[1]. " participation: " .$self_sub_result[2]. " professionalism: " .$self_sub_result[3]. " quality: " .$self_sub_result[4] . "<br>";
          
  
    $sub_result = readSumbission('waiwaiki@buffalo.edu', 'FrankTsa@buffalo.edu');
    echo "role: " . $sub_result[0]. " leadership: " .$sub_result[1]. " participation: " .$sub_result[2]. " professionalism: " .$sub_result[3]. " quality: " .$sub_result[4] . "<br>";;
    
    $sub_result = readSumbission('FrankTsa@buffalo.edu', 'JacobSie@buffalo.edu');
    echo "role: " . $sub_result[0]. " leadership: " .$sub_result[1]. " participation: " .$sub_result[2]. " professionalism: " .$sub_result[3]. " quality: " .$sub_result[4] . "<br>";;
    echo "<br>";
    
    /*---------------Test writeSubmission() --------------------*/
    
    echo "Test writeSubmission() <br>   ";
    writeSubmission ('LukeMcDa@buffalo.edu', 'JacobSie@buffalo.edu', 5, 4, 3, 2, 1);
    echo "<br><br>";
    
    
    /*---------------Test getTeammates() --------------------*/
    echo "Test getTeammates() <br> ";
    $team= getTeammates($email);
    foreach($team as $member){
        echo $member. "<br>";
    }
    echo "<br>";
            
}


?> 