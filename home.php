<?php
    session_start();
    $pageTitle = 'Show Flights';
    include 'init.php';
    include $template . 'header.php';
    include $template.'navbar.php';
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
    $email = $_SESSION['user']['email'];
    $user_id = $_SESSION['user']['user_id'];
    $sql = "SELECT * FROM flight";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $flights = $stmt->fetchAll();
    /*
     * SELECT USING JOIN
     * */
    $sql = "
        SELECT * FROM flight
        JOIN reservation ON flight.flight_id = reservation.flight_id
        WHERE reservation.user_id = $user_id
        GROUP BY reservation.flight_id
        ORDER BY reservation.flight_id
        ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $myflights = $stmt->fetchAll();

    ?>

<div class="container my-5">
    <h1>Show Flights</h1>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Flight ID</th>
            <th scope="col">Departure Location</th>
            <th scope="col">Arrival Location</th>
            <th scope="col">Departure Time</th>
            <th scope="col">Arrival Time</th>
            <th scope="col">Price</th>
            <th scope="col">Airline</th>
            <th scope="col" class="text-center">Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($flights as $flight){ ?>
            <tr>
                <th scope="row"><?=$flight['flight_id']?></th>
                <td><?=$flight['dep_location']?></td>
                <td><?=$flight['arrival_location']?></td>
                <td><?=$flight['dep_time']?></td>
                <td><?=$flight['arrival_time']?></td>
                <td><?=$flight['price']?></td>
                <td><?=$flight['airline']?></td>
                <td class="text-center">
<!--                    <form action="book-flight.php?flight_id=--><?php //echo $flight['flight_id']; ?><!--" method="GET">-->
                    <form action="book-flight.php" method="GET">
                        <input type="hidden" name="flight_id" value="<?=$flight['flight_id']?>">
                        <input type="submit" value="Book" class="btn btn-success"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>



    <div class="container my-5">
        <h1>My Flights</h1>
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">Flight ID</th>
                <th scope="col">Departure Location</th>
                <th scope="col">Arrival Location</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Arrival Time</th>
                <th scope="col">Price</th>
                <th scope="col">Airline</th>
                <th scope="col" class="text-center">Controls</th>
            </tr>
            </thead>
            <tbody>
            <?= count($myflights)?:'<tr><td colspan="8" class="text-center">No Flights</td></tr>' ?>
            <?php foreach($myflights as $flight){ ?>
                <tr>
                    <th scope="row"><?=$flight['flight_id']?></th>
                    <td><?=$flight['dep_location']?></td>
                    <td><?=$flight['arrival_location']?></td>
                    <td><?=$flight['dep_time']?></td>
                    <td><?=$flight['arrival_time']?></td>
                    <td><?=$flight['price']?></td>
                    <td><?=$flight['airline']?></td>
                    <td class="text-center">
                        <!--                    <form action="book-flight.php?flight_id=--><?php //echo $flight['flight_id']; ?><!--" method="GET">-->
                        <form action="delete-seat.php" method="GET">
                            <input type="hidden" name="flight_id" value="<?=$flight['flight_id']?>">
                            <input type="submit" value="Cancel" class="btn btn-danger"/>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
    include $template . 'footer.php';
?>