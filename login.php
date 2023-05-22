<?php
    session_start();
    $pageTitle = 'Login';
    include 'init.php';
    include $template . 'header.php';

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        echo '<pre>';
        print_r($_POST);
        echo'<pre/>';
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        /*
         * Select
         * */
        $sql = "SELECT * FROM user WHERE email = ? AND password = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $pass);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if($count){
            echo "Login successfully<br/>";
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['user_id'] = $row['user_id'];
            $_SESSION['user']['fname'] = $row['fname'];
            $_SESSION['user']['lname'] = $row['lname'];
            $_SESSION['user']['address'] = $row['address'];
            $_SESSION['user']['phone'] = $row['phone'];
            $_SESSION['user']['password'] = $row['password'];
            $_SESSION['user']['role'] = $row['role'];

            header('Location: index.php');
        }else{
            header('Location: register.php');
        }

    }

    ?>
        <div class="container align-items-center p-5 my-5 main">
            <div class="h1 d-block text-center">Login</div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                </div>
                <div class="mb-3 passbox">
                    <label for="pwd" class="form-label">Password:</label>
                    <i class="fa-solid fa-eye eye" data-show="pwd"></i>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass" required>
                </div>
                <div class="row">
                    <a href="./register.php">Register a new user</a>
                </div>
                <div class="row mt-5">
                    <button type="submit" class="btn button submit">Submit</button>
                </div>
            </form>
        </div>

<?php
    include $template . 'footer.php';
?>