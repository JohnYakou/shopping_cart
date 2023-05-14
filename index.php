<?php
    include 'config.php';

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    };

    if(isset($_GET['logout'])){
        unset($user_id);
        session_destroy();
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message" onclick="this.remove()">'.$message.'</div>';
            }
        }
    ?>

    <div class="container">
        <div class="user-profile">
            <?php
                $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die ('query failled');

                if(mysqli_num_rows($select_user) > 0){
                    $fetch_user = mysqli_fetch_assoc($select_user);
                };
            ?>

            <p>username : <span><?php echo $fetch_user['name']; ?></span></p>
            <p>email : <span><?php echo $fetch_user['email']; ?></span></p>

            <div class="flex">
                <a href="login.php" class="btn">login</a>
                <a href="register.php" class="option-btn">register</a>
                <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to logout ?');"  class="delete-btn">logout</a>
            </div>
        </div>
    </div>

</body>
</html>