<?php

    require 'conexao.php';

    if(!isset($_SESSION['login_id'])){
        header('Location: index.php');
        exit;
    }

    $id = $_SESSION['login_id'];

    $sql = "SELECT * FROM 'users' WHERE 'google_id'='$id'";
    $get_user = mysqli_query($db_connection, $sql);

    if(mysqli_num_rows($get_user) > 0){
        $user = mysqli_fetch_assoc($get_user);
    } else {
        header('Location: logout.php');
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - <?php echo $user['name']; ?></title>
</head>
<body>
    <div class="main-content">
        <div class="user-dashboard">
            <div class="user-img">
                <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
            </div>
            <div class="user-info">
                <p class="user-name"><?php echo $user['name']; ?></p>
                <p class="user-email"><?php echo $user['email']; ?></p>
                <a class="btn-logout" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>