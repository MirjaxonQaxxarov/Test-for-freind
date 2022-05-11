<?php 
session_start();
$ret= [];
if($_POST['_csrf']!=$_SESSION['_csrf']){
	$ret += ['xatolik' => "1"];
	$ret += ['xabar' => "Taqiqlangan so'rov"];
	$ret += ['_csrf' => $_SESSION['_csrf']];
}
else{
	    $s1 = 0;
		$obj = [];
		require_once 'config.php';
		foreach ($_POST as $key => $value){
			if ($key != '_csrf') {
                if ($_SESSION[clean($key)]==filter($value)) {
                    $s1++;
                }
			}
		}
        $obj += ['userid' => $_SESSION['userid']];
        $obj += ['fanid' => intval($_SESSION['fanid']/$_SESSION['keyuser'])];
        $obj += ['ball' => $s1];
        $obj += ['time' =>  date('m/d/Y H:i', time())];
		$fetch = Functions::getbyid('users',$_SESSION['userid']);
        foreach($fetch as $key => $value)
        $ball = $value['ball'];
        $obj2 = [];
        $obj2 += ['id' => $_SESSION['userid']];
        $obj2 += ['ball' => $s1];

		$fetch = Functions::edit($obj2,'users');
		$fetch = Functions::add($obj,'result');
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['ball' => $s1];
			$ret += ['xabar' => "Ma'lumot kiritildi!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
            unset($_SESSION['fanid']);
			}
			else{
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Ma'lumotda kamchilik bor!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			}
			
	}

		

echo json_encode($ret);
 ?>