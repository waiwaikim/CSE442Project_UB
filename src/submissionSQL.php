<?php
    function checkSubmission($email){
    // check if a student has submitted an evluation or not
    // read from loginInfo
    // return true or false 
 
        $servername = "tethys.cse.buffalo.edu";
        $username = 'waiwaiki';
        $password = '50180101';
        $database = 'cse442_542_2019_summer_teamd_db';
        $conn = mysql_connect($servername, $username, $password);
        $dbselect = mysql_select_db($database);
        if (!$conn){
            die('Could not connect: ' . mysql_error());
        }
   
        $result = mysql_query( "SELECT submission FROM loginInfo WHERE email = '$email'");
        
        if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            exit;
        }   
        $row = mysql_fetch_row($result);
        
        return $row[0];
        $conn -> close();

    }

    function getTeammates($email){
        // returns team members for a given email 
        // returns an array
        
        $servername = "tethys.cse.buffalo.edu";
        $username = 'waiwaiki';
        $password = '50180101';
        $database = 'cse442_542_2019_summer_teamd_db';
        $conn = mysql_connect($servername, $username, $password);
        $dbselect = mysql_select_db($database);
        if (!$conn){
            die('Could not connect: ' . mysql_error());
        }
        
        $ubit = substr($email,0, strpos($email,'@'));
        
        $result = mysql_query("SELECT ubit FROM roster_csvInput a
                                JOIN (SELECT team FROM roster_csvInput WHERE ubit = '$ubit') b
                                on a.team = b. team");
        
        $team = array(); 
        
        while ($row = mysql_fetch_array($result)){
            array_push($team, $row['ubit'] );
            
        }
        return $team ; 
   
        
    }

    function readSumbission($evaluator, $evaluatee){
        // returns a evaluation score for a given evaluator and a evaluatee
        // returns an array, which can be indexed. i.e.) row[0]
        
        $servername = "tethys.cse.buffalo.edu";
        $username = 'waiwaiki';
        $password = '50180101';
        $database = 'cse442_542_2019_summer_teamd_db';
        $conn = mysql_connect($servername, $username, $password);
        $dbselect = mysql_select_db($database);
        if (!$conn){
            die('Could not connect: ' . mysql_error());
        }
      
        $evaluator_ubit = substr($evaluator,0, strpos($evaluator,'@'));
        $evaluatee_ubit = substr($evaluatee,0, strpos($evaluatee,'@'));
     
        $result = mysql_query( "SELECT 
                                    role, 
                                    leadership, 
                                    participation, 
                                    professionalism, 
                                    quality1 
                                FROM evaluationInfo WHERE evaluator = '$evaluator_ubit' and evaluatee = '$evaluatee_ubit'");
         if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            exit;
        }   
        $row = mysql_fetch_row($result);
        return $row; 
        $conn -> close();
        
    }

    function writeSubmission ($evaluator, $evaluatee, $role, $lead, $part, $prof, $qual){
        // write evaluation score to SQL table called evaluationInfo 
        // 
        
        $servername = "tethys.cse.buffalo.edu";
        $username = 'waiwaiki';
        $password = '50180101';
        $database = 'cse442_542_2019_summer_teamd_db';
        $conn = mysql_connect($servername, $username, $password);
        $dbselect = mysql_select_db($database);
        if (!$conn){
            die('Could not connect: ' . mysql_error());
        }
        
        $evaluator_ubit = substr($evaluator,0, strpos($evaluator,'@'));
        $evaluatee_ubit = substr($evaluatee,0, strpos($evaluatee,'@'));

        
        $result = mysql_query("UPDATE evaluationInfo SET
                                    role = '$role', 
                                    leadership = '$lead', 
                                    participation = '$part', 
                                    professionalism = '$prof', 
                                    quality1 = '$qual'
                                WHERE evaluator = '$evaluator_ubit' and evaluatee = '$evaluatee_ubit'");
         if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            exit;
        }   
        
    }
?>


