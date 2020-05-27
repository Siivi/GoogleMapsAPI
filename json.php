<?php

try {
    require "config.php";


    $conn = new PDO($dsn, $user, $psw, $options);
    $sql = "SELECT * FROM markers";

    if (ctype_digit($limit)) {
        $sql .= ' limit ' . $limit;
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

$places = [];
foreach ($result as $place) {
    $places[] = ['lat' => (float) $place['lat'], 'lng' => (float) $place['lng']];
}


echo json_encode($places);

//mysql query for get markers
/*
$places = [
    ['lat' => 58.247537, 'lng' => 22.479283],
    ['lat' => 58.247537, 'lng' => 22.48],
    ['lat' => 58.25, 'lng' => 22.48],
];

echo json_encode($places);*/

//json_last_error