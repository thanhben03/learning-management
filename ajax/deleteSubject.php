<?php

require_once("../libs/helper.php");
require_once("../libs/db.php");

$db = new DB();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // $db->handleSQL("DELETE FROM monhoc WHERE id='$id'");
    die(json_encode(['status' => 'success']));
}

?>