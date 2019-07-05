<?php include('LoginSQL.php'); ?> 
<?php
 
    $conn = sqlConnect();

    $stmt = mysqli_prepare($conn, "SELECT
                                    DISTINCT year
                                FROM roster_csvInput ");
    mysqli_stmt_bind_param($stmt);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $year);

    
    while (mysqli_stmt_fetch($stmt)) {
        echo $year ;
    }
?>
