<?php
session_start();
class Config
	{
		protected $host		= '';
		protected $dbname 	= 'iot_river';
		protected $user	 	= 'root';
		protected $password	= 'root';

		public function connectionKey()
		{
			$mysqli = mysqli_connect($this->host,$this->user,$this->password);
			$mysqli->select_db($this->dbname);

			return $mysqli;
		}

		public function check()
		{
			$check = "Ea";
			return $check;
		}

		public function closeConnection()
		{
			$mysqli = null;
		}

		public function addJanitor($id, $name, $telp_no, $date)
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("INSERT INTO janitor SET id = '$id', name = '$name', telp_no = '$telp_no', created_dt = '$date', updated_dt = '$date'");

			if ($query) {
				echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;

		}

		public function addTools($id, $name, $address, $lat, $lng, $description, $created_by, $date)
		//$userId, $name, $address, $lat, $lng, $description, $created_by, $date
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("INSERT INTO tools SET id = '$id', name = '$name', address = '$address', lat = '$lat', lng = '$lng', description = '$description', created_by = '$created_by', created_dt = '$date', updated_by = '$created_by',updated_dt = '$date'");

			if ($query) {
				//echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;

		}

		public function selUser($userId, $no_telp) {
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT * FROM tbluser WHERE userId = '$userId' OR no_telp = '$no_telp';");

			if ($query) {
				//echo "<script>alert('GET DATA')</script>";
			} else {
				echo "<script>alert('FAILED')</script>";
			}

			return $query;
		}

		public function login($userId, $password) {
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT * FROM tbluser WHERE userId = '$userId' AND password = '$password';");

			if ($inquiry = $query) {
				$_SESSION['userId'] = $_POST['userId'];
				foreach ($inquiry as $data) {
		            $_SESSION['nama'] = $data['nama'];
					$_SESSION['no_telp'] = $data['no_telp'];
		        }
		        echo "<script>alert('".$_SESSION['userId']."' + '".$_SESSION['nama']."')</script>";
				
			} else {
				echo "<script>alert('FAILED')</script>";
			}

			return $query;
		}

		//Belum Jadi
		public function getBmiAll() {
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT * FROM tblbmi;");

			if ($query) {
				echo "<script>alert('Data Sudah Masuk')</script>";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;
		}

		public function selBmi($userId, $height, $weight, $con_date) {
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi) a WHERE userId = '$userId' and height = '$height' and weight = '$weight' and created_at LIKE '$con_date"."%';");

			if ($query) {
				//echo "Data Berhasil";
			} else {
				echo "<script>alert('FAILED')</script>";
			}

			return $query;
		}

		public function getBmi()
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT DISTINCT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi) a");

			if ($query) {
				echo "Data Berhasil";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;
		}

		public function getBmiLast($userId)
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT DISTINCT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi WHERE userId = '$userId' ORDER BY created_at DESC) a ");

			if ($query) {
				//echo "Data Berhasil";
			} else {
				echo "<script>alert('Data Tidak Masuk')</script>";
			}

			return $query;
		}


		public function userId($lenght)
		{
			$char= '123456789abcdef';
		    $string = '';
		    for ($i = 0; $i < $lenght; $i++) {
			  $pos = rand(0, strlen($char)-1);
			  $string .= $char{$pos};
		    }
		    return $string;
		}

		public function getCount()
		{
			$callConn = $this->connectionKey();

			$query = $callConn->query("SELECT COUNT(userId) as cnt FROM (SELECT DISTINCT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi) a )b");

			return $query;
		}

		public function getHeight($action)
		{
			$callConn = $this->connectionKey();

			$query = '';

			if ($action == "all") {
				
				$query = $callConn->query("SELECT DISTINCT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi) a");
			} else if ($action == "sum"){

				$query = $callConn->query("SELECT SUM(height) as height FROM (SELECT DISTINCT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi) a )b");
			} else if ($action == "count"){
				$query = $callConn->query("SELECT COUNT(height) as height FROM (SELECT DISTINCT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi) a )b");
			}

			return $query;
		}

		public function getWeight($action)
		{
			$callConn = $this->connectionKey();

			$query = '';
			if ($action == "all") {
				
				$query = $callConn->query("SELECT DISTINCT userId, height, weight FROM tblbmi");
			} else if ($action == "sum"){

				$query = $callConn->query("SELECT SUM(weight) as weight FROM (SELECT DISTINCT userId, height, weight, con_date FROM (SELECT *, SUBSTRING(created_at,1, 10) AS con_date FROM tblbmi) a )b");
			}

			return $query;
		}

	}

	   
?>