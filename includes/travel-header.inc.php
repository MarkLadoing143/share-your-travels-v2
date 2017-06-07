<header>
   <div id="topHeaderRow">
      <div class="container">
         <div class="pull-right">
            <ul class="list-inline">
              <li><a href="browse-cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>View Print Cart<?php 					
					if(!empty($_SESSION["ShoppingCart"])) {
						$imagecount = count($_SESSION["ShoppingCart"]);
						echo "<span class='badge'>" . $imagecount . "</span>";
					}           
                   ?></a></li>
              <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            </ul>         
         </div>
          </div>
   </div>  <!-- end topHeaderRow -->
   
   
    <div class="navbar navbar-default ">
      <div class="container">
         <nav>
           <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="index.php">Share Your Travels</a>
           </div>
           <div class="navbar-collapse collapse">
               
             <ul class="nav navbar-nav">
               <li><a href="index.php">Home</a></li>
               <li><a href="aboutus.php">About</a></li>
               <li><a href="browse-favorites.php">Favorites
                   <?php 					
					if(!empty($_SESSION['FavoriteImages']) || !empty($_SESSION['FavoritePosts'])) {
						$imagecount = count($_SESSION['FavoriteImages']);
						if(!empty($_SESSION['FavoritePosts'])) {
							$postcount = count($_SESSION['FavoritePosts']);
							$imagecount += $postcount;
						}
						
						echo "<span class='badge'>" . $imagecount . "</span>";
					}           
                   ?>
                   </a></li>
               <li class="dropdown">
                 <a href="browse.php" class="dropdown-toggle" data-toggle="dropdown">Browse <b class="caret"></b></a>
                 <ul class="dropdown-menu">
                   <li><a href="browse-posts.php">Posts</a></li>
                   <li><a href="browse-images.php">Images</a></li>
                   <li class="divider"></li>
                   <li><a href="browse-countries.php">Countries</a></li>
                   <li><a href="browse-users.php">Users</a></li>                
                 </ul>
               </li>
                 </ul>
                 <form class="navbar-form navbar-right" role="search" method="get" action="browse-images.php">
                 <div class="form-group">
                 <input type="text" class="form-control" placeholder="Search for Images" name="search" size="18" <?php if( isset($_GET['search']) && !empty($_GET['search']) ) { echo "value=" . $_GET['search']; }; ?> >
                 </div>
                 <button type="submit" class="btn btn-default">Search</button>
                    </form>
             </div>
             
           </div><!-- end navbar collapse -->
        </nav>
      </div>
    </div>
    <!-- end navbar -->
</header>