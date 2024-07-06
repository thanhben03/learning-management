<?php
session_start();
require_once("../libs/helper.php");
require_once("../libs/db.php");
$db = new DB();
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $idNote = $_POST['idNote'];
    $sql = "DELETE FROM ghichu WHERE id = $idNote";
    $db->handleSQL($sql);
    echo 'success';
}

?>