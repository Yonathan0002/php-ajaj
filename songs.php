<?php

require_once('autoload.include.php') ;
$q = $_GET['q'];


$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT LPAD(number, 2, "0") as "num", name, duration
    FROM track,
         song 
    WHERE albumid  = (select id
                from album
                where id = :q)
    AND id = songid
    ORDER BY num;
SQL
);


$stmt->bindValue(':q', $q, PDO::PARAM_INT);
$stmt->execute();
$songs = $stmt->fetchAll();


echo json_encode($songs);