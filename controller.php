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
        case 'PUT':
            handlePUT($bodyRequest);
            break;
        case 'DELETE':
            handleDELETE($bodyRequest);
            break;
        default:
            echo json_encode(['message' => 'Invalid request method']);
            break;
    }

    function handlePOST($bodyRequest) {
        $db = new DB();
        $new_task = new Todo;
        $new_task -> jsonConstruct($bodyRequest);
        $new_task -> DB_insert($db->connection);
        $todo_list=Todo::DB_selectAll($db->connection);
        return_response(200, "OK", $todo_list);
    }

    function handlePUT($bodyRequest) {
        $db = new DB();
        $newTask = new Todo;
        $newTask -> jsonConstruct($bodyRequest);
        $newTask -> DB_modify($db->connection);
        $todo_list=Todo::DB_selectAll($db->connection);
        return_response(200, "OK", $todo_list);
    }

    function handleGET() {
        $db = new DB();
        $result=Todo::DB_selectAll($db->connection);
        return_response(200, "OK", $result);
    }

    function handleDELETE($bodyRequest) {
        $db = new DB();
        $new_task = new Todo;
        $new_task -> jsonConstruct($bodyRequest);
        $new_task -> DB_delete($db->connection);
        $todo_list=Todo::DB_selectAll($db->connection);
        return_response(200, "OK", $todo_list);
    }
?>