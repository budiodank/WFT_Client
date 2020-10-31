<?php 

  require_once "config.php";
  require_once "api.php";
  require_once "sms_api.php";
  $config = new Config();
  $api = new Api();
  $api_sms = new Api_SMS();
  date_default_timezone_set('Asia/Jakarta');

	/*if(!$_GET['page']){
		echo '<script>document.location="?page=dashboard"</script>';
	}*/

  $getData = $api->getData();
  $result = $getData["m2m:cin"]["con"];
  $data = json_decode($result, true);
  $userId = $data['user_id'];
  //$userId = '238824';
  $height = $data['height'];
  $weight = $data['ideal_weight'];

  if ($userId != "" && $height != "" && $weight != "") {
    $con_date = date("Y-m-d");
    $selBmi = $config->selBmi($userId, $height, $weight, $con_date);
    if (mysqli_fetch_array($selBmi) > 0) {
      //echo "Gagal dimasukkan, data sudah ada";
    } else {
      $date = date("Y-m-d H:i:s");

      $add = $config->addBmi($userId, $height, $weight, $date);
      //$add = true;

      if ($add) {
        $api_sms->smsData($userId, $height, $weight);
        //echo "Berhasil Masuk";
      } else {
        //echo "Data Tidak Masuk";
      }
    }
  } else {
    //echo "Harap isi data yang masih kosong";
  }
    /*$result2 = $result["m2m:cin"]["con"];
    print_r($result2);
    $result3 = json_decode($result2, true);

    //echo $result3['nama'];
    $userId = $result3['user_id'];
    $height = $result3['height'];
    $weight = $result3['weight_ideal'];

    if ($userId != "" && $height != "" && $weight != "") {
      $date = date("Y-m-d H:i:s");

      $add = $config->addBmi($userId, $height, $weight, $date);

      if ($add) {
        echo "Berhasil Masuk";
      } else {
        echo "Data Tidak Masuk";
      }
    } else {
      echo "Harap isi data yang masih kosong";
    }*/

 ?>