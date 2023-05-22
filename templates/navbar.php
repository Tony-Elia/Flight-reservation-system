
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="index.php">Flight Reservation System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['user']['role']): ?>
                    <li class="nav-item">
                        <a class="nav-link <?=$pageTitle === "Add Flights" ? 'active' : ''?>" aria-current="page" href="add.php">Add</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$pageTitle === 'Manage Flights' ? 'active' : ''?>" aria-current="page" href="flight-manage.php">Manage Flights</a>
                    </li>
                    <?php endif; ?>
                    <?php if($_SESSION['user']['role'] == 0): ?>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="home.php">Home</a>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <?php if(isset($_SESSION['user'])): ?>
            <div>
                <a class="nav-link text-white" href="profile.php">
                    <i class="fa fa-user"></i>
                    <?php
                            echo $_SESSION['user']['fname']; ?>
                </a>
            </div>
            <span class="text-white d-none d-sm-block">|</span>
            <div>
                <a class="nav-link text-white" href="logout.php"> Logout </a>
            </div>
            <?php endif; ?>
            <?php if(!isset($_SESSION['user'])): ?>
            <div>
                <a class="nav-link text-white" href="register.php">Register</a>
            </div>
            <span class="text-white d-none d-sm-block">|</span>
            <div>
                <a class="nav-link text-white" href="login.php">Login</a>
            </div>
            <?php endif; ?>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>
