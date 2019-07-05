
<?php

    $servername = "tethys.cse.buffalo.edu";
    $username = 'waiwaiki';
    $password = '50180101';
    $database = 'cse442_542_2019_summer_teamd_db';

    $conn = new mysqli($servername, $username, $password, $database) or die ("Connection failed: " . mysqli_connect_error());


    $file = fopen("testExcel.csv", "r");

    //echo "first";
    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
      

        //echo  "<br>".  $column[0] . " " . $column[1] . " " . $column[2] . " " . $column[3] . " " . $column[4]  ;
        
        
        $sql= "INSERT INTO roster_csvInput (year, term, class, active, last_name, first_name, ubit, team) 
               VALUES('$column[0]','$column[1]','$column[2]','$column[3]','$column[4]','$column[5]','$column[6]','$column[7]')";
        
        if($conn->query($sql)== TRUE){
            
        }
        else {
            echo "<br> Error: " . $sql . "<br>" . $conn->error;
        }
        
    
    }



    $sqlEval = "INSERT INTO evaluationInfo (year, term, class, active, team, evaluator, evaluator_last, evaluator_first, evaluatee, evaluatee_last, evaluatee_first)
            SELECT 
            t1.year,
            t1.term,
            t1.class,
            t1.active,
            t1.team,
            t1.ubit,
            t1.last_name, 
            t1.first_name,
            t2.ubit,
            t2.last_name,
            t2.first_name
            FROM roster_csvInput t1
            JOIN roster_csvInput t2 
            ON t1.year = t1.year and t1.term = t2.term and t1.class = t2.class and t1.team = t2.team
            ORDER BY t1.year, t1.term, t1.class, t1.team , t1.ubit";


    if($conn->query($sqlEval)== TRUE){

    }
    else {
        echo "<br> Error: " . $sqlEval . "<br>" . $conn->error;
    }
        

    $conn -> close();
    
?>