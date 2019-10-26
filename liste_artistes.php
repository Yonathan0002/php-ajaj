<?php


require_once('autoload.include.php') ;
$q = $_GET['q'];


$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT name
    FROM artist
    WHERE UPPER(name) LIKE UPPER(CONCAT("%",:q,"%"))
    ORDER BY 1;
SQL
);


$stmt->bindValue(':q', $q, PDO::PARAM_STR);
$stmt->execute();
$artiste = $stmt->fetch();
$res = $_GET['q'] . " => " . $artiste['name'];


while (($artiste = $stmt->fetch()) !== false) {
    $res .= ", " . $artiste['name'];
}


echo $res;
// On demande à PHP de se reposer quelques secondes pour introduire une latence
if (isset($_REQUEST['q'])) {
    usleep(rand(0, 20) * 100000) ;
}