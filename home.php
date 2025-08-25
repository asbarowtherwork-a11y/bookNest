<?php 
    session_start();
    include 'config.php';

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Home</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
<?php include 'header.php';?>

    <section>    
    <div class="slideshow-conatiner">
        <div class="mySlides fade">
           
            <img src="images/newarrival.png" style="width: 100%">
            <a href="arrivals.php"><button class="Shop">SHOP NOW</button></a>
        
        </div>

        <div class="mySlides fade">
            
            <img src="images/newbestsellers.png" style="width: 100%">
            <a href="bestsellers.php"><button class="Shop1">SHOP NOW</button></a>
            
        </div>

        <div class="mySlides fade">
           
            <img src="images/mangabest.png" style="width: 100%">
            <a href="manga.php"><button class="Shop2">SHOP NOW</button></a>
            
        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
    <br>
    <div style="text-align: center">
        <span class="dot" onclick="currentSlides(1)"></span>
        <span class="dot" onclick="currentSlides(2)"></span>
        <span class="dot" onclick="currentSlides(3)"></span>

    </div>
</section>


<div class="services">
    <div class="services_box">
        <div class="services_card">
        <i class="fa-solid fa-truck-fast"></i>
        <h3>Quick Delivery</h3>
        <p>Fastest Delivery of orders within 3 Days.</p>
        </div>

        <div class="services_card">
        <i class="fa-solid fa-headset"></i>
        <h3>24 x 7 Support</h3>
        <p>Friendly 24/7 customer support.</p>
        </div>

        <div class="services_card">
        <i class="fa-solid fa-tag"></i>
        <h3>Best Deals</h3>
        <p>Explore best offers and deals.</p>
        </div>

        <div class="services_card">
        <i class="fa-solid fa-lock"></i>
        <h3>Secured Payment</h3>
        <p>Payments are processed with the utmost security.</p>
        </div>

    </div>
</div>

    <div class="imagelink">
        <div class="link">
           <h3>Books for Kids</h3>
            <a href="kids.php"><img src="images/kids.png" style="width: 100%"></a>
        
        </div>
    </div>
        
    <div class="authors">
     <h4>Featured Authors</h4>
        <div class="auto">
         
        <div class="authorimage">
          <a href="#"><img src="images/jk7.png"></a>
            <br>
            <span>Jhumpa Lahiri</span>
        </div>

        <div class="authorimage">
          <a href="#"><img src="images/jk1.jpg"></a>
            <br>
            <span>J.K.Rowling</span>
        </div>
        
        <div class="authorimage">
            <a href="#"><img src="images/jk2.jpg"></a>
            <br>
            <span>Stephen King</span>
        </div>
                   
        <div class="authorimage">
            <a href="#"><img src="images/jk3.jpg"></a>
            <br>
            <span>Arundhati Roy</span>
        </div>
                    
        <div class="authorimage">
            <a href="#"><img src="images/jk4.jpg"></a>
            <br>
            <span>Ruskin Bond</span>
        </div>
                  
        <div class="authorimage">
            <a href="#"><img src="images/jk5.png"></a>
            <br>
            <span>J.R.R Tolkien</span>
        </div>
              
        <div class="authorimage">
          <a href="#"><img src="images/jk6.jpg"></a>
            <br>
            <span>Vikram Seth</span>
        </div>

     </div>
    </div>

        <section class="home_thriller">
         <?php include 'Thriller.php';?>
</section>
         
<section class="home_res">
<a href="biography.php"><img src="images/res3.png"></a> 
<a href="Fantasy.php"><img src="images/res8.png"></a> 
<a href="Nonfiction.php"><img src="images/res7.png"></a> 

</section>

<div class="home-footer">
<?php include 'footer.php';?>
</div>

<script src="script.js"></script>

    </body>
</html>