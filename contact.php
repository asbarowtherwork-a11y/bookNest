<?php 
    session_start();
    include 'config.php';

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        /*header('location:login.php');*/
    }

    if(isset($_POST['send'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = $_POST['number'];
        $msg = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `messages` WHERE name='$name' AND email
        = '$email' AND number='$number' AND message='$msg'")or die('query failed');

        if(mysqli_num_rows($select_message) > 0){
            $message[] = 'Message sent already';
        }else{
            mysqli_query($conn, "INSERT INTO `messages`(user_id, name, email, number, message)VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
            $message[] = 'Message sent';
        }

    }
    $fetch_messages_query = mysqli_query($conn, "SELECT * FROM `messages` WHERE user_id = '$user_id'") or die('query failed');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Contact</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
<?php include 'header.php';?>

<?php 
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . $msg . '</span>
            <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<div class="heading">
    <h3>contact us</h3>
   
</div>

<section class="contact">
    <form action="" method="post">
    <input type="text" name="name" required placeholder="Enter Your Name" class="box">
    <input type="email" name="email" required placeholder="Enter Your Email" class="box">
    <input type="text" name="number" required placeholder="Enter Your Number" class="box">
    <textarea name="message" class="box" placeholder="Enter Your Message" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="send message" name="send" class="btn">
    </form>
   
</section>

<?php 
if (mysqli_num_rows($fetch_messages_query) > 0) {
    while ($fetch_messages = mysqli_fetch_assoc($fetch_messages_query)) {
?>
    <div class="user-message">
        <p>Message: <span><?php echo htmlspecialchars($fetch_messages['message']); ?></span></p>
        <?php if (!empty(trim($fetch_messages['reply']))) { ?>
            <div class="admin-reply">
                <p>Admin Reply: <span><?php echo htmlspecialchars($fetch_messages['reply']); ?></span></p>
            </div>
        <?php } else { ?>
            <p><em>No reply yet.</em></p>
        <?php } ?>
    </div>
<?php 
    }
} else {
    echo '<p><em>No messages found.</em></p>';
}
?>



<?php include 'footer.php';?>


<script src="script.js"></script>

    </body>
</html>