
<?php
    session_start();
    $pageTitle = 'Delete Your Seats';
    include 'init.php';
    include $template . 'header.php';
    include $template.'navbar.php';
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
    $flight_id = $_GET['flight_id'];
    $sql = "
        SELECT res.seat_id, flight_id, class_type 
        FROM reservation res
        JOIN seat st
        ON res.seat_id = st.seat_id
        where user_id = {$_SESSION['user']['user_id']} AND res.flight_id = $flight_id
        ORDER BY res.seat_id 
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET['seat_id'])){
        $seat_id = $_GET['seat_id'];
        /*
         * DELETE Query Syntax
         * */
        $sql = "DELETE FROM reservation WHERE seat_id = $seat_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header('Location: delete-seat.php?flight_id='.$_GET['flight_id']);
    }
    ?>
<div class="container my-5">
    <h1>My Reserved Seats</h1>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Seat ID</th>
            <th scope="col">Flight ID</th>
            <th scope="col">Seat Class Type</th>
            <th scope="col" class="text-center">Controls</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if(count($reservations) == 0){
            echo '<tr><td colspan="4" class="text-center">No Seats</td></tr>';
        }else {
            foreach ($reservations as $flight) { ?>
                <tr>
                    <td><?= $flight['seat_id'] ?></td>
                    <th scope="row"><?= $flight['flight_id'] ?></th>
                    <td><?= $flight['class_type'] ?></td>
                    <td class="text-center">
                        <!--                    <form action="book-flight.php?flight_id=-->
                        <?php //echo $flight['flight_id'];
                        ?><!--" method="GET">-->
                        <form action="delete-seat.php" method="GET">
                            <input type="hidden" name="flight_id" value="<?= $flight['flight_id'] ?>">
                            <input type="hidden" name="seat_id" value="<?= $flight['seat_id'] ?>">
                            <input type="submit" value="Cancel" class="btn btn-danger"/>
                        </form>
                    </td>
                </tr>
            <?php }
        }?>
        </tbody>
    </table>
</div>
