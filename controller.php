<?php
    require "db.php";
    require "todo.php";
    function return_response($status, $statusMessage, $data) {
        header("HTTP/1.1 $status $statusMessage");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
    }

    $bodyRequest = file_get_contents("php://input");
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            handleGET();
            break;
        case 'POST':
            handlePOST($bodyRequest);
            break;
        default:
            echo json_encode(['message' => 'Invalid request method']);
            break;
    }

    function handlePOST($bodyRequest) {
        // if ($_POST['content'] == null || $_POST['content'] == '' ) {
        //     echo json_encode(['message' => 'Invalid content']);
        //     exit;
        // }
        $dbconn = new DB();
        $new_task = new Todo;
        $new_task -> jsonConstruct($bodyRequest);
        $new_task -> DB_insert($dbconn);
        return_response(200, "Todo está ok", $todo_list);
    }

    function handleGET() {
        $dbconn = new DB();
        $result=Todo::DB_selectAll($dbconn->connection);
        return_response(200, "Todo está ok", $result);
    }
?>