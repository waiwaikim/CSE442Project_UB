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
        
        $stmt = $conn->prepare("SELECT ubit FROM roster_csvInput WHERE ubit = ?");
        $stmt->bind_param("s", substr($email,0, strpos($email,'@')));
        $stmt->execute();
        $stmt->bind_result($ubit);
        $stmt->fetch();
    
        if($ubit == "") {

            $valid = false; 
        }
        else {
            $valid = true;
        }
        
       
        return $valid; 
    }

    function checkEmail($conn, $email){
        $stmt = $conn->prepare("SELECT code FROM loginInfo WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($code);
        $stmt->fetch();
        
        return $code;
    }

    function insertEmail($conn, $email, $code) {
    // write function to a SQL DB
    // insert a new Email address 
        
        $conn2 = sqlConnect();
        
        $codeFound= checkEmail($conn2, $email);
        //echo " found code is " . $codeFound;
      
  
        if ($codeFound == "") {
         //when a new email is entered
            
            $stmt = mysqli_prepare($conn, "INSERT INTO loginInfo (email, ubit, code) VALUES (?, ?,  ?)");
            mysqli_stmt_bind_param($stmt, "sss",$email, substr($email,0, strrpos($email,'@')), $code);
            mysqli_stmt_execute($stmt);
        }
        else {
        //when an existing email is entered
            
            $stmt = mysqli_prepare($conn, "UPDATE loginInfo SET code = ? WHERE email = ? ");
            mysqli_stmt_bind_param($stmt, "ss",$code, $email);
            mysqli_stmt_execute($stmt);

        }
    }

    function getConfirmCode($conn, $email) {
    // read function
    // return a confirmation code for a given email 

        $stmt = $conn->prepare("SELECT code FROM loginInfo WHERE email = ?");
        $stmt->bind_param("s", $email);
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