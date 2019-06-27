<?php include_once("src/LoginSQL.php"); ?>

<?php

if (isset($argc)) {
  if ($argc == 5) {
    $year = $argv[1];
    $term = $argv[2];
    $class = $argv[3];
    $team = $argv[4];
    $conn = sqlConnect();

    $result = $conn->query("SELECT evaluator FROM evaluationInfo WHERE year ="."'$year'"."AND term ="."'$term'"."AND class ="."'$class'"."AND team ="."'$team'");
    $members = array();
    while ($row = $result->fetch_assoc()) {
      if (!in_array($row['evaluator'], $members)) {
        array_push($members, $row['evaluator']);
      }
    }

    $sum = 0;
    $scores = array();
    foreach ($members as $member) {
      $scores[$member] = 0;
    }

    foreach ($members as $member) {
      $result = $conn->query("SELECT role, leadership, participation, professionalism, quality1 FROM evaluationInfo WHERE year ="."'$year'"."AND term ="."'$term'"."AND class ="."'$class'"."AND team ="."'$team'"."AND evaluatee ="."'$member'");
      while ($row = $result->fetch_assoc()) {
        $sum = $sum + $row['role'] + $row['leadership'] + $row['participation'] + $row['professionalism'] + $row['quality1'];
        $scores[$member] = $scores[$member] + $row['role'] + $row['leadership'] + $row['participation'] + $row['professionalism'] + $row['quality1'];
      }
    }

    $report = fopen("report/report$year$term$class$team.txt", "w") or die ("Unable to open file...");
    foreach (array_keys($scores) as $member) {
      fwrite($report, $member.", ".$scores[$member] / $sum."\n");
    }
    fclose($report);
  } else {
    echo "Usage: php report.php year term class team\n";
  }
} else {
  echo "\$argc not set!\n";
}

?>
