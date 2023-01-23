<?php

require_once 'connection.php';

$conn = getConnection();

$stmt = $conn->prepare('insert into number (num) values (:num)');

for ($i = 1; $i <= 100; $i++)
{
    $stmt->bindValue(':num', rand(1, 100));

    $stmt->execute();
}