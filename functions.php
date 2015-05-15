<?php
class functions{

	public function mysql_prep($string){
		global $con;

		$escaped_string = mysqli_real_escape_string($con, $string);
		return $escaped_string;
	}

}
?>