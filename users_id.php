<!--?php 
    session_start();
    include 'config.php';

    $user_id = $_SESSION['user_id'];

    if(!isset($admin_id)){
        /*header('location:login.php');*/
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'")or die('query failed');
        header('location:admin_users.php');
    }
?>
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
<body>

<!?php include 'admin_header.php';?>
   

    <section class="users">
    <h1 class="title">user account</h1>
        <div class="box-container">
            <!?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users`")or die('query failed');
            while($fetch_users = mysqli_fetch_assoc($select_users)){
                ?>
                <div class="box">
                <p>username :<span><!?php echo $fetch_users['name'];?></span></p>
                <p>email :<span><!?php echo $fetch_users['email'];?></span></p>
                <p>user type :<span style="color:<!?php if($fetch_users['user_type'] == 'admin'){echo 'orange';}?>"><!?php echo $fetch_users['user_type'];?></span></p>
                <a href="admin_users.php?delete=<!?php echo $fetch_users['id']; ?>" onclick="return" confirm('delete this user?');" class="delete-btn">delete</a>

                </div>
                <!?php
                 };
            ?>
        </div>
    </section>
    <script src="admin.js"></script>
</body>
</html>