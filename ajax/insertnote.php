<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
echo date('Y-m-d H:i:s');
session_start();
require_once("../libs/helper.php");
require_once("../libs/db.php");
$db = new DB();
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $userId = $_SESSION['account']['id'];
    $created_at = $updated_at = date('Y-m-d H:i:s');
    $noidung = $_POST['noidung'];
    $idMon = $_POST['idMon'];
    $sql = "INSERT INTO ghichu (id,userId,noidung,mon_id,created_at,updated_at) VALUES(null,$userId,'$noidung',$idMon,'$created_at','$updated_at')";
    $db->handleSQL($sql);
    echo 'success';
}

?>