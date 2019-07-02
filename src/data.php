<?php include_once("submissionSQL.php");?>

<?php
    header('Content-Type: application/json');

    $aResult = array();

    #if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    #if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {
        switch($_POST['functionname']) {
            case 'getScores':
              $email = $_COOKIE["email"];
              $class = $_COOKIE["class"];
            //hard-coded values until LOGIN page has a menu to choose from 
              $year = "2019";
              $term = "summer"; 
              
              //--------------------------------------------------------------
              // DELETE Above once front-end has options/ drop-down menus to choose from
                  
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
