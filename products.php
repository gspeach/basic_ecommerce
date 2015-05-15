<?php
class products{

	private function loadAddCart($productid){//adds new cart item to shoppin gcart
		global $con;

		$result = mysqli_query($con,"SELECT * FROM PRODUCTS WHERE PRODUCTS_ID='$productid'");
		
		while($row = mysqli_fetch_array($result)){
			$cartid = urlencode($row['PRODUCTS_ID']);
			echo "<tr>";
			echo "<td>" . htmlentities($row['PRODUCTS_TITLE']) . "</td>";
			echo "<td>" . htmlentities($row['PRODUCTS_PRICE']) . "</td>";
			echo "<td><a href='index.php?userRequest=shoppingCart&removeFromCart=$cartid'>Remove</a></td>";
			echo "</tr>";
		}
	}
	
	public function loadShoppingCart($cartarray){//loads shopping cart
		echo "<form method=get action=>";
		echo "<p>Purchase Products</p>";
		echo "<table border='1'>
		<tr>
		<th>Title</th>
		<th>Price</th>
		<th>Remove from Cart</th>
		</tr>";
		$totalPrice = "";
		foreach($cartarray as $productid){
			$this->loadAddCart($productid);
			$x = $this->totalPrice($productid);
			$totalPrice += htmlentities($x);
		}
		echo "<tr><td>Total Price: </td><td>$totalPrice</td></tr>";
		echo "</table>";
		echo "<br />";
		echo "<input type=hidden name=userRequest Value=shoppingCart />";
		echo "<input type=hidden name=pay Value=set />";
		echo "<input type=submit value='Pay' /></form>";
	}
	
	private function totalPrice($productid){//loads total price of shopping cart
		global $con;

		$result = mysqli_query($con,"SELECT * FROM PRODUCTS WHERE PRODUCTS_ID='$productid'");
		$x = "";
		while($row = mysqli_fetch_array($result)){
			$x = $row['PRODUCTS_PRICE'];
		}
		return $x;
	}
	
	public function displayProducts($genre){//loads products for genre pages
		global $con;

		$result = mysqli_query($con,"SELECT * FROM PRODUCTS WHERE PRODUCTS_GENRE='$genre'");

		echo "<table border='1'>
		<tr>
		<th>ID</th>
		<th>Genre</th>
		<th>Title</th>
		<th>Availability</th>
		<th>Price</th>
		<th>Description</th>
		<th>Purchase</th>
		</tr>";

		while($row = mysqli_fetch_array($result)) {
		  echo "<tr>";
		  echo "<td>" . htmlentities($row['PRODUCTS_ID']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_GENRE']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_TITLE']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_AVAIL']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_PRICE']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_DESC']) . "</td>";
		  if($row['PRODUCTS_AVAIL'] == "Yes"){
			$cartid = urlencode($row['PRODUCTS_ID']);
			echo "<td><a href='index.php?userRequest=shoppingCart&addToCart=$cartid'>Add to Cart</a></td>";
		  }
		  else{
			echo "<td>Out of Stock</td>";
		  }
		  echo "</tr>";
		}
		echo "</table>";
	}
	
	public function adminLoginVerification($user){//verifies user
		global $con;

		$result = mysqli_query($con,"SELECT * FROM USERS");
		$loginarray = array();
		while($row = mysqli_fetch_array($result)) {
		  array_push($loginarray,$row['USERS_LOGIN']);
		}
		if(array_search($user,$loginarray) !== FALSE){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function adminProductidVerification($productid){//verifies product exists
		global $con;

		$result = mysqli_query($con,"SELECT * FROM PRODUCTS");
		$productsarray = array();
		while($row = mysqli_fetch_array($result)) {
		  array_push($productsarray,$row['PRODUCTS_ID']);
		}
		if(array_search($productid,$productsarray) !== FALSE){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function updateProduct($productid,$genre,$title,$availability,$price,$description){//updates product to db
		global $con;

		mysqli_query($con,"UPDATE PRODUCTS SET PRODUCTS_GENRE='$genre', PRODUCTS_TITLE='$title', PRODUCTS_AVAIL='$availability', PRODUCTS_PRICE='$price', PRODUCTS_DESC='$description'
		WHERE PRODUCTS_ID='$productid'");
	}
	
	public function searchOrder($column,$order){//conducs search based on order
		global $con;

		$result = mysqli_query($con,"SELECT * FROM PRODUCTS ORDER BY $column $order");

		echo "<table border='1'>
		<tr>
		<th>ID</th>
		<th>Genre</th>
		<th>Title</th>
		<th>Availability</th>
		<th>Price</th>
		<th>Description</th>
		<th>Purchase</th>
		</tr>";

		while($row = mysqli_fetch_array($result)) {
		  echo "<tr>";
		  echo "<td>" . htmlentities($row['PRODUCTS_ID']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_GENRE']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_TITLE']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_AVAIL']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_PRICE']) . "</td>";
		  echo "<td>" . htmlentities($row['PRODUCTS_DESC']) . "</td>";
		  if($row['PRODUCTS_AVAIL'] == "Yes"){
			$cartid = urlencode($row['PRODUCTS_ID']);
			echo "<td><a href='index.php?userRequest=shoppingCart&addToCart=$cartid'>Add to Cart</a></td>";
		  }
		  else{
			echo "<td>Out of Stock</td>";
		  }
		  echo "</tr>";
		}
		echo "</table>";
	}

	public function loadAdmin(){//this loads the admin panel
		echo "<h1>Admin Panel</h1>";
		echo "<form method=get action=>";
		echo "<p>Update Users:</p>";
		echo "<p>User Login <input type='text' name='user'></p>";
		echo "<input type=hidden name=userRequest Value=userAccount />";
		echo "<input type=hidden name=adminRequest Value=userLookup />";
		echo "<input type=submit  /></form>";
		
		echo "<form method=get action=>";
		echo "<p>Update Products:</p>";
		echo "<p>Product ID <input type='text' name='productid'></p>";
		echo "<input type=hidden name=userRequest Value=userAccount />";
		echo "<input type=hidden name=adminRequest Value=productLookup />";
		echo "<input type=submit  /></form>";
		
		$productid = htmlentities($this->newProductsId());
		
		echo "<form method=get action=>";
		echo "<p>Add Product</p>";
		echo "<table border='1'>
		<tr>
		<th>ID</th>
		<th>Genre</th>
		<th>Title</th>
		<th>Availability</th>
		<th>Price</th>
		<th>Description</th>
		</tr>";
		echo "<tr>";
		echo "<td>$productid</td>";
		echo "<td><input type='text' name='genre' /></td>";
		echo "<td><input type='text' name='title' /></td>";
		echo "<td><input type='text' name='available' /></td>";
		echo "<td><input type='text' name='price' /></td>";
		echo "<td><input type='text' name='description' /></td>";
		echo "</tr>";
		echo "</table>";
		echo "<input type=hidden name=userRequest Value=userAccount />";
		echo "<input type=hidden name=adminRequest Value=productLookup />";
		echo "<input type=hidden name=productid Value=$productid />";
		echo "<input type=hidden name=addProduct Value=yes />";
		echo "<input type=submit  /></form>";
		
	}
	
	private function newProductsId(){//this calculates the new product id for newly added products into the db
		global $con;

		$result = mysqli_query($con,"SELECT * FROM PRODUCTS");
		$productsarray = array();
		while($row = mysqli_fetch_array($result)) {
		  array_push($productsarray,$row['PRODUCTS_ID']);
		}
		$productid = count($productsarray) + 1;
		return $productid;
	}
	
	public function addProduct($productid,$genre,$title,$availability,$price,$description){//this adds product into database
		global $con;

		mysqli_query($con,"INSERT INTO PRODUCTS (PRODUCTS_ID, PRODUCTS_GENRE, PRODUCTS_TITLE, PRODUCTS_AVAIL, PRODUCTS_PRICE, PRODUCTS_DESC)
		VALUES ('$productid', '$genre', '$title', '$availability', '$price', '$description')");
	}
	
	public function loadAdminProduct($productid){//this loads the product update menu for admin panel
		global $con;
		
		$result = mysqli_query($con,"SELECT * FROM PRODUCTS WHERE PRODUCTS_ID='$productid'");

		echo "<form method=get action=>";
		echo "<p>Update Product</p>";
		echo "<table border='1'>
		<tr>
		<th>ID</th>
		<th>Genre</th>
		<th>Title</th>
		<th>Availability</th>
		<th>Price</th>
		<th>Description</th>
		</tr>";

		while($row = mysqli_fetch_array($result)){
		  echo "<tr>";
		  echo "<td>" . htmlentities($row['PRODUCTS_ID']) . "</td>";
		  echo "<td>" . "<input type='text' name='genre' value='" . htmlentities($row['PRODUCTS_GENRE']) . "'>" . "</td>";
		  echo "<td>" . "<input type='text' name='title' value='" . htmlentities($row['PRODUCTS_TITLE']) . "'>" . "</td>";
		  echo "<td>" . "<input type='text' name='available' value='" . htmlentities($row['PRODUCTS_AVAIL']) . "'>" . "</td>";
		  echo "<td>" . "<input type='text' name='price' value='" . htmlentities($row['PRODUCTS_PRICE']) . "'>" . "</td>";
		  echo "<td>" . "<input type='text' name='description' value='" . htmlentities($row['PRODUCTS_DESC']) . "'>" . "</td>";
		  echo "</tr>";
		}
		echo "</table>";
		echo "<input type=hidden name=userRequest Value=userAccount />";
		echo "<input type=hidden name=adminRequest Value=productLookup />";
		echo "<input type=hidden name=productid Value=$productid />";
		echo "<input type=hidden name=updateProduct Value=yes />";
		echo "<input type=submit  /></form>";
	}
}
?>