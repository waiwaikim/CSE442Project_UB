<?php include("LoginSQL.php"); ?>
   

<?php

    function checkSubmission($email){
    // check if a student has submitted an evluation or not
    // read from loginInfo
    // return true or false 
        $conn = sqlConnect();
 
        $result = mysqli_query($conn, "SELECT submission FROM loginInfo WHERE email = '$email'");
        
        if (!$result) {
            echo 'Could not run query: ' . mysqli_error($conn);
            exit;
        }   
        $row = mysqli_fetch_row($result);
        
        return $row[0];
        $conn -> close();

    }

    function getTeammates($email){
        // returns team members for a given email 
        // returns an array 
        $conn = sqlConnect();
        
        $ubit = substr($email,0, strpos($email,'@'));     
        $result = mysqli_query($conn, "SELECT ubit FROM roster_csvInput a
                                JOIN (SELECT team FROM roster_csvInput WHERE ubit = '$ubit') b
                                on a.team = b. team");
        
        $team = array(); 
        
        while ($row = mysqli_fetch_array($result)){
            array_push($team, $row['ubit'] );
            
        }
        return $team ; 
   
        
    }

    function readSumbission($evaluator, $evaluatee){
        // returns a evaluation score for a given evaluator and a evaluatee
        // returns an array, which can be indexed. i.e.) row[0]
        
        $conn = sqlConnect();
      
        $evaluator_ubit = substr($evaluator,0, strpos($evaluator,'@'));
        $evaluatee_ubit = substr($evaluatee,0, strpos($evaluatee,'@'));
     
        $result = mysqli_query($conn, "SELECT 
                                    role, 
                                    leadership, 
                                    participation, 
                                    professionalism, 
                                    quality1 
                                FROM evaluationInfo WHERE evaluator = '$evaluator_ubit' and evaluatee = '$evaluatee_ubit'");
         if (!$result) {
            echo 'Could not run query: ' . mysqli_error();
            exit;
        }   
        $row = mysqli_fetch_row($result);
        return $row; 
        $conn -> close();
        
    }

    function writeSubmission ($evaluator, $evaluatee, $role, $lead, $part, $prof, $qual){
        // write evaluation score to SQL table called evaluationInfo 
        // 
        $conn = sqlConnect();
        
        $evaluator_ubit = substr($evaluator,0, strpos($evaluator,'@'));
        $evaluatee_ubit = substr($evaluatee,0, strpos($evaluatee,'@'));

        
        $result = mysqli_query($conn, "UPDATE evaluationInfo SET
                                    role = '$role', 
                                    leadership = '$lead', 
                                    participation = '$part', 
                                    professionalism = '$prof', 
                                    quality1 = '$qual'
                                WHERE evaluator = '$evaluator_ubit' and evaluatee = '$evaluatee_ubit'");
         if (!$result) {
            echo 'Could not run query: ' . mysqli_error();
            exit;
        }   
        
    }
?>


