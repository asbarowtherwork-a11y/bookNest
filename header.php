
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>bookNest</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<header class="header">

    
    <div class="header-2">
        <div class="flex">
        <div class="logo">bookNest</div>
        
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="bestsellers.php">Bestsellers</a>
            <a href="arrivals.php">Arrivals</a>
            <li class="dropdown__item"> 
                <a class="nav__link dropdown__button">Genre </a>
            <div class="dropdown__container">
                <div class="dropdown__content">
                <div class="dropdown__group">
                    <span class="dropdown__title">Fiction</span>
                    <ul class="dropdown__list">
                        <li>
                            <a href="literary.php" class="dropdown__link">Literary</a>
                            
                        </li>
                        <li>
                            <a href="mystery.php" class="dropdown__link">Mystery</a>
                            
                        </li>
                        <li>
                            <a href="Thriller1.php" class="dropdown__link">Thriller</a>
                            
                        </li>
                        <li>
                            <a href="Advent.php" class="dropdown__link">Adventure</a>

                        </li>
                        <li>
                            <a href="scifi.php" class="dropdown__link">Science Fiction</a>
                            
                        </li>
                        <li>
                            <a href="hisfi.php" class="dropdown__link">History Fiction</a>
                            
                        </li>
                    </ul>
                </div>

                <div class="dropdown__group">
                    <span class="dropdown__title">Non Fiction</span>
                    <ul class="dropdown__list">
                        <li>
                            <a href="biography.php" class="dropdown__link">Biography</a>
                        </li>
                        <li>
                            <a href="autobio.php" class="dropdown__link">Autobiography</a>
                        </li>
                        <li>
                            <a href="self.php" class="dropdown__link">Self-help</a>
                        </li>
                        <li>
                            <a href="history.php" class="dropdown__link">History</a>
                        </li>
                        <li>
                            <a href="travel.php" class="dropdown__link">Travel</a>
                        </li>
                        <li>
                            <a href="sci.php" class="dropdown__link">Science</a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown__group">
                    <span class="dropdown__title">Comics & Manga</span>
                    <ul class="dropdown__list">
                        <li>
                            <a href="manga.php" class="dropdown__link">Manga</a>
                        </li>
                        <li>
                            <a href="india.php" class="dropdown__link">Indian Comics</a>
                        </li>
                        <li>
                            <a href="american.php" class="dropdown__link">American Comics</a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown__group">
                    <span class="dropdown__title">Kids Books</span>
                    <ul class="dropdown__list">
                        <li>
                            <a href="early.php" class="dropdown__link">Early Learning</a>
                        </li>
                        <li>
                            <a href="kid1.php" class="dropdown__link">0-2 Years</a>
                        </li>
                        <li>
                            <a href="kid2.php" class="dropdown__link">3-5 Years</a>
                        </li>
                        <li>
                            <a href="kid3.php" class="dropdown__link">6-8 Years</a>
                        </li>
                        <li>
                            <a href="activity.php" class="dropdown__link">Activity Books</a>
                        </li>
                        <li>
                            <a href="work.php" class="dropdown__link">Workbooks</a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
            </li>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="orders.php">Orders</a>
            <a href="login.php">Login</a>

        </nav>
        <div class="icons">
            <i class="fa-solid fa-bars" id="menu-btn"></i>
            <a href="search_page.php"> <i class="fa-solid fa-magnifying-glass"></i></a>
          <i class="fa-solid fa-user" id="user-btn"></i>

          <?php
          $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'")or die('query failed');
          $cart_rows_number = mysqli_num_rows($select_cart_number);
          ?>

            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i> <span>(<?php echo $cart_rows_number;?>)
                </span>
            </a>

        </div>
        <div class="user-box">
            <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email :<span><?php echo $_SESSION['user_email']; ?></span></p>
            <p><a href="wishlist.php" class="wishlist-btn">Wishlist</a></p>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
        </div>
</div>


</header>