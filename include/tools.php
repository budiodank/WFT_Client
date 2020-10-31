<?php
  // skip OPTIONS method
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
      header('Access-Control-Allow-Headers: token, Content-Type');
      header('Access-Control-Max-Age: 1728000');
      header('Content-Length: 0');
      header('Content-Type: text/plain');
      die();
  }
  // allow every url
  header('Access-Control-Allow-Origin:  *');
  header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
  // allow content type !!IMPORTANT
  header('Content-Type: application/json');

  //Because the content-type sent by vuejs is application/json, you will not be able to read data via the $_POST $_GET or $_REQUEST variable.
  $post = json_decode(file_get_contents('php://input'), true);


  require_once "config.php";
  
  $config = new Config();
  date_default_timezone_set('Asia/Jakarta');

  $action = $_GET['action'];

  if ($action == "add") {
    if(isset($_POST['submit'])) {
      $userId = $config->userId(6);
      $name = $_POST['name'];
      $address = $_POST['address'];
      $lat = $_POST['lat'];
      $lng = $_POST['lng'];
      $description = $_POST['description'];
      $created_by = 'Budi Yusuf';
      $date = date("Y-m-d H:i:s");

        if ($userId != '' && $name != '' && $address != '' && $lat != '' && $lng != '') {
          $add = $config->addTools($userId, $name, $address, $lat, $lng, $description, $created_by, $date);
          if ($add) {
            echo "Data Berhasil diinput";
            //$api->sendRegister($userId, $no_telp);
            //header("Location: ../login.html?message=success");
          } else {
            echo "Data gagal dimasukkan";
          }
        }
    } else {
      echo "Tidak dapat kirim data";
    }
  }

 ?>