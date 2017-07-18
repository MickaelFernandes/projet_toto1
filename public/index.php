<?php
//inclure le ficher config
require "../inc/config.php";


$sql_location ="SELECT  loc_name,
                        loc_id
                FROM location
                ORDER BY loc_id ASC
              ";

$sql = "SELECT  training.tra_name AS nom_session,
                session.ses_number AS nr_session,
                session.ses_start_date AS date_begin,
                session.ses_end_date AS date_end,
                location.loc_name AS session_location
        FROM session
          JOIN training ON session.training_tra_id = training.tra_id
          JOIN location ON session.location_loc_id = location.loc_id
        WHERE loc_id = :locationID
      ";

$pdoStatement_location=$pdo->prepare($sql_location);
$pdoStatement_sql=$pdo->prepare($sql);

if ($pdoStatement_location->execute() === false){
  print_r($pdo->errorInfo());
}
else{
  $sessionLocation = $pdoStatement_location->fetchAll(PDO::FETCH_ASSOC);

  foreach ($sessionLocation as $valueLocation ){
    $locationID = $valueLocation['loc_id'];
    $pdoStatement_sql->bindValue(':locationID', $locationID, PDO::PARAM_INT);

    if ($pdoStatement_sql->execute() === false) {
    	print_r($pdo->errorInfo());
    }
    else {
      $sessionHome[$locationID] = $pdoStatement_sql->fetchAll(PDO::FETCH_ASSOC);
      //print_r($sessionHome);
    }
  }
  // print_r($sessionHome);
}






// inclur les vues
require "../view/header.php";
require "../view/home.php";
require "../view/footer.php";

 ?>
