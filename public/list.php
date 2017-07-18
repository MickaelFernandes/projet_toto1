<?php
//inclure le ficher config
require "../inc/config.php";

$page = isset($_GET["page"]) ? intval($_GET["page"]) :1;
$search = isset($_GET["s"]) ? trim($_GET["s"]) : "";

$currentPage = 'list';

if ($page>0){
	$offset= $page * 5 - 5;
}
else{
	$offset= 0;
}

if (!empty($search)){
	$sql = "SELECT 	stu_id,
									stu_lastname AS stu_lname,
									stu_firstname AS stu_fname,
									stu_email,
									stu_birthdate AS birthdate
									-- 0 AS total
					FROM student
					WHERE  stu_lastname LIKE :search
					OR  stu_firstname LIKE :search
					OR  stu_email LIKE :search
					-- OR cit_name LIKE :search
					";

}
else {
	$sql = "SELECT 	stu_id,
									stu_lastname AS stu_lname,
									stu_firstname AS stu_fname,
									stu_email,
									stu_birthdate AS birthdate
									-- t.total
					FROM student
					-- LEFT OUTER JOIN (
						-- SELECT count(*) AS total
						-- FROM student
					-- ) as t on t.total > 0
					LIMIT 5
					OFFSET ".$offset."
	      ";
}

$pdoStatement=$pdo->prepare($sql);
$pdoStatement->bindValue(":search", "%{$search}%");

if ($pdoStatement->execute() === false){
	print_r($pdo->errorInfo());
}
else{
	$studentListe = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
	// $maxPageNum = ceil($studentListe[0]['total']/5);
}



require "../view/header.php";
require "../view/list.php";
require "../view/footer.php";
?>
