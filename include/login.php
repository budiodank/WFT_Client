<?php 
  require_once "config.php";
  
  $config = new Config();
  date_default_timezone_set('Asia/Jakarta');

  $action = $_GET['action'];

  if ($action == "login") {
    if (isset($_POST['submit'])) {
      $userId = $_POST['userId'];
      $password = md5($_POST['password']);

      //echo $userId;
      //echo $password;
      //echo $password_hash;

      if ($userId != '' && $password != '') {
        $inquiry = $config->login($userId, $password);
        if ($inquiry) {      
          foreach ($inquiry as $data) {
            echo $data['nama'];
          }
          header("Location: ../user.php?message=success");
          die();
        } else {
          echo "Gagal get data";
          header("Location: ../login.html?message=failed");
          die();
        }
      } else {
        echo "Data Masih Kosong";
      }
    }
    
  }

 ?>