<?php
require_once('autoload.include.php') ;
$q = $_GET['q'];


$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT name
    FROM artist
    WHERE name LIKE CONCAT("%",:q,"%")
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