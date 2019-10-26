<?php

require_once('autoload.include.php') ;
$q = $_GET['q'];


$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT id , CONCAT(year,' - ',name) as "txt"
    FROM album
    WHERE artistid in (select id
                 from artist
                 where id = :q)
    ORDER BY txt;
SQL
);


$stmt->bindValue(':q', $q, PDO::PARAM_INT);
$stmt->execute();
$albums = $stmt->fetchAll();


echo json_encode($albums);