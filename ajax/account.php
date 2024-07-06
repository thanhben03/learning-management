<?php
session_start();
require_once("../libs/db.php");
$db = new DB();
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    if ($type == 'login') {
        $account = $db->checkLogin($username,$password);
        if ($account['status']) {
            $_SESSION['account'] = [
                'id' => $account['id'],
                'username' => $account['username']
            ];
            
            die(json_encode(['status' => 'success']));
        } else {
            die(json_encode(['status' => 'error']));
        }
    }
}

?>