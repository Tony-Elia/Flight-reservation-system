<?php
    session_start();
    $pageTitle = 'Register';
    include 'init.php';
    include $template . 'header.php';
    $errorMsg = [];
https://meet.google.com/spc-zycm-qfb
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $pass = $_POST['pass'];
        $repass = $_POST['repass'];
        if($pass != $repass) {
            array_push($errorMsg, "Passwords do not match!");
        }
        $sql = "SELECT email from user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
//        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount()) {
            // insert into the array
            array_push($errorMsg, "Email already exists!");

        }
        // get the length of the array

        if(count($errorMsg) == 0) {
            /*
             *
             *insert into the database
             *
             *
             * */
            $sql = "INSERT INTO user(fname, lname, email, password, address, phone) values(?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $fName);
            $stmt->bindParam(2, $lName);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $pass);
            $stmt->bindParam(5, $address);
            $stmt->bindParam(6, $phone);
            if($stmt->execute()){
                // add user to session
                header('Location: login.php');
            }else{
                header('Location: register.php');
            }
        }
    }
    ?>
<div class="container align-items-center p-5 my-5 main">
    <!--show error msg -->
    <?php
    foreach($errorMsg as $error){

        // alert dismisable
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> ' . $error . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
    }
    ?>
    <div class="h1 d-block text-center">Register</div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="mb-3 mt-3">
            <label for="fName" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="fName" name="fName" placeholder="Enter First Name" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="lName" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="lName" name="lName" placeholder="Enter Last Name" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="phone" class="form-label">Phone Number:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
        </div>
        <div class="mb-3 passbox">
            <label for="pwd" class="form-label">New Password:</label>
            <i class="fa-solid fa-eye eye" data-show="pwd"></i>
            <input type="password" class="form-control" id="pwd" name="pass" placeholder="Enter New Password" required>
        </div>
        <div class="mb-3 passbox">
            <label for="repwd" class="form-label">Re-enter Password:</label>
            <i class="fa-solid fa-eye eye" data-show="repwd"></i>
            <input type="password" class="form-control" id="repwd" name="repass" placeholder="Re-enter The Password" required>
        </div>
        <div class="row">
            <a href="login.php">Already have an account</a>
        </div>
        <div class="row mt-5">
            <button type="submit" class="btn button submit">Submit</button>
        </div>
    </form>
</div>
<?php
    include $template . 'footer.php';
?>