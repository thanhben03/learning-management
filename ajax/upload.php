<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
// Use the Configuration class 
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// Configure an instance of your Cloudinary cloud
Configuration::instance('cloudinary://998626721434853:BBdKt5E_rzDGA9OMFspNOAk9eS4@ds82xoboc?secure=true');
require_once("../libs/helper.php");
require_once("../libs/db.php");

$a = [];
// $BB = new DB();
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $files = $_FILES['files'];
    $fileArr = [];
    $target_dir = "../public/upload/img/";
    insertNote();
    $ghichu_id = getLatestNote();
    for ($i = 0; $i < count($files['name']); $i++) {
        $fileArr[] = [
            'name' => randomName($files['name'][$i]),
            'tmp_name' => $files['tmp_name'][$i],

        ];

        $target_file = $target_dir . $fileArr[$i]['name'];
        $check = handleUploadFile($fileArr[$i], $target_file, $ghichu_id);
        if (!$check) {
            die(json_encode([
                'status' => 'error',
                'data' => $a
            ]));
        }
    }
    die(json_encode([
        'status' => 'success',
        'data' => $a
    ]));
}


function randomName($name)
{
    $randomChar = '0123456789abcdefghijklmnopqrstuvwxyz';
    // $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = pathinfo($name, PATHINFO_EXTENSION);
    $nameImage = 'ht' . substr(str_shuffle($randomChar), 0, 6) . '.' . $imageFileType;
    // $target_file = $target_dir.$nameImage;

    return $nameImage;
}

function handleUploadFile($file, $target_file, $ghichu_id)
{
    $BB = new DB();
    $check = false;
    $respon = (new UploadApi())->upload($file["tmp_name"]);
    $url = $respon['url'];
    $user_id = $_SESSION['account']['id'];
    $tenanh = $file['name'];
    $idmon = $_POST['idmon'];
    $ghichu = $_POST['ghichu'];
    $created_at = $updated_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO gallery VALUES(null,$user_id,$idmon,'$url','$ghichu',$ghichu_id,'$created_at','$updated_at')";
    $BB->handleSQL($sql);
    $check = true;

    return $check;
}

function insertNote()
{
    $BB = new DB();
    $user_id = $_SESSION['account']['id'];
    $idmon = $_POST['idmon'];
    $ghichu = $_POST['ghichu'];
    $created_at = $updated_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO ghichu VALUES(null,$user_id,'$ghichu','$idmon','$created_at','$updated_at')";
    $BB->handleSQL($sql);
}

function getLatestNote()
{
    $BB = new DB();
    $sql = "SELECT * FROM ghichu ORDER BY id DESC LIMIT 1";
    $data = $BB->getOneRowWithSQL($sql);

    return $data['id'];
}

