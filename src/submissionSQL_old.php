<?php include_once("LoginSQL.php"); ?>


<?php

    function checkSubmission($email){
    // check if a student has submitted an evluation or not
    // read from loginInfo
    // return true or false
        $conn = sqlConnect();

        $stmt = mysqli_prepare($conn, "SELECT submission FROM loginInfo WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $submission);
        mysqli_stmt_fetch($stmt);

        return $submission;
        $conn -> close();

    }

    function getTeammates($email){
        // returns team members for a given email
        // returns an array
        // echo $email;
        $conn = sqlConnect();



        $stmt = mysqli_prepare($conn, "SELECT ubit FROM roster_csvInput a
                                    JOIN (SELECT team FROM roster_csvInput WHERE ubit = ?) b
                                    on a.team = b. team");
        mysqli_stmt_bind_param($stmt, "s", substr($email,0, strpos($email,'@')));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $ubit);

        $team = array();

        while (mysqli_stmt_fetch($stmt)) {
            array_push($team, $ubit );
        }

        return $team ;
    }



    function readSumbission($evaluator, $evaluatee){
        // returns a evaluation score for a given evaluator and a evaluatee
        // returns an array, which can be indexed. i.e.) row[0]

        $conn = sqlConnect();

        $stmt = mysqli_prepare($conn, "SELECT
                                    role,
                                    leadership,
                                    participation,
                                    professionalism,
                                    quality1
                                    FROM evaluationInfo WHERE evaluator = ? and evaluatee = ?");

        mysqli_stmt_bind_param($stmt, "ss",substr($evaluator,0, strpos($evaluator,'@')),substr($evaluatee,0, strpos($evaluatee,'@')));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $role, $lead, $part, $prof, $qaul);
        mysqli_stmt_fetch($stmt);

        $row = array($role, $lead, $part, $prof, $qaul);
        return $row;
    }

    function writeSubmission ($evaluator, $evaluatee, $role, $lead, $part, $prof, $qual){
        // write evaluation score to SQL table called evaluationInfo
        //
        $conn = sqlConnect();

        $stmt = mysqli_prepare($conn, "UPDATE evaluationInfo SET
                                    role = ?,
                                    leadership = ?,
                                    participation = ?,
                                    professionalism = ?,
                                    quality1 = ?
                                    WHERE evaluator = ? and evaluatee = ?");

        mysqli_stmt_bind_param($stmt, "iiiiiss",$role, $lead, $part, $prof, $qual,substr($evaluator,0, strpos($evaluator,'@')), substr($evaluatee,0, strpos($evaluatee,'@')));

        mysqli_stmt_execute($stmt);

    }
?>
