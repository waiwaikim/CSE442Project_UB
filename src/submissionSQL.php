<?php include_once("LoginSQL.php"); ?>


<?php

    function checkSubmission($year, $term, $class, $email){
    // check if a student has submitted an evluation or not
    // read from loginInfo
    // return true or false
        $conn = sqlConnect();

        $stmt = mysqli_prepare($conn, "SELECT submission FROM loginInfo WHERE email = ? and year = ? and term = ? and class = ? ");
        mysqli_stmt_bind_param($stmt, "ssss", $email, $year, $term, $class);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $submission);
        mysqli_stmt_fetch($stmt);

        return $submission;
        $conn -> close();

    }

    function getTeammates($year, $term, $class, $email){
        // returns team members for a given email
        // returns an array
        // echo $email;
        $conn = sqlConnect();



        $stmt = mysqli_prepare($conn, "SELECT ubit FROM roster_csvInput a
                                    JOIN (SELECT year, term, class, team FROM roster_csvInput WHERE ubit = ? and year = ? and term = ? and class = ?) b
                                    on a.year = b.year and a.term = b.term and a.class = b.class and a.team = b.team");
        
        mysqli_stmt_bind_param($stmt, "ssss", substr($email,0, strpos($email,'@')), $year, $term, $class);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $ubit);

        $team = array();

        while (mysqli_stmt_fetch($stmt)) {
            array_push($team, $ubit );
        }

        return $team ;
    }



    function readSumbission($year, $term, $class, $evaluator, $evaluatee){
        // returns a evaluation score for a given evaluator and a evaluatee
        // returns an array, which can be indexed. i.e.) row[0]

        $conn = sqlConnect();

        $stmt = mysqli_prepare($conn, "SELECT
                                    role,
                                    leadership,
                                    participation,
                                    professionalism,
                                    quality1
                                    FROM evaluationInfo WHERE year = ? and term = ? and class =? and evaluator = ? and evaluatee = ?");

        mysqli_stmt_bind_param($stmt, "sssss",$year, $term, $class, substr($evaluator,0, strpos($evaluator,'@')),substr($evaluatee,0, strpos($evaluatee,'@')));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $role, $lead, $part, $prof, $qaul);
        mysqli_stmt_fetch($stmt);

        $row = array($role, $lead, $part, $prof, $qaul);
        return $row;
    }

    function writeSubmission ($year, $term, $class, $evaluator, $evaluatee, $role, $lead, $part, $prof, $qual){
        // write evaluation score to SQL table called evaluationInfo
        //
        $conn = sqlConnect();

        $stmt = mysqli_prepare($conn, "UPDATE evaluationInfo SET
                                    role = ?,
                                    leadership = ?,
                                    participation = ?,
                                    professionalism = ?,
                                    quality1 = ?
                                    WHERE year = ? and term = ? and class =? and evaluator = ? and evaluatee = ?");

        mysqli_stmt_bind_param($stmt, "iiiiisssss",$role, $lead, $part, $prof, $qual,$year, $term, $class,substr($evaluator,0, strpos($evaluator,'@')), substr($evaluatee,0, strpos($evaluatee,'@')));

        mysqli_stmt_execute($stmt);

    }
?>
