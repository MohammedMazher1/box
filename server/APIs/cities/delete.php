<?php 
    require_once('../../core/db.php');

    $id = $_GET["id"];

    function deleteCity ($id) {
        global $mysql;

        try {
            $result = db_execute_query($mysql, "
                update cities set status = false where id = '$id';
            ");

            return $result;
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(array("message" => $e->getMessage()));
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === 'DELETE') {
        try {
            if (deleteCity($id))
                http_response_code(204);
            else 
                throw new Exception("حدث خطأ");
        } catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
        }
    }
?>