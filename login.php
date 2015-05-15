<?php

class login{
	
	//This function creates the form for logged in users to edit there account information
	public function userAccount($login, $password, $fname, $lname, $email, $address, $city, $state, $zip, $phone){
		echo "<h1>Account Information</h1>";
		echo "<form action='index.php' method='get'>";
		echo "Password <input type='text' name='password' value='$password'></p>";
		echo "<p>First Name <input type='text' name='fname' value='$fname'>Last Name <input type='text' name='lname' value='$lname'></p>";
		echo "<p>Email <input type='text' name='email' value='$email'></p>";
		echo "<p>Address <input type='text' name='address' value='$address'>City <input type='text' name='city' value='$city'></p>";
		echo "<p>State <select name='state' size='1'>";
		echo "<option value='select'>$state</option>";
		echo "<option value='Alabama'>Alabama</option>";
		echo "<option value='Alaska'>Alaska</option>";
		echo "<option value='Arizona'>Arizona</option>";
		echo "<option value='Arkansas'>Arkansas</option>";
		echo "<option value='California'>California</option>";
		echo "<option value='Colorado'>Colorado</option>";
		echo "<option value='Connecticut'>Connecticut</option>";
		echo "<option value='Delaware'>Delaware</option>";
		echo "<option value='D.C.'>D.C.</option>";
		echo "<option value='Florida'>Florida</option>";
		echo "<option value='Georgia'>Georgia</option>";
		echo "<option value='Hawaii'>Hawaii</option>";
		echo "<option value='Idaho'>Idaho</option>";
		echo "<option value='Illinois'>Illinois</option>";
		echo "<option value='Indiana'>Indiana</option>";
		echo "<option value='Iowa'>Iowa</option>";
		echo "<option value='Kansas'>Kansas</option>";
		echo "<option value='Kentucky'>Kentucky</option>";
		echo "<option value='Louisiana'>Louisiana</option>";
		echo "<option value='Maine'>Maine</option>";
		echo "<option value='Maryland'>Maryland</option>";
		echo "<option value='Massachusetts'>Massachusetts</option>";
		echo "<option value='Michigan'>Michigan</option>";
		echo "<option value='Minnesota'>Minnesota</option>";
		echo "<option value='Mississippi'>Mississippi</option>";
		echo "<option value='Missouri'>Missouri</option>";
		echo "<option value='Montana'>Montana</option>";
		echo "<option value='Nebraska'>Nebraska</option>";
		echo "<option value='Nevada'>Nevada</option>";
		echo "<option value='New Hampshire'>New Hampshire</option>";
		echo "<option value='New Jersey'>New Jersey</option>";
		echo "<option value='New Mexico'>New Mexico</option>";
		echo "<option value='New York'>New York</option>";
		echo "<option value='North Carolina'>North Carolina</option>";
		echo "<option value='North Dakota'>North Dakota</option>";
		echo "<option value='Ohio'>Ohio</option>";
		echo "<option value='Oklahoma'>Oklahoma</option>";
		echo "<option value='Oregon'>Oregon</option>";
		echo "<option value='Pennsylvania'>Pennsylvania</option>";
		echo "<option value='Rhode Island'>Rhode Island</option>";
		echo "<option value='South Carolina'>South Carolina</option>";
		echo "<option value='South Dakota'>South Dakota</option>";
		echo "<option value='Tennessee'>Tennessee</option>";
		echo "<option value='Texas'>Texas</option>";
		echo "<option value='Utah'>Utah</option>";
		echo "<option value='Vermont'>Vermont</option>";
		echo "<option value='Virginia'>Virginia</option>";
		echo "<option value='Washington'>Washington</option>";
		echo "<option value='West Virginia'>West Virginia</option>";
		echo "<option value='Wisconsin'>Wisconsin</option>";
		echo "<option value='Wyoming'>Wyoming</option>";
		echo "</select>";
		echo "Zip <input type='text' name='zip' value='$zip'></p>";
		echo "<p>Phone Number <input type='text' name='phone' value='$phone'></p>";
		echo "<input type='hidden' value='userAccount' name='userRequest' />";
		echo "<input type='submit' value='Update'>";
		echo "</form>";
	}
	//This function creates the register form for new users
	public function registerForm(){
		echo "<h1>Register</h1>";
		echo "<form action='index.php' method='get'>";
		echo "<p>Login <input type='text' name='login'>Password <input type='text' name='password'></p>";
		echo "<p>First Name <input type='text' name='fname'>Last Name <input type='text' name='lname'></p>";
		echo "<p>Email <input type='text' name='email'></p>";
		echo "<p>Address <input type='text' name='address'>City <input type='text' name='city'></p>";
		echo "<p>State <select name='state' size='1'>";
		echo "<option value='select'>select</option>";
		echo "<option value='Alabama'>Alabama</option>";
		echo "<option value='Alaska'>Alaska</option>";
		echo "<option value='Arizona'>Arizona</option>";
		echo "<option value='Arkansas'>Arkansas</option>";
		echo "<option value='California'>California</option>";
		echo "<option value='Colorado'>Colorado</option>";
		echo "<option value='Connecticut'>Connecticut</option>";
		echo "<option value='Delaware'>Delaware</option>";
		echo "<option value='D.C.'>D.C.</option>";
		echo "<option value='Florida'>Florida</option>";
		echo "<option value='Georgia'>Georgia</option>";
		echo "<option value='Hawaii'>Hawaii</option>";
		echo "<option value='Idaho'>Idaho</option>";
		echo "<option value='Illinois'>Illinois</option>";
		echo "<option value='Indiana'>Indiana</option>";
		echo "<option value='Iowa'>Iowa</option>";
		echo "<option value='Kansas'>Kansas</option>";
		echo "<option value='Kentucky'>Kentucky</option>";
		echo "<option value='Louisiana'>Louisiana</option>";
		echo "<option value='Maine'>Maine</option>";
		echo "<option value='Maryland'>Maryland</option>";
		echo "<option value='Massachusetts'>Massachusetts</option>";
		echo "<option value='Michigan'>Michigan</option>";
		echo "<option value='Minnesota'>Minnesota</option>";
		echo "<option value='Mississippi'>Mississippi</option>";
		echo "<option value='Missouri'>Missouri</option>";
		echo "<option value='Montana'>Montana</option>";
		echo "<option value='Nebraska'>Nebraska</option>";
		echo "<option value='Nevada'>Nevada</option>";
		echo "<option value='New Hampshire'>New Hampshire</option>";
		echo "<option value='New Jersey'>New Jersey</option>";
		echo "<option value='New Mexico'>New Mexico</option>";
		echo "<option value='New York'>New York</option>";
		echo "<option value='North Carolina'>North Carolina</option>";
		echo "<option value='North Dakota'>North Dakota</option>";
		echo "<option value='Ohio'>Ohio</option>";
		echo "<option value='Oklahoma'>Oklahoma</option>";
		echo "<option value='Oregon'>Oregon</option>";
		echo "<option value='Pennsylvania'>Pennsylvania</option>";
		echo "<option value='Rhode Island'>Rhode Island</option>";
		echo "<option value='South Carolina'>South Carolina</option>";
		echo "<option value='South Dakota'>South Dakota</option>";
		echo "<option value='Tennessee'>Tennessee</option>";
		echo "<option value='Texas'>Texas</option>";
		echo "<option value='Utah'>Utah</option>";
		echo "<option value='Vermont'>Vermont</option>";
		echo "<option value='Virginia'>Virginia</option>";
		echo "<option value='Washington'>Washington</option>";
		echo "<option value='West Virginia'>West Virginia</option>";
		echo "<option value='Wisconsin'>Wisconsin</option>";
		echo "<option value='Wyoming'>Wyoming</option>";
		echo "</select>";
		echo "Zip <input type='text' name='zip'></p>";
		echo "<p>Phone Number <input type='text' name='phone'></p>";
		echo "<input type='submit' value='Register'>";
		echo "<input type='hidden' value='userRegister' name='userRequest' />";
		echo "</form>";
	}
	//This loads the initial login form
	public function loadLogin(){
		echo "<h1>Login</h1>";
		echo "<form method='get' action='index.php'>";
		echo "<p>Login: <input type='text' name='login' /></p>";
		echo "<p>Password: <input type='password' name='pwd'></p>";
		echo "<input type='reset' value='Clear' />";
		echo "<input type='submit' value='Submit' />";
		echo "<input type='hidden' value='userAccount' name='userRequest' />";
		echo "</form>";
		echo "<p><a href='index.php?userRequest=userRegister'>Register for a new Account!</a></p>";
	}
	//This allows the user to logout
	public function logout(){
		session_destroy();
	}
	
	public function loadUser($login){//loads a user's information into an array
		global $con;

		$result = mysqli_query($con,"SELECT * FROM USERS WHERE USERS_LOGIN='$login'");

		$userarray = array();
		while($row = mysqli_fetch_array($result)) {
		  array_push($userarray,htmlentities($row['USERS_FNAME']));
		  array_push($userarray,htmlentities($row['USERS_LNAME']));
		  array_push($userarray,htmlentities($row['USERS_EMAIL']));
		  array_push($userarray,htmlentities($row['USERS_ADDRESS']));
		  array_push($userarray,htmlentities($row['USERS_CITY']));
		  array_push($userarray,htmlentities($row['USERS_STATE']));
		  array_push($userarray,htmlentities($row['USERS_ZIP']));
		  array_push($userarray,htmlentities($row['USERS_PHONE']));
		}
		return $userarray;
	}
	
	public function getUserPassword($login){//gets a users password from db
		global $con;

		$result = mysqli_query($con,"SELECT * FROM USERS WHERE USERS_LOGIN='$login'");

		while($row = mysqli_fetch_array($result)) {
		  $password = $row['USERS_PASSWORD'];
		}
		return $password;
	}
	
	public function getUserState($login){//gets the users state from the db
		global $con;

		$result = mysqli_query($con,"SELECT * FROM USERS WHERE USERS_LOGIN='$login'");

		while($row = mysqli_fetch_array($result)) {
		  $state = htmlentities($row['USERS_STATE']);
		}
		return $state;
	}

	public function loginVerification($login,$password){//verifies user
		global $con;

		$result = mysqli_query($con,"SELECT * FROM USERS");
		$loginarray = array();
		while($row = mysqli_fetch_array($result)) {
		  array_push($loginarray,$row['USERS_LOGIN']);
		}
		if(array_search($login,$loginarray) !== FALSE){
			return $this->authenticateUser($login,$password);
		}
		else{
			return FALSE;
		}
	}

	private function authenticateUser($login,$password){//verifies user password
		global $con;

		$result = mysqli_query($con,"SELECT * FROM USERS WHERE USERS_LOGIN='$login'");
		while($row = mysqli_fetch_array($result)){
			$truepassword = $row['USERS_PASSWORD'];
		}

		$hash = crypt($password, $truepassword);

		if($hash == $truepassword){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function password_encrypt($password){
		$hash_format = "$2y$10$"; //Tells PHP to use Blowfish with a "cost" of 10
		$salt_length = 22; //Blowfish salts should be 22-chracters or more
		$salt = $this->generate_salt($salt_length);
		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

	private function generate_salt($length){
		//Not 100% unique, not 100% random, but good enough for a salt
		//MD5 returns 32 characters
		$unique_random_string = md5(uniqid(mt_rand(), true));

		//Valid characters for a salt are [a-z, A-Z, 0-9, ./]
		$base64_string = base64_encode($unique_random_string);

		//But not '+' which is valid in base64 encoding
		$modified_base64_string = str_replace('+', '.', $base64_string);

		//Truncate string to the correct length
		$salt = substr($modified_base64_string, 0, $length);

		return $salt;
	}
	
	public function addUser($login,$password,$fname,$lname,$email,$address,$city,$state,$zip,$phone){//adds user to db
		global $con;

		mysqli_query($con,"INSERT INTO USERS (USERS_LOGIN, USERS_PASSWORD, USERS_FNAME, USERS_LNAME, USERS_EMAIL, USERS_ADDRESS, USERS_CITY, USERS_STATE, USERS_ZIP, USERS_PHONE)
		VALUES ('$login', '$password', '$fname', '$lname', '$email', '$address', '$city', '$state', '$zip', '$phone')");
	}
	
	public function updateUser($login,$password,$fname,$lname,$email,$address,$city,$state,$zip,$phone){//updates user to db
		global $con;
		
		mysqli_query($con,"UPDATE USERS SET USERS_PASSWORD='$password', USERS_FNAME='$fname', USERS_LNAME='$lname', USERS_EMAIL='$email', USERS_ADDRESS='$address', USERS_CITY='$city', USERS_STATE='$state', USERS_ZIP='$zip', USERS_PHONE='$phone'
		WHERE USERS_LOGIN='$login'");
	}
}
?>