<?php
	////***** MYSQL CONNECT begin *****\\\\
	$link = mysqli_connect("localhost", "root", "", "fortest");

	if (!$link) {

    echo "Xato: MySQL bilan aloqa o'rnatib bo'lmadi.";

    exit();

}
mysqli_set_charset($link, "utf8");
	function filter($s)

	{
		$s = trim($s);
        $s = htmlspecialchars($s, ENT_QUOTES);
        $s = str_replace("'", "\'", $s);
        return $s;

	}
	

	function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

		return preg_replace('/[^A-Za-z0-9_\-]/', '', $string); // Removes special chars.
	 }
	////***** MYSQL CONNECT end *****\\\\


class Logins
{
	// LOGIN CHECK BEGIN \\
	static function login($login,$parol)
	{
		global $link;
		 $sql =mysqli_query($link,"SELECT * FROM users WHERE login='$login' and password='$parol'");
		 return mysqli_fetch_assoc($sql);
	}
	// LOGIN CHECK END \\


}

class Functions
{
	static function MyQuery($sql)
	{
		global $link;
		return mysqli_query($link,$sql);
	}
/////////////////******************GETS******************\\\\\\\\\\\\\\\\\\
	// GET ID VALUE  BEGIN \\
	static function getbytable($table,$val)
	{
		return Functions::MyQuery("SELECT * FROM `$table` WHERE $val");
	}
	// GET ID VALUE  END \\

	// GET ID VALUE  BEGIN \\
	static function getbyid($table,$id)
	{
		return Functions::MyQuery("SELECT * FROM `$table` WHERE `id` = '$id'");
	}
	// GET ID VALUE  END \\

	// GET ALL  BEGIN \\
	static function getall($table)
	{
		return Functions::MyQuery("SELECT * FROM `$table`");
	}
	// GET ALL  END \\


/////////////////******************GETS******************\\\\\\\\\\\\\\\\\\

	
/////////////////******************ADDS******************\\\\\\\\\\\\\\\\\\




	// ADDALL BEGIN \\
	static function add($arr,$table)
	{
		$query = "INSERT INTO `$table` ";
		$vname = "";
		$val = "";
		foreach ($arr as $key => $value) {
			$vname .= " `$key` ,";
			$val .= " '$value' ,";
		}
		$vname= rtrim($vname,",");
		$val= rtrim($val,",");
		$query.= "($vname) VALUES ($val); ";
		return Functions::MyQuery($query);
	}
	// ADDALL END \\



	// EDITALL BEGIN \\
	static function edit($arr,$table)
	{

		$query = "UPDATE $table SET ";
		$vname = "";
		$id = "";
		foreach ($arr as $key => $value) {
			$value1 = $value;
			if($key == "id"){
				$id = $value1;
			}else{
				$vname .= " `$key` = '$value1' ,";
			}
		}
		$query.= rtrim($vname,",");
		$query.= " WHERE `id` = $id";
		return Functions::MyQuery($query);
	}
	// EDITALL END \\



}
 ?>
