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


    function checkValidStudent($conn, $year, $term, $class, $email ){
    // read function
    // check if an email belongs to an student of an active class 
        
        $stmt = $conn->prepare("SELECT ubit, active FROM roster_csvInput 
                                WHERE ubit = ? and  year = ? and term = ? and class = ?");
        $stmt->bind_param("ssss", substr($email,0, strpos($email,'@')), $year, $term, $class);
        $stmt->execute();
        $stmt->bind_result($ubit, $active);
        $stmt->fetch();
    
        if($ubit != "" and $active == true){
            $valid = true;
        }
        else {
            $valid = false; 
        }
//        if($ubit == "") {
//
//            $valid = false; 
//        }
//        else {
//            $valid = true;
//        }
        
       
        return $valid; 
    }

    function checkEmail($conn, $year, $term, $class, $email){
        $stmt = $conn->prepare("SELECT code FROM loginInfo WHERE email = ? and year = ? and term = ? and class = ?");
        $stmt->bind_param("ssss", $email, $year, $term, $class);
        $stmt->execute();
        $stmt->bind_result($code);
        $stmt->fetch();
        
        return $code;
    }

    function insertEmail($conn, $year, $term, $class, $email, $code) {
    // write function to a SQL DB
    // insert a new Email address 
        
        $conn2 = sqlConnect();
        
        $codeFound= checkEmail($conn2, $year, $term, $class, $email);
        //echo " found code is " . $codeFound;
      
  
        if ($codeFound == "") {
         //when a new email is entered
            
            $stmt = mysqli_prepare($conn, "INSERT INTO loginInfo (year, term, class, email, ubit, code) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssss",$year, $term, $class, $email, substr($email,0, strrpos($email,'@')), $code);
            mysqli_stmt_execute($stmt);
        }
        else {
        //when an existing email is entered
            
            $stmt = mysqli_prepare($conn, "UPDATE loginInfo SET code = ? WHERE email = ? and year = ? and term = ? and class = ? ");
            mysqli_stmt_bind_param($stmt, "sssss",$code, $email, $year, $term, $class);
            mysqli_stmt_execute($stmt);

        }
    }

    function getConfirmCode($conn, $year, $term, $class, $email) {
    // read function
    // return a confirmation code for a given email 

        $stmt = $conn->prepare("SELECT code FROM loginInfo WHERE email = ? and year = ? and term = ? and class = ?");
        $stmt->bind_param("ssss", $email, $year, $term, $class);
        $stmt->execute();
        $stmt->bind_result($code);
        $stmt->fetch();
        
     
        if ($code == "") {
            echo 'Failed to login: your confirmation code is incorrect' . mysql_error();
            exit;
        }

        //echo "<br>" . $row['code'];
        return $code;
        
    }

    function getName($ubit){
        //returns a full Name 
        $conn = sqlConnect();

        $stmt = mysqli_prepare($conn, "SELECT
                                    last_name,
                                    first_name
                    
                                    FROM roster_csvInput WHERE ubit = ?");
        mysqli_stmt_bind_param($stmt, "s", $ubit);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $last_name, $first_name);
        mysqli_stmt_fetch($stmt);
        
        $first_name .= " ";
        $first_name .= $last_name;
        return $first_name;
        
    }
?>