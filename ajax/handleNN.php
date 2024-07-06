<?php
session_start();
require_once("../libs/helper.php");
require_once("../libs/db.php");
$db = new DB();
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    switch ($_POST['action']) {
        case 'delete':
            $id = $_POST['id'];
            $sql = "DELETE FROM nhacnho WHERE id_nn = $id";
            $db->handleSQL($sql);

            die(json_encode([
                'status' => 'success'
            ]));
            break;
        case 'addLH':
            $user_id = $_POST['user_id'];
            $tenmon = $_POST['tenmon'];
            $phonghoc = $_POST['phonghoc'];
            $tietbd = $_POST['tietbd'];
            $sotiet = $_POST['sotiet'];
            $thu = $_POST['thu'];
            if ($db->checkExistsRow("SELECT * FROM lichhoc WHERE `tenmon` = '$tenmon'")) {
                die(json_encode([
                    'status' => 'error',
                    'msg' => 'Môn này đẫ tồn tại trong hệ thống'
                ]));
            }
            $sql = "INSERT INTO lichhoc VALUES(null,$user_id,'$tenmon','$phonghoc',$tietbd,$sotiet,$thu)";
            // die($sql);
            // $db->handleSQL($sql);
            die(json_encode([
                'status' => 'success'
            ]));
            break;
        case 'updateLH':

            break;
        case 'getLH':
            $id_lh = $_POST['id_lh'];
            $sql = "SELECT * FROM lichhoc WHERE id_lh = $id_lh";
            $data = $db->getList($sql);
            die(json_encode($data));
            break;
        case 'deleteLH':
            $id_lh = $_POST['id_lh'];
            $sql = "DELETE FROM lichhoc WHERE id_lh = $id_lh";
            $db->handleSQL($sql);
            die(json_encode([
                'status' => 'success'
            ]));
            break;
        default:
            # code...
            break;
    }
}
