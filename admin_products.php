<?php 
    session_start();
    include 'config.php';

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        /*header('location:login.php');*/
    }

    if(isset($_POST['add_product'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = $_POST['price'];
        $category = mysqli_real_escape_string($conn, $_POST['category']); 
        
        $author = mysqli_real_escape_string($conn, $_POST['author']);
$description = mysqli_real_escape_string($conn, $_POST['description']);

        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;


        $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'")or die('query failed');

        if(mysqli_num_rows($select_product_name) > 0){
            $message[] = 'Product name already added';
        }
        else{
            $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, author, description, price, image, category) VALUES('$name', '$author', '$description','$price', '$image', '$category')") or die('query failed');

            if($add_product_query){
                if($image_size > 8000000){
                    $message[] = 'Image size too large';
                }
                else{
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'Product added successfully';
                }
            }
            else{
                $message[] = 'Product could not be added ';
            }

        }
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id='$delete_id'")or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
        unlink('uploaded_img/'.$fetch_delete_image['image']);
        mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
        header('location:admin_products.php');
    }

    if(isset($_POST['update_product'])){
        $update_p_id = $_POST['update_p_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_category = mysqli_real_escape_string($conn, $_POST['update_category']);

        mysqli_query($conn, "UPDATE `products` SET name='$update_name', price='$update_price', category='$update_category' WHERE id= '$update_p_id'")or die('query failed');

        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_folder = 'uploaded_img/'.$update_image;
        $update_old_image = $_POST['update_old_image'];

        if(!empty($update_image)){
            if($update_image_size > 5000000){
                $message[] = 'image file size is too big';
            }else{
                mysqli_query($conn, "UPDATE `products` SET image='$update_image' WHERE id= '$update_p_id'")or die('query failed');
                move_uploaded_file($update_image_tmp_name, $update_folder );
                unlink('uploaded_img/'.$update_old_image);

            }
        }
        header('location:admin_products.php');

    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>products</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    </head>
<body>

<?php include 'admin_header.php';?>

<section class="add-products">
    

<form action="" method="post" enctype="multipart/form-data">
    <h3>Add Products</h3>
    <input type="text" name="name" class="box" placeholder="Enter product name" required>
    <input type="text" name="author" class="box" placeholder="Enter author name" required>
<textarea name="description" class="box" placeholder="Enter product description" required></textarea>

    <input type="number" min="0" name="price" class="box" placeholder="Enter product price" required>
    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
   


    <select name="category" class="box" required>
        <option value="" disabled selected>Select Category</option>
        <option value="Bestsellers">Bestsellers</option>
        <option value="New Arrivals">Arrivals</option>
        <option value="Featured">Featured</option>
        <option value="Non Fiction">Non Fiction</option>
        <option value="Manga">Manga</option>
        <option value="Kids">Kids</option>
        <option value="biography">Biography</option>
        <option value="fantasy">Fantasy</option>
        <option value="literary">Literary</option>
        <option value="mystery">Mystery</option>
        <option value="thriller">Thriller</option>
        <option value="advent">Adventure</option>
        <option value="scifi">Science Fiction</option>
        <option value="Hisfi">History Fiction</option>
        <option value="recommend">Recommend</option>
        <option value="auto">Autobiography</option>
        <option value="self">Self-help</option>
        <option value="his">History</option>
        <option value="travel">Travel</option>
        <option value="sci">Science</option>
        <option value="india">Indian Comics</option>
        <option value="america">American Comics</option>
        <option value="early">Early Learning</option>
        <option value="c">0-2 Years</option>
        <option value="h">3-5 Years</option>
        <option value="i">6-8 Years</option>
        <option value="active">Activity Books</option>
        <option value="work">Workbooks</option>


    </select>

    
    <input type="submit" value="Add Product" name="add_product" class="btn">
</form>
</section>    

<section class="show-products">
<div class="box-container">
    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM `products`")or die('query failed');
    if(mysqli_num_rows($select_products) > 0){
        while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
    <div class="box">
        <img src="uploaded_img/<?php echo $fetch_products['image'];?>"alt="">
        <div class="name"><?php echo $fetch_products['name'];?></div>
        
        <div class="price"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo $fetch_products['price'];?>/-</div>
        <div class="category">Category: <?php echo $fetch_products['category']; ?></div>
            <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
            <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Delete</a>
            

    </div>
    <?php
        }
    }
    else{
        echo '<p class="empty">No Product Added Yet</p>';
    }
    ?>
    
</div>
</section>

<section class="edit-product-form">

    <?php
    if(isset($_GET['update'])){
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$update_id'") or die('query failed');
        if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                    <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                    <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                    <input type="text" name="update_name" value="<?php echo $fetch_update['name'];?>" class="box" required placeholder="enter product name">
                    <input type="number" name="update_price" value="<?php echo $fetch_update['price'];?>" class="box" required placeholder="enter price">

                    <select name="update_category" class="box" required>
    <option value="<?php echo $fetch_update['category']; ?>" selected><?php echo $fetch_update['category']; ?> (Current)</option>
    <option value="Bestsellers">Bestsellers</option>
        <option value="New Arrivals">Arrivals</option>
        <option value="Featured">Featured</option>
        <option value="Non Fiction">Non Fiction</option>
        <option value="Manga">Manga</option>
        <option value="Kids">Kids</option>
        <option value="biography">Biography</option>
        <option value="fantasy">Fantasy</option>
        <option value="literary">Literary</option>
        <option value="mystery">Mystery</option>
        <option value="thriller">Thriller</option>
        <option value="advent">Adventure</option>
        <option value="scifi">Science Fiction</option>
        <option value="Hisfi">History Fiction</option>
        <option value="recommend">Recommend</option>
        <option value="auto">Autobiography</option>
        <option value="self">Self-help</option>
        <option value="his">History</option>
        <option value="travel">Travel</option>
        <option value="sci">Science</option>
        <option value="india">Indian Comics</option>
        <option value="america">American Comics</option>
        <option value="early">Early Learning</option>
        <option value="c">0-2 Years</option>
        <option value="h">3-5 Years</option>
        <option value="i">6-8 Years</option>
        <option value="active">Activity Books</option>
        <option value="work">Workbooks</option>
        



</select>

                    <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                    <input type="submit" value="Update" name="update_product" class="btn">
                    <button id="close-update" class="option-btn">Cancel</button>
                </form>
                <?php
            }
        }
    }else{
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }
    ?>
</section>
<script>
    

    document.querySelector('#close-update').onclick = (event) => {
    event.preventDefault(); // Prevents the form from submitting
    document.querySelector('.edit-product-form').style.display = 'none';
    window.location.href = 'admin_products.php';
}

</script>


<!--<script src="script.js?v=1.0"></script>-->

<script src="admin.js?v=1.0"></script>
</body>
</html>