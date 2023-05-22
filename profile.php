<?php
    session_start();
    $pageTitle = 'My Profile';
    include 'init.php';
    include $template . 'header.php';
    include $template.'navbar.php';
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
    $email = &$_SESSION['user']['email'];
    $user_id = &$_SESSION['user']['user_id'];
    $fname = &$_SESSION['user']['fname'];
    $lname = &$_SESSION['user']['lname'];
    $address = &$_SESSION['user']['address'];
    $phone = &$_SESSION['user']['phone'];
    $password = &$_SESSION['user']['password'];
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        if(!empty($_POST['password'])){
            $password = $_POST['password'];
        }
        /*
         * Update Query Syntax
         * */
        $sql = "UPDATE user SET
                `fname` = '$fname',
                `lname` = '$lname',
                `password` = '$password',
                `address` = '$address',
                `phone` = '$phone'
            WHERE user_id = $user_id";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header('Location: home.php');
    }
?>

<div class="container my-5 col-md-7 col-11 mx-auto">
    <!--Edit Profile-->
    <h3 class="text-center">My Profile</h3>
    <form class="form" action="profile.php" method="POST">

        <div class="form-group my-4">
            <label for="fname">First Name</label>
            <input type="text" value="<?= $fname ?>" name="fname" class="form-control" id="fname" aria-describedby="">
        </div>
        <div class="form-group my-4">
            <label for="fname">Second Name</label>
            <input type="text" value="<?= $lname ?>" name="lname" class="form-control" id="lname" aria-describedby="">
        </div>

        <div class="form-group my-4">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" name="address" class="form-control" value="<?= $address ?>">
        </div>
        <div class="form-group my-4">
            <label for="exampleInputPassword1">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $phone ?>">
        </div>
        <div class="form-group my-4 position-relative">
            <label for="exampleInputPassword1">New Password</label>
            <i class="fa fa-eye eye" data-show="pwd"></i>
            <input type="password" name="password" class="form-control" id="pwd" placeholder="Don't write anything if you do not want to change it">
        </div>
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <div class="row justify-content-center">
            <button type="submit" class="btn button mt-4 w-md-50 w-75"> Update </button>
        </div>
    </form>
</div>

<?php
    include $template . 'footer.php';
?>