<?php

switch ($_GET['page']) {
	case 'dashboard':
		if(!file_exists('page/dashboard.php'))
			die('File Dashboard tidak ada');
		include "page/dashboard.php";
		break;
		break;

	case 'driver':
		if(!file_exists('page/driver.php'))
			die('File driver tidak ada');
		include "page/driver.php";
		break;
		break;

	case 'gps':
		if(!file_exists('page/gps.php'))
			die('File gps tidak ada');
		include "page/gps.php";
		break;
		break;

	case 'accelerometer':
		if(!file_exists('page/accelerometer.php'))
			die('File accelerometer tidak ada');
		include "page/accelerometer.php";
		break;
		break;

	case 'shipping':
		if(!file_exists('page/shipping.php'))
			die('File shipping tidak ada');
		include "page/shipping.php";
		break;
		break;

	case 'customer':
		if(!file_exists('page/customer.php'))
			die('File customer tidak ada');
		include "page/customer.php";
		break;
		break;

	case 'get':
		if(!file_exists('page/get.php'))
			die('File get tidak ada');
		include "page/get.php";
		break;
		break;

	case 'new_driver':
		if(!file_exists('page/new_driver.php'))
			die('File driver tidak ada');
		include "page/new_driver.php";
		break;
		break;

	case 'new_customer':
		if(!file_exists('page/new_customer.php'))
			die('File customer tidak ada');
		include "page/new_customer.php";
		break;
		break;

	case 'add_customer':
		if(!file_exists('page/add_customer.php'))
			die('File customer tidak ada');
		include "page/add_customer.php";
		break;
		break;

	case 'dashboard_customer':
		if(!file_exists('page/dashboard_customer.php'))
			die('File customer tidak ada');
		include "page/dashboard_customer.php";
		break;
		break;

	case 'index2.php':
		if(!file_exists('page/index2.php'))
			die('File index2 tidak ada');
		include "page/index2.php";
		break;
		break;
}

?>