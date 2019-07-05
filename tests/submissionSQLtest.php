<?php include('../src/submissionSQL.php'); ?> 


<?php

$email = 'waiwaiki@buffalo.edu';
$year = "2019" ;
$term = "summer"; 
$class = "cse473";

echo "Testing submissionSQL.php for " .$email . "<br> Compare the results against the stored SQL data. <br> <br>";
runTestSubmissionSQL($year, $term, $class, $email);

function runTestSubmissionSQL($year, $term, $class, $email){
    // test submissionSQL.php 
    
    echo "Test getYear() <br>   ";
    getYear();
    
    echo "<br>";
        
        
    /*---------------Test checkSubmission() --------------------*/
    echo "Test checkSubmission() <br>   ";
    if (checkSubmission($year, $term, $class, $email)){
        echo "evaluation has been submitted. <br>";
    }
    else{
        echo "evaluation has not been submitted. <br>";
    }
    echo "<br>";
    
    
    /*---------------Test readSubmission() --------------------*/
    echo "Test readSubmission() <br>   ";
    $self_sub_result =  readSumbission($year, $term, $class,$email, $email);
    echo "role: " . $self_sub_result[0]. " leadership: " .$self_sub_result[1]. " participation: " .$self_sub_result[2]. " professionalism: " .$self_sub_result[3]. " quality: " .$self_sub_result[4] . "<br>";
          
  
    $sub_result = readSumbission($year, $term, $class,'waiwaiki@buffalo.edu', 'fengmaot@buffalo.edu');
    echo "role: " . $sub_result[0]. " leadership: " .$sub_result[1]. " participation: " .$sub_result[2]. " professionalism: " .$sub_result[3]. " quality: " .$sub_result[4] . "<br>";;
    
//    $sub_result = readSumbission($year, $term, $class,'fengmaot@buffalo.edu', 'jmsiegel@buffalo.edu');
//    echo "role: " . $sub_result[0]. " leadership: " .$sub_result[1]. " participation: " .$sub_result[2]. " professionalism: " .$sub_result[3]. " quality: " .$sub_result[4] . "<br>";;
//    echo "<br>";
    
    /*---------------Test writeSubmission() --------------------*/
    
    echo "Test writeSubmission() <br>   ";
    writeSubmission ($year, $term, $class,'waiwaiki@buffalo.edu', 'fengmaot@buffalo.edu', 1, 1, 1, 1, 1);
    echo "<br><br>";
    
    $sub_result = readSumbission($year, $term, $class,'waiwaiki@buffalo.edu', 'fengmaot@buffalo.edu');
    echo "role: " . $sub_result[0]. " leadership: " .$sub_result[1]. " participation: " .$sub_result[2]. " professionalism: " .$sub_result[3]. " quality: " .$sub_result[4] . "<br><br>";;
    
    /*---------------Test getTeammates() --------------------*/
    echo "Test getTeammates() <br> ";
    $team= getTeammates($year, $term, $class, $email);
    foreach($team as $member){
        echo $member. "<br>";
    }
    echo "<br>";
            
}


?> 