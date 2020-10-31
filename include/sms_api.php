<?php
require_once "config.php";
/**
 * 
 */
class Api_SMS
{
  public function smsData($userId, $height, $weight)
  {
    $config = new Config();
    echo "cek sudah masuk sms data";
    $AccessTokenUri = "https://api.thebigbox.id/sms-notification/1.0.0/messages";
    $no_telp = '';
    //$accessKey = "2f2b5c0e49d365b0:f68b99c78b62a9b3"; 
    $selUser = $config->selUser($userId, 0);
    if ($selUser) {      
      foreach ($selUser as $data) {
        echo $data['no_telp'];
        $no_telp = $data['no_telp'];
      }
    } else {
      echo "Gagal get data";
    }

    $messages = 'Tinggi Anda : '.$height.' cm dan Berat Anda '.$weight.' kg.';

    //$data  =  json_encode(array("msisdn" => "087784677284", "content" => "Test12345"));

    $data = array ('msisdn' => $no_telp, 'content' => $messages);
    $data2 = http_build_query($data);

    $options = array(
      'http' => array(
          'header'  =>  "Content-Type: application/x-www-form-urlencoded\r\n".
                        "Accept: application/x-www-form-urlencoded\r\n".
                        "x-api-key: siRoNm3Te3mHkqt5CeAkXBgL1X5I0Uhc\r\n",
         
          'method'  => 'POST',

          /*'content'  => "msisdn: ".$no_telp."\r\n".
                     "content: ".$messages."\r\n",*/
          'content'  => $data2,
      ),
    );

    $context  = stream_context_create($options);

    //get the Access Token
    $access_token = file_get_contents($AccessTokenUri, false, $context);

    if (!$access_token) {
      throw new Exception("Problem with $AccessTokenUri, $php_errormsg");
    } else{ 
      $result = json_decode($access_token,true);
      //print_r($result);
    }
  }

  public function sendRegister($userId, $no_telp)
  {
    $AccessTokenUri = "https://api.thebigbox.id/sms-notification/1.0.0/messages";
   
    $messages = 'Selamat Anda Berhasil Registrasi! User ID Anda Adalah '.$userId;

    //$data  =  json_encode(array("msisdn" => "087784677284", "content" => "Test12345"));

    $data = array ('msisdn' => $no_telp, 'content' => $messages);
    $data2 = http_build_query($data);

    $options = array(
      'http' => array(
          'header'  =>  "Content-Type: application/x-www-form-urlencoded\r\n".
                        "Accept: application/x-www-form-urlencoded\r\n".
                        "x-api-key: siRoNm3Te3mHkqt5CeAkXBgL1X5I0Uhc\r\n",
         
          'method'  => 'POST',

          /*'content'  => "msisdn: ".$no_telp."\r\n".
                     "content: ".$messages."\r\n",*/
          'content'  => $data2,
      ),
    );

    $context  = stream_context_create($options);

    //get the Access Token
    $access_token = file_get_contents($AccessTokenUri, false, $context);

    if (!$access_token) {
      throw new Exception("Problem with $AccessTokenUri, $php_errormsg");
    } else{ 
      $result = json_decode($access_token,true);
      print_r($result);
    }
  }
}

 ?>