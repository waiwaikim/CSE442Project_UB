
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
        
        
        $sql= "INSERT INTO csvInput (class, last_name, first_name, ubit, team) 
               VALUES('$column[0]','$column[1]','$column[2]','$column[3]','$column[4]')";
        
        if($conn->query($sql)== TRUE){
            
        }
        else {
            echo "<br> Error: " . $sql . "<br>" . $conn->error;
        }
        
    
    }

    $conn -> close();
    
?>