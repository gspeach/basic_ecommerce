<?php include("header.php"); ?>
<?php
set_error_handler("customError"); //error handler
//This includes all of the required pages
include_once("login.php");
include_once("products.php");
include_once("db_connection.php");
include_once("functions.php");

$login2 = new login;
$products = new products;
$functions = new functions;

echo "<table border='1' class='table' width='90%' >";//links
echo "<tr>";
echo "<th colspan='2' height='100px'><h1>GS PC Games Emporium</h1></th>";
echo "</tr>";
echo "<tr>";
echo "<td width='20%' height='500px' valign='top'>";
echo "<p align='left'>";
echo "<h3>Our Company</h3>";
echo "<a href='index.php'>Home</a>";
echo "<br />";
echo "<a href='index.php?userRequest=mission'>Mission Statement</a>";
echo "<br />";
echo "<a href='index.php?userRequest=contact'>Contact</a>";
echo "<br />";
echo "</p>";
echo "<p align='left'>";
echo "<h3>Products</h3>";
echo "<a href='index.php?prodName=search'>Search Products</a>";
echo "<br />";
echo "<a href='index.php?prodName=action'>Action Games</a>";
echo "<br />";
echo "<a href='index.php?prodName=rpg'>RPG Games</a>";
echo "<br />";
echo "<a href='index.php?prodName=strategy'>Strategy Games</a>";
echo "<br />";
echo "</p>";
echo "<p align='left'>";
echo "<h3>Account</h3>";
if(isset($_SESSION['login'])){
	if($_SESSION['login'] == "admin"){
		echo "<a href='index.php?userRequest=userAccount'>Admin Panel</a>";
		echo "<br />";
		echo "<a href='index.php?userRequest=userAccount&logout=set'>Logout</a>";
	}
	else{
		echo "<a href='index.php?userRequest=userAccount'>Manage Account</a>";
		echo "<br />";
		echo "<a href='index.php?userRequest=userAccount&logout=set'>Logout</a>";
	}
}
else{
	echo "<a href='index.php?userRequest=userAccount'>Login/Register</a>";
}
echo "<br />";
echo "</p>";
echo "<p align='left'>";
echo "<h3>Shopping</h3>";
echo "<a href='index.php?userRequest=shoppingCart'>Shopping Cart</a>";
echo "</p>";
echo "</td>";
echo "<td width='80%' height='500px' valign='top'>";

//This loads when user clicks a product link
if(isset($_GET['prodName']) ){
	//This loads when the user clicks the search link
	if($_GET['prodName'] == "search"){
		//allows to search by order
		echo "<form method=get action=>";
		echo "<h1>Search</h1>";
		echo "Search by Order: <br />";
		echo "<p><select name='searchoption' size='1'>";
		echo "<option value='availability'>Availability</option>";
		echo "<option value='titleasc'>Title Ascending</option>";
		echo "<option value='titledesc'>Title Descending</option>";
		echo "<option value='priceasc'>Price Ascending</option>";
		echo "<option value='pricedesc'>Price Descending</option>";
		echo "</select></p>";
		echo "<input type=hidden name=prodName Value=search />";		
		echo "<input type=submit  /></form>";
		
		if(isset($_GET['searchoption'])){
			if($_GET['searchoption'] == "availability"){
				$column = "PRODUCTS_AVAIL";
				$order = "DESC";
				($products -> searchOrder($column,$order));
			}
			elseif($_GET['searchoption'] == "titleasc"){
				$column = "PRODUCTS_TITLE";
				$order = "ASC";
				($products -> searchOrder($column,$order));
			}
			elseif($_GET['searchoption'] == "titledesc"){
				$column = "PRODUCTS_TITLE";
				$order = "DESC";
				($products -> searchOrder($column,$order));
			}
			elseif($_GET['searchoption'] == "priceasc"){
				$column = "PRODUCTS_PRICE";
				$order = "ASC";
				($products -> searchOrder($column,$order));
			}
			else{
				$column = "PRODUCTS_PRICE";
				$order = "DESC";
				($products -> searchOrder($column,$order));
			}
		}
	}
	//This loads if the user clicks the action games link
	elseif($_GET['prodName'] == "action"){
		$genre = "Action";
		($products -> displayProducts($genre));
	}
	//This loads if the user clicks the RPG games link
	elseif($_GET['prodName'] == "rpg"){
		$genre = "RPG";
		($products -> displayProducts($genre));
	}
	//This loads if the user clicks the strategy games link
	else{
		$genre = "Strategy";
		($products -> displayProducts($genre));
	}
}
//This loads when the user clicks either mission statement, contact form, login, register links
elseif(isset($_GET['userRequest'])){
	//This loads when the user clicks the account button
	if($_GET['userRequest'] == "userAccount"){
		if(isset($_GET["login"]) && isset($_GET["pwd"])){//loads when user is logged in
			if(empty($_GET["login"]) || empty($_GET["pwd"])){
				echo "<p>Please enter both login and password.</p>";
				($login2 -> loadLogin());
			}
			else{
				$login = ($functions -> mysql_prep($_GET["login"]));
				$password = ($functions -> mysql_prep($_GET["pwd"]));
				$loginverification = ($login2 -> loginVerification($login,$password));
				
				if($loginverification == 1){
					$_SESSION['login']=$login;
					$_SESSION['password']=$password;
					//load account update for regular user or admin
					if($_SESSION['login'] == "admin"){
						($products -> loadAdmin());
					}
					else{
						$userarray = ($login2 -> loadUser($login));
						$fname = array_shift($userarray);
						$lname = array_shift($userarray);
						$email = array_shift($userarray);
						$address = array_shift($userarray);
						$city = array_shift($userarray);
						$state = array_shift($userarray);
						$zip = array_shift($userarray);
						$phone = array_shift($userarray);
						($login2 -> userAccount($login, $password, $fname, $lname, $email, $address, $city, $state, $zip, $phone));
					}
				}
				else{
					echo "<p>Invalid login or password!</p>";
					($login2 -> loadLogin());
				}
			}
		}
		elseif(isset($_GET["logout"])){//logs user out
			($login2 -> logout());
			echo "<p>You are now logged out! Please come again!</p>";
		}
		elseif(isset($_GET["password"]) && isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["email"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["state"]) && isset($_GET["zip"]) && isset($_GET["phone"])){
			if(empty($_GET["password"]) || empty($_GET["fname"]) || empty($_GET["lname"]) || empty($_GET["email"]) || empty($_GET["address"]) || empty($_GET["city"]) || empty($_GET["state"]) || empty($_GET["zip"]) || empty($_GET["phone"])){//checks if form is set
				$login = $_SESSION['login'];
				$password = $_GET["password"];
				$fname = $_GET["fname"];
				$lname = $_GET["lname"];
				$email = $_GET["email"];
				$address = $_GET["address"];
				$city = $_GET["city"];
				$state = $_GET["state"];
				$zip = $_GET["zip"];
				$phone = $_GET["phone"];
				echo "<p>All fields must be set!</p>";
				($login2 -> userAccount($login, $password, $fname, $lname, $email, $address, $city, $state, $zip, $phone));
			}
			else{//updates user information
				$login = $_SESSION['login'];
				
				if($login == "admin"){
					$login = ($functions -> mysql_prep($_SESSION['userlookup']));
					$passwordraw = ($functions -> mysql_prep($_GET["password"]));
					$password = ($login2 -> password_encrypt($passwordraw));

					$fname = ($functions -> mysql_prep($_GET["fname"]));
					$lname = ($functions -> mysql_prep($_GET["lname"]));
					$email = ($functions -> mysql_prep($_GET["email"]));
					$address = ($functions -> mysql_prep($_GET["address"]));
					$city = ($functions -> mysql_prep($_GET["city"]));
					if($_GET["state"] == "select"){
						$state = ($login2 -> getUserState($login));
					}
					else{
						$state = ($functions -> mysql_prep($_GET["state"]));
					}
					$zip = ($functions -> mysql_prep($_GET["zip"]));
					$phone = ($functions -> mysql_prep($_GET["phone"]));
					echo "<p>User account has been updated!</p>";
					($login2 -> updateUser($login,$password,$fname,$lname,$email,$address,$city,$state,$zip,$phone));
				}
				else{
					$passwordraw = ($functions -> mysql_prep($_GET["password"]));
					$password = ($login2 -> password_encrypt($passwordraw));
					$fname = ($functions -> mysql_prep($_GET["fname"]));
					$lname = ($functions -> mysql_prep($_GET["lname"]));
					$email = ($functions -> mysql_prep($_GET["email"]));
					$address = ($functions -> mysql_prep($_GET["address"]));
					$city = ($functions -> mysql_prep($_GET["city"]));
					if($_GET["state"] == "select"){
						$state = ($login2 -> getUserState($login));
					}
					else{
						$state = ($functions -> mysql_prep($_GET["state"]));
					}
					$zip = ($functions -> mysql_prep($_GET["zip"]));
					$phone = ($functions -> mysql_prep($_GET["phone"]));
					echo "<p>Your account has been updated!</p>";
					($login2 -> updateUser($login,$password,$fname,$lname,$email,$address,$city,$state,$zip,$phone));
				}
			}
		}
		elseif(isset($_SESSION['login']) && isset($_SESSION['password'])){//loads while user is still logged in
			if($_SESSION['login'] == "admin"){
				if(isset($_GET["adminRequest"])){
					if($_GET["adminRequest"] == "userLookup"){
						if(isset($_GET["user"])){
							$user = ($functions -> mysql_prep($_GET["user"]));
							$adminLoginVerification = ($products -> adminLoginVerification($user));
							if(empty($_GET["user"])){
								echo "<p>You must enter a user's login!</p>";
								($products -> loadAdmin());
							}
							elseif($adminLoginVerification == 1){
							$_SESSION['userlookup'] = $user;
							$login = $user;
							$password =  ($login2 -> getUserPassword($login));
							($products -> loadAdmin());
							$userarray = ($login2 -> loadUser($login));
							$fname = array_shift($userarray);
							$lname = array_shift($userarray);
							$email = array_shift($userarray);
							$address = array_shift($userarray);
							$city = array_shift($userarray);
							$state = array_shift($userarray);
							$zip = array_shift($userarray);
							$phone = array_shift($userarray);
							($login2 -> userAccount($login, $password, $fname, $lname, $email, $address, $city, $state, $zip, $phone));
							}
							else{
								echo "<p>Invalid Username!</p>";
								($products -> loadAdmin());
							}
						}
					}
					else{
						if(isset($_GET["productid"])){
							$productid = $_GET["productid"];
							$adminProductidVerification = ($products -> adminProductidVerification($productid));
							if(empty($_GET["productid"])){
								echo "<p>You must enter a Product ID!</p>";
								($products -> loadAdmin());
							}
							elseif(isset($_GET["addProduct"])){
								if(empty($_GET["genre"]) || empty($_GET["title"]) || empty($_GET["available"]) || empty($_GET["price"]) || empty($_GET["description"])){
									echo "<p>All fields must be set!</p>";
									($products -> loadAdmin());
								}
								else{
									$genre = ($functions -> mysql_prep($_GET["genre"]));
									$title = ($functions -> mysql_prep($_GET["title"]));
									$availability = ($functions -> mysql_prep($_GET["available"]));
									$price = $_GET["price"];
									$description = ($functions -> mysql_prep($_GET["description"]));
									echo "<p>Product has been added!</p>";
									($products -> addProduct($productid,$genre,$title,$availability,$price,$description));
								}
							}
							elseif(isset($_GET["updateProduct"])){
								if(empty($_GET["genre"]) || empty($_GET["title"]) || empty($_GET["available"]) || empty($_GET["price"]) || empty($_GET["description"])){
									echo "<p>All fields must be set!</p>";
									($products -> loadAdminProduct($productid));
								}
								else{
									$genre = ($functions -> mysql_prep($_GET["genre"]));
									$title = ($functions -> mysql_prep($_GET["title"]));
									$availability = ($functions -> mysql_prep($_GET["available"]));
									$price = $_GET["price"];
									$description = ($functions -> mysql_prep($_GET["description"]));
									echo "<p>Product has been updated!</p>";
									($products -> updateProduct($productid,$genre,$title,$availability,$price,$description));
								}
							}
							elseif($adminProductidVerification == 1){
							($products -> loadAdmin());
							($products -> loadAdminProduct($productid));
							}
							else{
								echo "<p>Invalid Product ID!</p>";
								($products -> loadAdmin());
							}
						}
					}
				}
				else{
					($products -> loadAdmin());
				}
			}
			else{
			$login = $_SESSION['login'];
			$password = $_SESSION['password'];
			$userarray = ($login2 -> loadUser($login));
			$fname = array_shift($userarray);
			$lname = array_shift($userarray);
			$email = array_shift($userarray);
			$address = array_shift($userarray);
			$city = array_shift($userarray);
			$state = array_shift($userarray);
			$zip = array_shift($userarray);
			$phone = array_shift($userarray);
			($login2 -> userAccount($login, $password, $fname, $lname, $email, $address, $city, $state, $zip, $phone));
			}
		}
		else{
			($login2 -> loadLogin());
		}	
	}
	//This loads when the user clicks the register link
	elseif($_GET['userRequest'] == "userRegister"){
		if(isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["email"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["state"]) && isset($_GET["zip"]) && isset($_GET["phone"]) && isset($_GET["login"]) && isset($_GET["password"])){
			$login = ($functions -> mysql_prep($_GET["login"]));
			$passwordraw = ($functions -> mysql_prep($_GET["password"]));
			$password = ($login2 -> password_encrypt($passwordraw));
			$fname = ($functions -> mysql_prep($_GET["fname"]));
			$lname = ($functions -> mysql_prep($_GET["lname"]));
			$email = ($functions -> mysql_prep($_GET["email"]));
			$address = ($functions -> mysql_prep($_GET["address"]));
			$city = ($functions -> mysql_prep($_GET["city"]));
			$state = ($functions -> mysql_prep($_GET["state"]));
			$zip = ($functions -> mysql_prep($_GET["zip"]));
			$phone = ($functions -> mysql_prep($_GET["phone"]));
			$loginverification = ($login2 -> loginVerification($login,$password));
			
			if(empty($_GET["fname"]) || empty($_GET["lname"]) || empty($_GET["email"]) || empty($_GET["address"]) || empty($_GET["city"]) || empty($_GET["state"]) || empty($_GET["zip"]) || empty($_GET["phone"]) || empty($_GET["login"]) || empty($_GET["password"])){
				echo "<p>You must enter a value in each field.</p>";
				($login2 -> registerForm());
			}
			elseif($loginverification == 1){
				echo "<p>This Login is taken already!</p>";
			}
			else{
				($login2 -> addUser($login,$password,$fname,$lname,$email,$address,$city,$state,$zip,$phone));
				echo "<p>Thank you for registering with our site!</p>";
			}
		}
		else{
			($login2 -> registerForm());
		}
	}
	//This loads when the user clicks the mission link
	elseif($_GET['userRequest'] == "mission"){
		echo "<h1>Mission Statement</h1>";
		echo "<p>Welcome to G&R Emporium! Here at G&R we strive to provide you the best PC games for the best prices.</p>";
	}
	//This loads when the user clicks the shopping cart link
	elseif($_GET['userRequest'] == "shoppingCart"){
		if(isset($_GET['addToCart'])){
			$cartid = $_GET['addToCart'];
			if(isset($_SESSION["cart"])){
				echo "<h1>Shopping Cart</h1>";
				$cart = $_SESSION["cart"] . "," . $cartid;
				$cartarray = explode(",",$cart);
				($products -> loadShoppingCart($cartarray));
				$_SESSION["cart"] = $cart;
			}
			else{
				echo "<h1>Shopping Cart</h1>";
				$productid = $cartid;
				$cartarray = array($productid);
				($products -> loadShoppingCart($cartarray));
				$_SESSION["cart"] = $productid;
			}
		}
		elseif(isset($_GET['removeFromCart'])){
			echo "<h1>Shopping Cart</h1>";
			$remove = $_GET['removeFromCart'];
			$cart = $_SESSION["cart"];
			$cartarray = explode(",",$cart);
			while(current($cartarray) !== $remove){
				next($cartarray);
			}
			$toRemove = current($cartarray);
			reset($cartarray);
			$newCartArray = array();
			
			foreach($cartarray as $value){
				if($value == $toRemove){
					next($cartarray);
				}
				else{
					array_push($newCartArray,$value);
				}
			}
			($products -> loadShoppingCart($newCartArray));
			$newcart = implode(",",$newCartArray);
			$_SESSION["cart"] = $newcart;
		}
		elseif(isset($_GET['pay'])){
			echo "<p>Your payment will be processed by a secure payment service.</p>";
			$cart = "";
			$_SESSION["cart"] = $cart;
		}
		elseif(isset($_SESSION["cart"])){
			echo "<h1>Shopping Cart</h1>";
			$cart = $_SESSION["cart"];
			$cartarray = explode(",",$cart);
			($products -> loadShoppingCart($cartarray));
		}
		else{
			echo "<h1>Shopping Cart</h1>";
			echo "<p>Your cart is empty.</p>";
		}
	}
	else{
		if(isset($_GET["from"]) || isset($_GET["subject"]) || isset($_GET["message"])){
			$From = $_GET["from"];
			$To = "georgebspeach@gmail.com";
			$Subject = $_GET["subject"];
			$Message = $_GET["message"];
			
			if (empty($To) || empty($Subject) || empty($Message)) {
				echo "<p>To, Subject, and Message must be provided.</p>";
			}
			else {
			$response = mail($To, $Subject, $Message, $From);
				if($response == 1){
					echo "<p>Your email was successfully sent.</p>";
				}
				else{
					echo "<p>Your email was not sent.</p>";
				}
			}
		}
		else{
			echo "<form method='get' action='index.php'>";
			echo "<h1>Contact Form</h1>";
			echo "<p>From: <input type='text' name='from' /></p>";
			echo "<p>Subject: <input type='text' name='subject' /></p>";
			echo "<p>Message: <br /><textarea name='message' rows='4' cols='20'>Type your message here.</textarea></p>";
			echo "<input type='reset' value='Clear' />";
			echo "<input type='submit' value='Submit' />";
			echo "<input type='hidden' value='' name='userRequest' />";
			echo "</form>";
		}
	}
}
//This loads automatically when the user comes to the page, and when the user clicks the home link
else{
	echo "<h1>Welcome</h1>";
	echo "<p>Hello and welcome to GS PC Games Emporium! This site was created by George Speach.</p>";
}
function customError($errno, $errstr){//custom error
  echo "<b>Error:</b> [$errno] $errstr<br>";
  echo "<p>Sorry for the inconvenience. Please hit your browsers back button to return to the site.</p>";
  echo "<p>If this happens again please send us a message and we will address the issue as soon as possible.</p>";
  echo "Sincerely,<br />";
  echo "GS PC Games Emporium Team"; 
  die();
}
?>
</td>
</tr>
<?php include("footer.php"); ?>