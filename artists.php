<?php

require_once('autoload.include.php') ;
$q = $_GET['q'];


$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT id , name as "txt"
    FROM artist
    WHERE id in (select artistid
                 from album
                 where genreid = :q)
    ORDER BY txt;
SQL
);


$stmt->bindValue(':q', $q, PDO::PARAM_INT);
$stmt->execute();
$artistes = $stmt->fetchAll();
/*$res = [;


while (($artiste = $stmt->fetch()) !== false) {
    $res .= ", " . $artiste['name'];
}

$res

echo $res;
*/

echo json_encode($artistes);