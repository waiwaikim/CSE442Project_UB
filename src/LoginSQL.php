<?php

    function sqlConnect() {
    // make a connection to SQL DB

        $servername = "tethys.cse.buffalo.edu";
        $username = 'waiwaiki';
        $password = '50180101';
        $database = 'cse442_542_2019_summer_teamd_db';

        $conn = new mysqli($servername, $username, $password, $database) or die ("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_error()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else {
            return $conn; 
        }
    }


    function checkValidStudent($conn, $email){
    // read function
    // check if an email belongs to an active student 
        
        $ubit = substr($email,0, strpos($email,'@'));
        
        $checkSql = "SELECT ubit FROM roster_csvInput 
                    WHERE ubit = '$ubit'";

        $result = $conn->query($checkSql);
        
        if ($result-> num_rows < 1) {
            $valid = false; 

        }
        else {
           $valid = true;
        }
        
        return $valid; 
    }


    function checkSubmission($conn , $email){
        
        
    }

    function insertEmail($conn, $email, $code) {
    // write function to a SQL DB
    // insert a new Email address 

        $findsql =  "SELECT code FROM loginInfo
                    WHERE email = '$email'";

        $result = $conn->query($findsql);

        if ($result-> num_rows < 1) {
        // when a new email is entered

            
            $ubit = substr($email,0, strrpos($email,'@'));
            
            $sql = "INSERT INTO loginInfo (email, ubit,  code) 
                    VALUES ('$email', '$ubit',  '$code')";
            
           
            if($conn->query($sql) == TRUE){
                //echo "<br> New record created successfully";
            }
            else {
                echo "<br> Error: " . $sql . "<br>" . $conn->error;
            }
            $conn -> close();
        }
        else {
        //when an existing email is entered
            $sql = "UPDATE loginInfo 
                    SET code = '$code'
                    WHERE email = '$email' ";
            if($conn->query($sql) == TRUE){
                //echo "<br> New record created successfully";
            }
            else {
                echo "<br> Error: " . $sql . "<br>" . $conn->error;
            }
            $conn -> close();
        }          

    }

    function getConfirmCode($conn, $email) {
    // read function
    // return a confirmation code for a given email 

        $sql =  "SELECT code FROM loginInfo
               WHERE email = '$email'";

        $result = $conn->query($sql);

        if ($result-> num_rows < 1) {

            echo 'Failed to login: your confirmation code is incorrect' . mysql_error();
            exit;
        }

        $row = $result->fetch_assoc();
        $code = $row['code'];
        //echo "<br>" . $row['code'];
        return $code;
        
    }
?>