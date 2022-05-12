<?php 
session_start();
$ret= [];
if($_POST['_csrf']!=$_SESSION['_csrf']){
	$ret += ['xatolik' => "1"];
	$ret += ['xabar' => "Taqiqlangan so'rov"];
	$ret += ['_csrf' => $_SESSION['_csrf']];
}
else{
	$haqiqiy = intval($_GET['soni']/$_SESSION['keyuser']);
	$soni = -1;
	$s1 = "";
	foreach ($_POST as $key => $value){
		$soni++;
	}
	foreach ($_FILES as $key => $value){
		$soni++;
	}
	if ($soni >= $haqiqiy) {
		$table = str_rot13($_GET['table']);
		$obj = [];
		require_once 'config.php';
		foreach ($_POST as $key => $value){
			if ($key != '_csrf') {
                if($key == 'password')
				$obj += [clean($key) => md5(filter($value))];
                else 
				$obj += [clean($key) => filter($value)];
			}
		}
		
		$fetch =  Functions::add($obj,$table);
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['xabar' => "Ma'lumot kiritildi!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			}
			else{
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Ma'lumotda kamchilik bor!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			}
			
	}
	else{

		$ret += ['xatolik' => "1"];
		$ret += ['xabar' => "Ma'lumot Yetarli emas! "];
		$ret += ['_csrf' => $_SESSION['_csrf']];
	}

		
}
echo json_encode($ret);
 ?>