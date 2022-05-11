<?
	session_start();
		$ret = [];

	if (isset($_POST['login']) && isset($_POST['parol'])) {
		if($_POST['_csrf']!=$_SESSION['_csrf']){
			$ret += ['auth' => "yes"];
			$ret += ['xatolik' => "1"];
			$ret += ['auth' => "no"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require 'config.php';
			$login = filter($_POST['login']);
			$parol = md5($_POST['parol']);

			 
			$fetch = Logins::login($login,$parol);
			if($fetch['login']==$login and $parol==$fetch['password']){
				$_SESSION['login'] = $fetch['login'];
				$_SESSION['userid'] = $fetch['id'];
				$_SESSION['parol'] = $fetch['password'];
				$_SESSION['rol'] = $fetch['rol'];
				$_SESSION['name'] = $fetch['name'];
				$_SESSION['ball'] = $fetch['ball'];
				$ret += ['xatolik' => "0"];
				$ret += ['auth' => "yes"];
				$ret += ['xabar' => "Hammasi joyida"];
			}
			else{
				$ret += ['xatolik' => "1"];
				$ret += ['auth' => "no"];
				$ret += ['xabar' => "Login yoki parol xato"];
				$ret += ['_csrf' => $_SESSION['_csrf']];
			}	
		}
		
	}
	else{
        $ret += ['xatolik' => "1"];
				$ret += ['auth' => "no"];
				$ret += ['xabar' => "Ma`lumot yetarli emas"];
				$ret += ['_csrf' => $_SESSION['_csrf']];
	}
    echo json_encode($ret);
?>