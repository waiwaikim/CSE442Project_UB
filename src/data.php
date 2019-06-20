<?php include_once("submissionSQL.php");?>

<?php
    header('Content-Type: application/json');

    $aResult = array();

    #if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    #if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {


            case 'add':
              $email = $_COOKIE["email"];
                
            //hard-coded values until LOGIN page has a menu to choose from 
              $year = "2019" ;
              $term = "summer"; 
              $class = "cse473";
              //--------------------------------------------------------------
              // DELETE Above once front-end has options/ drop-down menus to choose from
                  
              $team = getTeammates($year, $term, $class, $email);
              foreach ($team as $name) {
                 echo $name "<br>";
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
