<?php 

    require_once('../../core/db.php');

    $mysql = db_connect($host, $username, $password, $database);

    function getDrivers ($mysql) {
        $result = mysqli_query($mysql,'select * from driver where status = true');
        
        $drivers = array();

        foreach ($result as $row) {
            $drivers[] = $row;
        }

        return json_encode($drivers);
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        try {
            http_response_code(200);
            echo getDrivers($mysql);
        } catch (Exception $e) { 
            http_response_code(400);
            echo json_encode(["message" => $e]);
        }
    }