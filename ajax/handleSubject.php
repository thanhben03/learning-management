<?php
session_start();
require_once("../libs/helper.php");
require_once("../libs/db.php");
$db = new DB();
$action = isset($_POST['action']) ? $_POST['action'] : 'getAllDataMon';
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    switch ($action) {
        case 'updateMon':
            $idMon = $_POST['idMon'];
            $tenmon = $_POST['tenmon'];
            $sql = "UPDATE monhoc SET `tenmon` = '$tenmon' WHERE id = $idMon";
            $db->handleSQL($sql);
            die(json_encode([
                'status' => 'success'
            ]));
            break;
        case 'getDataMon':
            $idMon = $_POST['idMon'];
            $sql = "SELECT * FROM monhoc WHERE id=$idMon";
            $data = $db->getOneRow('monhoc', $idMon);
            die(json_encode([
                    'status' => 'success',
                    'tenmon' => $data['tenmon']
                ]));
            break;
        case 'addmon':
            $tenmon = trim($_POST['tenmon']);
            $sql = "INSERT INTO monhoc VALUES(null,'$tenmon')";
            $db->handleSQL($sql);
            die(json_encode([
                'status' => 'success'
            ]));
            break;
        case 'getDetailNote':
            $ghichu_id = $_POST['id'];
            $sql = "SELECT * FROM ghichu gc JOIN gallery gl ON gc.id = gl.ghichu_id WHERE gc.id = $ghichu_id";
            $data = $db->getList($sql);
            die(json_encode($data));
            break;
        case 'getAllDataMon':
            $q = $_GET['q'];
            $sql = "SELECT * FROM monhoc WHERE tenmon LIKE '%$q%'";
            // die($sql);
            $data = $db->getList($sql);
            die(json_encode($data));
            break;
        default:
            # code...
            break;
    }
} 
