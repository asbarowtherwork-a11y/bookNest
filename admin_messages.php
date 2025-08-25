<?php 
    session_start();
    include 'config.php';

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        /*header('location:login.php');*/
    }
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `messages` WHERE id = '$delete_id'")or die('query failed');
        header('location:admin_messages.php');
    }
    if(isset($_POST['send_reply'])){
        $message_id = $_POST['message_id'];
        $reply = mysqli_real_escape_string($conn, $_POST['reply']);
        
        $update_reply = mysqli_query($conn, "UPDATE `messages` SET `reply` = '$reply' WHERE `id` = '$message_id'") or die('query failed');
        
        if($update_reply){
            header('location:admin_messages.php'); // Refresh the page after sending reply
        }
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

<?php include 'admin_header.php';?>

    <section class="messages">

    <h1 class="title">Messages</h1>

    <div class="box-container">
       
        <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `messages`")or die('query failed');
            if(mysqli_num_rows($select_messages) > 0){
                while($fetch_messages = mysqli_fetch_assoc($select_messages)){
            
        ?>
        <div class="box">
            <p> name:<span><?php echo $fetch_messages['name']; ?></span></p>
            <p> number:<span><?php echo $fetch_messages['number']; ?></span></p>
            <p> email:<span><?php echo $fetch_messages['email']; ?></span></p>
            <p> message:<span><?php echo $fetch_messages['message']; ?></span></p>

            <button class="reply-btn" onclick="openReplyModal(<?php echo $fetch_messages['id']; ?>, '<?php echo htmlspecialchars(addslashes($fetch_messages['reply'])); ?>')">Reply</button>

            <a href="admin_messages.php?delete=<?php echo $fetch_messages['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">Delete</a>
        </div>
        <?php
            };
        }else{
            echo '<p class="empty">no messages</p>';
        }
        ?>
       
    </div>

   
    </section>

    <!-- Reply Modal -->
<div id="replyModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeReplyModal()">&times;</span>
        <h2>Send Reply</h2>
        <form action="" method="post">
            <input type="hidden" name="message_id" id="modalMessageId">
            <textarea name="reply" id="modalReply" placeholder="Type your reply here..." required></textarea>
            <button type="submit" name="send_reply" class="btn">Send Reply</button>
        </form>
    </div>
</div>


<script src="admin.js"></script>
</body>
</html>