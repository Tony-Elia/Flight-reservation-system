<?php
    session_start();
    $pageTitle = 'Welcome Page';
    include 'init.php';
    include $template . 'header.php';
    include $template.'navbar.php';
?>
    <div class="container text-center my-5" id="welcome-text">
        <h1 class="text-stroke">Welcome To Flight Reservation System</h1>
    </div>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 4"></button>
<!--            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 5"></button>-->
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./layout/images/bg2.jpg" id="bg2" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Flight Reservation System</h5>
                    <p>Book your flight now!</p>
                </div>

            </div>
            <div class="carousel-item">
                <img src="./layout/images/bg3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./layout/images/bg4.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./layout/images/bg5.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./layout/images/bg6.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

<?php
include $template . 'footer.php';
?>