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
              $team = getTeammates($email);
              foreach ($team as $name) {
                $aResult[$name] = readSumbission($email, $name . "@buffalo.edu");
              }
              break;
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);
?>
