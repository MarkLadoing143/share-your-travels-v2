<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// This is used in the left rail
function outputContinents() {
    $continents = new ContinentCollection();
    $continents->loadCollection();
    
    $result = $continents->getArray();
    
    for($i=0;$i<$continents->getCount();$i++){
    
    echo '<li class="list-group-item"><a href="#">' . $result[$i]->getContinentName() . '</a></li>';
   
    }
}

// This is used in the left rail
function outputCountries() {   
    $countries = new CountryCollection();
    $countries->loadCollection();
    
    $result = $countries->getArray();
       
    for($i=0;$i<$countries->getCount();$i++){ 
		echo '<li class="list-group-item">';
		echo '<a href="single-country.php?country='. $result[$i]->getISO() . '">';
		echo  $result[$i]->getCountryName() . '</a></li>';
    }
}

// Used as part of the Filter process to display the images.
function outputImages($collectionObject) {
	$results = $collectionObject->getArray();

	for($i=0;$i<$collectionObject->getCount();$i++){
		echo '<div class="col-md-3">';
		echo '<a href="single-image.php?id=' . $results[$i]->getImageID() . '">';
		echo '<img src="travel-images/square-medium/'. $results[$i]->getPath() . '" title="" class="thumbnail" />';
		echo '</a>';
		echo "</div>";
	}
}

//generates the country list for the browse-images.php filter dropdown
function outputCountriesList() {
    $countries = new CountryCollection();
    $countries->loadCollection();
    
    $result = $countries->getArray();
	
    for($i=0;$i<$countries->getCount();$i++){
		 echo '<option value="'. $result[$i]->getISO(). '">' . $result[$i]->getCountryName() . '</option>';
	}
}

//generates the city list for the browse-images.php filter dropdown
function outputCitiesList() {
	$cities = new CityCollection();
	$cities->loadCollection();
       
	$result = $cities->getArray();
    
	for($i=0;$i<$cities->getCount();$i++){
		echo '<option value="'. $result[$i]->getCityCode(). '">' . $result[$i]->getAsciiName() . '</option>';
	}
}

// This manages the state of what images are shown based on the individual query strings.
function filter(){
	$images = new ImageCollection();
	
	if( isset($_GET['city']) || isset($_GET['country']) ) {
		$city = 0;		
		if( isset($_GET['city']) && !empty($_GET['city']) ) {
			$city = $_GET['city'];
		}
		$country = "ZZZ";
		if( isset($_GET['country']) && !empty($_GET['country']) ) {
			$country = $_GET['country'];
		}
		
		$images->loadCollection();
				
		if($city > 0 && $country == "ZZZ") { //if city set
			$images->loadCollectionByCity($city);
		}
		elseif($city == 0 && $country != "ZZZ") { //if country set
			$images->loadCollectionByCountry($country);
		}
		elseif($city > 0 && $country != "ZZZ") { //if country and city set
			$images->loadCollectionByCityAndCountry($city, $country);
		}
		
		outputImages($images);
	}
	elseif( isset($_GET['search']) ) {
		$search = $_GET['search'];
		$images->loadCollectionBySearch($search);
				
		outputImages($images);
	}
	else {
		$images->loadCollection();
		
		outputImages($images);
	}
}

function generateUsersList() {
	$users = new UserCollection();
	$users->loadCollection();

	$result = $users->getArray();

	for($i=0;$i<$users->getCount();$i++){
		$firstname = utf8_encode($result[$i]->getFirstName());
		$lastname = utf8_encode($result[$i]->getLastName());

		echo '<li class="list-group-item">';
		echo '<a href="single-user.php?id='. $result[$i]->getUID() . '">';
		echo  $firstname . ' ' . $lastname . '</a></li>';
	}
}


// Used to truncate the messages to a limit of 200 characters in the posts section
function truncate($text, $length) {
   $length = abs((int)$length);
   
   if(strlen($text) > $length) {
      $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
   }
   
   return($text);   
}

//outputs the individual rows on the browse-posts.php page.
function outputPostRow() {
	$posts = new PostCollection();
	$posts->loadCollection();

	$result = $posts->getArray();

	for($i=0;$i<$posts->getCount();$i++){		
		$firstname = utf8_encode($result[$i]->getFirstName());
		$lastname = utf8_encode($result[$i]->getLastName());
		$date = $result[$i]->getPostTime();
		$createDate = new DateTime($date);
		$strip = $createDate->format('Y/m/d');
		$message = utf8_encode($result[$i]->getMessage());
			
		echo '<div class="row">';
		echo '<div class="col-md-2">';
		echo '<a href="#" class=""><img src="travel-images/square-medium/' . $result[$i]->getPath() . '" alt="' . $result[$i]->getTitle() . '" class="img-thumbnail"/></a>';
		echo "</div>";
		echo '<div class="col-md-10">';
		echo "<h2>" . $result[$i]->getTitle() . "</h2>";
		echo '<div class="details">';
		echo "Posted by ";
		echo '<a href="single-user.php?id=' . $result[$i]->getUID(). '">' . $firstname . " " . $lastname . '</a>';
		echo '<span class="pull-right">' . $strip . '</span>';
		echo "</div>";
		echo '<p class="excerpt">';
		echo truncate($message, 200);
		echo "</p>";
		echo "<p>";
		echo '<a href="single-post.php?Pid=' . $result[$i]->getPostID(). '" class="btn btn-primary btn-sm">Read More</a>';
		echo "</p>";
		echo "</div>";
		echo "</div>";
		echo "<hr/>";
	}
}	

function outputPagination($startNum,$currentNum) {		
	$count = $startNum;
	$active = $currentNum;
	$end = $startNum + 10;

	echo '<ul class="pagination">';

	while ($count < $end ) {
		if($count == $startNum && $startNum <= 10){
			echo '<li class="disabled"><a href="#">&laquo;</a></li>';
			echo '<li><a href="#">'. $count . '</a></li>';
			$count++;
		}
		else if ($count == $active){
			echo '<li class="active"><a href="#">'. $count . '</a></li>';
			$count++;
		}
		else {
			echo '<li><a href="#">' . $count . '</a></li>';
			$count++;
		}
	}
	
	echo '<li><a href="#">&raquo;</a></li>';
	echo "</ul>";
}

function generateSingleCountry() {
    
      
    if(isset($_GET['country'])){
        
    $countryCode = $_GET['country'];
    
    $country = new Country(Country::getFieldNames(), false);
    $country->load($countryCode);
    
    $countryname = $country->getCountryName();
    $area = $country->getArea();
    $population = $country->getPopulation();
    $currencyname = $country->getCurrencyName();
    $description = utf8_encode($country->getCountryDescription());
        
        echo '<li class="active">' . $countryname . '</li>';
        echo '</ol>';         
    
         
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '<h1>' . $countryname . '</h1><br/>';
        echo '<p><em> Capital: ' . ' ' . '</em>' .$area . ' ' . '<em>sq km</em></p><br/>' ;
        echo '<p><em> Population: ' . ' ' . '</em>' .$population . '</p><br/>';
        echo '<p><em> Currency Name: ' . ' ' . '</em>' .$currencyname . '</p><br/>';
        echo '<p>' . $description . '</p><br/>';
        echo '</div></div>';  
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
             filter();
        echo '</div></div>';
    
   
}
   
}


function generateSingleUser(){
    
        
    if(isset($_GET['id'])){
        
    $id= $_GET['id'];

        $user = new TravelUser(TravelUser::getFieldNames(), false);
        $user->load($id);
        
        $firstname = utf8_encode($user->getFirstName());
        $lastname = utf8_encode($user->getLastName());
        $city = utf8_encode($user->getCity());
        $address = utf8_encode($user->getAddress());
        $email = $user->getEmail();
        $country = utf8_encode($user->getCountry());
        
        echo '<li class="active">'. $firstname . ' ' . $lastname. '</li>';
        echo '</ol>';          
    
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '<h1>' . $firstname . ' ' . $lastname .  '</h1><br/>';
        echo '<p><em> Address: ' . ' ' . '</em><b>' .$address . '</b></p><br/>' ;
        echo '<p><em> City, Country: ' . ' ' . '</em><b>' .$city . ', ' . $country . '</b></p><br/>';
        echo '<p><em> Email: ' . ' ' . '</em><b>' .$email. '</b></p><br/>';
        echo '</div></div>';
        
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
             filter();
        echo '</div></div>';
        
        
    
    }
    
}

function getImageTitle() {
	if( isset($_GET['id']) ) {
		$id = $_GET['id'];
		
		$image = new TravelImage(TravelImage::getFieldNames(), false);
		$image->load($id);
		
		$title = $image->getTitle();
		
		echo utf8_encode($title);
	}
}

function generateSingleImage(){
    
    $id= $_GET['id'];
    
    $image = new TravelImage(TravelImage::getFieldNames(), false);
    $image->load($id);
    
    $description = utf8_encode($image->getDescription());
    $uid = $image->getUID();
    $countryISO = $image->getCountryCodeISO();
    $path = $image->getPath();
    $title = $image->getTitle();
    
    $user = new TravelUser(TravelUser::getFieldNames(), false);
    $user->load($uid);
    $firstname = utf8_encode($user->getFirstName());
    $lastname = utf8_encode($user->getLastName());
    
    $country = new Country(Country::getFieldNames(), false);
    $country->load($countryISO);
    $countryname = $country->getCountryName();
    
    $city = new City(City::getFieldNames(), false);
    $city->loadCityName($id);
    $cityname = $city->getAsciiName();
   
	echo '<li class="active">' . $title . '</li>';
	echo '</ol>';

	echo '<div class="row">';
	echo '<div class="col-md-9">';
	echo '<h1>' . $title . '</h1><br/><hr>';
	echo '<img src="travel-images/medium/'. $path . '" class= "img-thumbnail" data-toggle="modal" data-target="#myModal"/>';
	echo '<div id="myModal" class="modal fade" role="dialog">';
	echo '<div class="modal-dialog modal-lg">';
	echo '<div class="modal-content">';
	echo '<div class="modal-header">';
	echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
	echo '<h4 class="modal-title">'. $title .'</h4>';
	echo '</div>';
	echo '<div class="modal-body">';
	echo '<img src="travel-images/large/'. $path . '"/>';
	echo '</div>';
	echo '<div class="modal-footer">';
	echo '</div></div></div></div>'; 
	echo '<hr>';
	echo $description;    
	echo '</div>';	

	echo '<div class="col-md-3">';
	echo '<div class="panel panel-default">';
	echo '<div class="panel-heading">Image By</div>';
	echo '<div class="panel-body" id="Rail">';
	echo '<a href="single-user.php?id=' . $uid. '">';
	echo $firstname . " " . $lastname;
	echo '</a>';
	echo '</div></div></div>';

	echo '<div class="col-md-3">';
	echo '<div class="panel panel-default">';
	echo '<div class="panel-heading">Image Details</div>';
	echo '<div class="panel-body" id="Rail">';
	echo $cityname . " ";
	echo '<a href="single-country.php?country='. $countryISO. '">';
	echo $countryname;
	echo '</a>';
	echo '</div></div></div>';       

	echo '<div class="col-md-3">';
	echo '<div class="panel panel-info">';
	echo '<div class="panel-heading">Social</div>';
	echo '<div class="panel-body" id="Rail">';
	echo '<a href="addToFavorites.php?id=' . $id . '" class="btn btn-info btn-md" id="Social">Add to Favorites</a>';
	echo '<a href="browse-favorites.php" class="btn btn-success btn-md" id="Social">View Favorites</a>';
	echo '<a href="addToCart.php?id=' . $id . '" class="btn btn-danger btn-md" id="Social">Add to Cart</a>';
	echo '</div></div></div>';
          
}

function generateSinglePost() {
	$pid= $_GET['Pid'];
		
	$post = new TravelPost(TravelPost::getFieldNames(), false);
	$post->load($pid);

	$title = $post->getTitle();
	$UID = $post->getUID();
	$message = utf8_encode($post->getMessage());
	$firstname = utf8_encode($post->getFirstName());
	$lastname = utf8_encode($post->getLastName());
		
	echo '<li class="active">' . $title . '</li>';
	echo  '</ol>';
	echo '<div class="row">';
	echo '<div class="col-md-9">';    
	echo '<h1>' . $title . '</h1><br/><hr>'; 
	echo $message;
	echo '<div class="panel panel-default">';
	echo  '<div class="panel-heading">Images for Post</div>';
	echo '<div class="panel-body">';

	filter();

	echo '</div></div>';
	echo '</div>';
	echo '<div class="row">';

	echo  '<div class="col-md-3">';
	echo  '<div class="panel panel-default">';
	echo  '<div class="panel-heading">Posted By</div>';
	echo  '<div class="panel-body" id="Rail">';
	echo  '<a href="single-user.php?id=' . $UID. '">' . $firstname . " " . $lastname . '</a>';
	echo  '<hr>';
	echo  '<p><em>Posts by this user</em><p>';

	generatePostsRail($UID); 

	echo  '</div></div>'; 
	echo  '<div class="panel panel-info">';
	echo  '<div class="panel-heading">Social</div>';
	echo  '<div class="panel-body" id="Rail">';
	echo  '<a href="addToFavorites.php?Pid=' . $pid . '" class="btn btn-info btn-md" id="Social">Add to Favorites</a>' ;
	echo  '<a href="browse-favorites.php" class="btn btn-success btn-md" id="Social">View Favorites</a>';
	echo  '</ul></div></div></div></div></div>';
}

// Generates the posts by this user rail in the Single Posts page.
function generatePostsRail($uid) {
	$posts = new PostCollection();
	$posts->loadCollectionByUser($uid);

	$result = $posts->getArray();
	
	for($i=0;$i<$posts->getCount();$i++){ 
		echo '<a href="single-post.php?Pid=' . $result[$i]->getPostID(). '">' . $result[$i]->getTitle(). '</a><br/>';
	} 
}

//generates a table of favourite images 
function generateFavoriteImages(){
	if( !empty($_SESSION['FavoriteImages']) ){
		$favoriteArray = $_SESSION['FavoriteImages'];
		
		foreach($favoriteArray as $favorites){		
			echo '<tr>';
			echo '<td>';
			echo '<a href="single-image.php?id=' . $favorites['ID'] . '">';
			echo '<img src="travel-images/square-small/' . $favorites['Path'] .'" class= "img-thumbnail"/></td>';
			echo '</a>';
			echo '<td>' .$favorites['Title'] . '</td>';
			echo '<td>' .$favorites['Country'] . '</td>';
			echo '<td>';
			echo '<a href="removeFavoriteImage.php?id=' . $favorites['ID'] . '">';
			echo 'Remove</td>';
			echo '</a>';
			echo '</tr>';
		} 
	}
}

//generates a list of favorite posts
function generateFavoritePosts(){
    if( !empty($_SESSION['FavoritePosts']) ){
		$favoriteArray = $_SESSION['FavoritePosts'];  
		
		foreach($favoriteArray as $favorites){
			echo '<tr>';
			echo '<td>';
			echo '<a href="single-post.php?Pid=' . $favorites['PID'] . '">';
			echo '<img src="travel-images/square-small/' . $favorites['Path'] .'" class= "img-thumbnail"/></td>';
			echo '</a>';
			echo '<td>' .$favorites['Title'] . '</td>';
			echo '<td>' .$favorites['Author'] . '</td>';
			echo '<td>';
			echo '<a href="removeFavoritePost.php?Pid=' . $favorites['PID'] . '">';
			echo 'Remove</td>';
			echo '</a>';
			echo '</tr>';
		}      
	}
}

function generateCart() {
	if( !empty($_SESSION['ShoppingCart']) ) {
		
		$cart = $_SESSION['ShoppingCart'];
		
		foreach($cart as $item) {
			
			$itemPrice = calculatePrice($item);
			
			if($_SESSION['ShoppingCart'][$item['ID']]['Price'] != $itemPrice) { //checks and updates price
				$_SESSION['ShoppingCart'][$item['ID']]['Price'] = $itemPrice;
				$item['Price'] = $_SESSION['ShoppingCart'][$item['ID']]['Price']; //needed to update item['Price'] in current session
			}
			
			echo "<tr>";
			echo "<td><a href='single-image.php?id=" . $item['ID'] . "'><img src='travel-images/square-small/" . $item['Path'] . "' class= 'img-thumbnail'/></a></td>";
			echo "<td>" .$item['Title'] . "</td>";
			
			echo "<td><input type='text' name='quantity-" . $item['ID'] . "' value='" . $item['Quantity'] . "' maxlength='3' size='3'></td>";
			
			echo "<td>";
			echo
			"<select name='size-" . $item['ID'] . "'>
				<option value='5x7' " . (($item['Size'] == "5x7") ? "selected='selected'" : "") . ">5x7</option>
				<option value='8x10' " . (($item['Size'] == "8x10") ? "selected='selected'" : "") . ">8x10</option>
				<option value='11x14' " . (($item['Size'] == "11x14") ? "selected='selected'" : "") . ">11x14</option>
				<option value='12x18' " . (($item['Size'] == "12x18") ? "selected='selected'" : "") . ">12x18</option>
			</select>";
			echo "</td>";

			echo "<td>"; 
			echo 
			"<select name='stock-" . $item['ID'] . "'>
				<option value='Matte' " . (($item['Stock'] == "Matte") ? "selected='selected'" : "") . ">Matte</option>
				<option value='Glossy' " . (($item['Stock'] == "Glossy") ? "selected='selected'" : "") . ">Glossy</option>
				<option value='Canvas' " . (($item['Stock'] == "Canvas") ? "selected='selected'" : "") . ">Canvas</option>
			</select>";
			echo "</td>";
			
			echo "<td>";
			echo 
			"<select name='frame-" . $item['ID'] . "'>
				<option value='None' " . (($item['Frame'] == "None") ? "selected='selected'" : "") . ">None</option>
				<option value='Blond Maple' " . (($item['Frame'] == "Blond Maple") ? "selected='selected'" : "") . ">Blond Maple</option>
				<option value='Expresso Walnut' " . (($item['Frame'] == "Expresso Walnut") ? "selected='selected'" : "") . ">Expresso Walnut</option>
				<option value='Gold Accent' " . (($item['Frame'] == "Gold Accent") ? "selected='selected'" : "") . ">Gold Accent</option>
				<option value='Silver Metal' " . (($item['Frame'] == "Silver Metal") ? "selected='selected'" : "") . ">Silver Metal</option>
			</select>";
			echo "</td>";

			echo "<td>" . number_format($item['Price'], 2) . "</td>";
			echo "<td>". calculateCost($item['Price'], $item['Quantity']) . "</td>";
			echo "<td><a href='removeCartItem.php?id=" . $item['ID'] . "'>Remove</a></td>";
			echo "</tr>";
		}
	}
}

function calculateCost($price, $quantity) {
	return number_format($price * $quantity, 2);
}

function calculatePrice($item) {
	$price = 0;
	
	//size
	if($item['Size'] == "5x7") {
		$price = 0.50;
	}
	elseif($item['Size'] == "8x10") {
		$price = 2.50;
	}
	elseif($item['Size'] == "11x14") {
		$price = 6.00;
	}
	elseif($item['Size'] == "12x18") {
		$price = 7.00;
	}
	
	//stock
	if($item['Size'] == "5x7" || $item['Size'] == "8x10") {
		if($item['Stock'] == "Matte") {
			$price += 0;
		}
		elseif($item['Stock'] == "Glossy") {
			$price += 0.50;
		}
		elseif($item['Stock'] == "Canvas") {
			$price += 4;
		}
	}
	elseif($item['Size'] == "11x14" || $item['Size'] == "12x18") {
		if($item['Stock'] == "Matte") {
			$price += 0;
		}
		elseif($item['Stock'] == "Glossy") {
			$price += 1;
		}
		elseif($item['Stock'] == "Canvas") {
			$price += 8;
		}
	}
	
	//frame
	if($item['Frame'] != "None") {
		if($item['Size'] == "5x7") {
			$price += 10;
		}
		elseif($item['Size'] == "8x10") {
			$price += 12;
		}
		elseif($item['Size'] == "11x14") {
			$price += 16;
		}
		elseif($item['Size'] == "12x18") {
			$price += 20;
		}
	}
	
	return $price;
}

function calculateGrandTotal() {
	return calculateSubTotal() + calculateShipping();
}

function calculateShipping() {
	$shipping = 0;
	$frames = false;
	$frameQuantity = 0;
	
	if( !empty($_SESSION['ShoppingCart']) ) {
		$subtotal = calculateSubTotal();
		if($_SESSION['ShippingMethod'] == "Standard" && $subtotal < 100 || $_SESSION['ShippingMethod'] == "Express" && $subtotal < 300) { //if subtotal value is less than the thresholds
			if($_SESSION['ShippingMethod'] == "Standard") { //sets the base shipping costs
				$shipping = 5;
			}
			else {
				$shipping = 15;
			}
		
			$cart = $_SESSION['ShoppingCart']; //calculates whether there are framed items in the cart
			foreach($cart as $item) {
				if($item['Frame'] != "None") {
					$frames = true;
					$frameQuantity += 1;
				}
			}
			
			if($_SESSION['ShippingMethod'] == "Standard" && $frames == true) { //calculates if framed items over or within shipping thresholds
				if($frameQuantity <= 10) {
					$shipping = 15;
				}
				else { //greater than 10
					$shipping = 30;
				}
			}
			elseif($_SESSION['ShippingMethod'] == "Express" && $frames == true) {
				if($frameQuantity <= 10) {
					$shipping = 25;
				}
				else { //greater than 10
					$shipping = 45;
				}	
			}
		}
	}
	
	return $shipping;
}

function calculateSubtotal() {
	$subtotal = 0;
	if( !empty($_SESSION['ShoppingCart']) ) {
		$cart = $_SESSION['ShoppingCart'];
		foreach($cart as $item) {
			$subtotal += $item['Price'] * $item['Quantity'];
		}
	}
	return $subtotal;
}

?>