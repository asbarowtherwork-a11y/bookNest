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
        <title>About</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
<?php include 'header.php';?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h2><span>W</span><span>e</span><span>l</span><span>c</span><span>o</span><span>m</span><span>e</span> <span>T</span><span>o</span> <span>b</span><span>o</span><span>o</span><span>k</span><span>N</span><span>e</span><span>s</span><span>t</span></h2>
            <p>We're an online bookstore website passionate about connecting readers with books that inspire,educate,and entertain.We're dedicated  to making book shopping easy and enjoyable.With fast delivery and exceptional customer service and seamless experience.</p> 
        </div>
        <div class="hero-image">
            <img src="images/c1.png">
        </div>
    </div>
</section>




<?php include 'footer.php';?>


<script src="script.js"></script>

    </body>
</html>