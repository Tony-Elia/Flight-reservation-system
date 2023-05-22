
<?php
    session_start();
    $pageTitle = 'Manage Flights';
    include 'init.php';
    include $template . 'header.php';
    include $template.'navbar.php';
    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
        header('Location: login.php');
    }
    $sql = "SELECT * FROM flight";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['flight_id'])){
        $flight_id = $_POST['flight_id'];
        /*
         * DELETE Query Syntax
         * */
        $sql = "DELETE FROM flight WHERE flight_id = '$flight_id' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header('Location: flight-manage.php');
    }
?>
<div class="container my-5">
    <h1>All Flights</h1>
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
                <td class="text-center d-flex">
                    <form action="<?= $_SERVER['PHP_SELF']?>" method="POST" class="d-block me-2">
                        <input type="hidden" name="flight_id" value="<?=$flight['flight_id']?>">
                        <input type="submit" value="Cancel" class="btn btn-outline-danger"/>
                    </form>
                    <form action="update-flight.php" method="GET" class="d-block">
                        <input type="hidden" name="flight_id" value="<?=$flight['flight_id']?>">
                        <input type="submit" value="Update" class="btn btn-outline-primary"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
