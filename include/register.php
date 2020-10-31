<?php 
  require_once "config.php";
  require_once "sms_api.php";
  
  $config = new Config();
  $api = new Api_SMS();
  date_default_timezone_set('Asia/Jakarta');

  $action = $_GET['action'];

  if ($action == "regis") {
    if(isset($_POST['submit'])) {
      $userId = $config->userId(6);
      //$userId = '879985';
      $nama = $_POST['nama'];
      //$nama = 'Cecep Nurcahya';
      $email = '';
      $no_telp = $_POST['no_telp'];
      //$no_telp = '085695848790';
      $password = md5($_POST['password']);
      //$password = md5('cecep123');
      $date = date("Y-m-d H:i:s");

      $dataConfig = $config->selUser($userId, $no_telp);

      //echo $userId;

      if (mysqli_fetch_array($dataConfig) > 0) {
?>
        <script> alert('Gagal dimasukkan, data sudah ada')</script>
<?php
        header("Location: ../register.html?message=failed");
        die();
      } else if ($dataConfig) {
        if ($userId != '' && $nama != '' && $no_telp != '' && $password != '') {
          $add = $config->addUser($userId, $nama, $email, $password, $no_telp, $date);
          if ($add) {
            echo "Data Berhasil diinput";
            $api->sendRegister($userId, $no_telp);
            header("Location: ../login.html?message=success");
          } else {
            echo "Data gagal dimasukkan";
          }
        } else {
          echo "Data Masih Kosong";
        }
      }
    } else {
      echo "Tidak dapat kirim data";
    }
  }

 ?>