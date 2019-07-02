<?php include_once("submissionSQL.php");?>

<?php
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
    header('Content-Type: application/json');

    $aResult = array();

    if( !isset($aResult['error']) ) {
        switch($_POST['functionname']) {
            case 'getScores':
              $email = $_COOKIE["email"];
              $class = $_COOKIE["class"];
              //hard-coded values until LOGIN page has a menu to choose from 
              $year = "2019";
              $term = "summer"; 
          
              $team = getTeammates($year, $term, $class, $email);
              
              foreach ($team as $name) {
                $aResult[$name] = readSumbission($year, $term, $class, $email, $name . "@buffalo.edu");
              }
              break;
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);
?>
