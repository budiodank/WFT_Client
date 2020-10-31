<?php 

  require_once "config.php";
  include "api.php";
  $config = new Config();
  date_default_timezone_set('Asia/Jakarta');

	/*if(!$_GET['page']){
		echo '<script>document.location="?page=dashboard"</script>';
	}*/

    
    $result2 = $result["m2m:cin"]["con"];
    print_r($result2);
    $result3 = json_decode($result2, true);

    echo $result3['nama'];
    $userId = $result3['nama'];
    $height = $result3['kelas'];

    if ($userId != "" && $height != "") {
      $date = date("Y-m-d H:i:s");

      $add = $config->addBmi($userId, $height, $date);

      if ($add) {
        echo "Berhasil Masuk";
      } else {
        echo "Data Tidak Masuk";
      }
    } else {
      echo "Harap isi data yang masih kosong";
    }

 ?>