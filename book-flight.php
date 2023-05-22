<?php
    session_start();
    $pageTitle = 'Book Flight';
//    $userID = $_SESSION['user']['user_id'];
//    $flight = $_GET['flight_id'];
    include 'init.php';
    include $template . 'header.php';
    include $template.'navbar.php';
//    $sql = "INSERT INTO reservation (user_id, flight_id, date) VALUES (?, ?, NOW())";
//    $stmt = $conn->prepare($sql);
//    $stmt->bindParam(1, $userID);
//    $stmt->bindParam(2, $flight);
//    $stmt->execute();
//    header('Location: home.php');
    $flight_id = $_GET['flight_id'];

// SELECT Using Sub-Queries
//    $sql = "
//        SELECT seat_id, class_type
//        FROM seat
//        WHERE aircraft_id =
//              (SELECT aircraft_id FROM flight WHERE flight_id = $flight_id)
//    ";
    $sql = "
        SELECT seat_id, class_type
        FROM seat
        JOIN aircraft ON seat.aircraft_id = aircraft.aircraft_id
        JOIN flight ON flight.aircraft_id = aircraft.aircraft_id
        WHERE flight.flight_id = $flight_id
        ORDER BY class_type
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $seats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $new_seats = array();
    foreach ($seats as &$seat){
        $seat['free'] = true;
    }
unset($seat);
    $sql = "
        SELECT seat_id
        FROM reservation
        WHERE flight_id = $flight_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $reserved_seats = $stmt->fetchAll();
    foreach ($reserved_seats as $reserved_seat) {
        $reserved_sea = $reserved_seat['seat_id'];
        foreach ($seats as &$seat) {  // Use "&$seat" to create a reference
            if ($seat['seat_id'] == $reserved_sea) {
                $seat['free'] = false;
            }
        }
    }
    unset($seat);

    if(isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $sql = "INSERT INTO reservation (user_id, flight_id, seat_id, date) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $_SESSION['user']['user_id']);
        $stmt->bindParam(2, $flight_id);
        $stmt->bindParam(3, $_POST['seat_id']);
        $stmt->execute();
        header("Location: book-flight.php?flight_id=$flight_id");
    }
?>
<div class="flight">
    <h2 class="center text-center mt-3">Reserve Flight</h2>

    <?php
        if(isset($_SESSION['user'])){
            echo '<h4 class="center text-center">Welcome '.$_SESSION['user']['fname'].'</h4>';
        }
        else{
            echo '<h4 class="center text-center">Welcome Guest</h4>';
        }
        if(count($seats) == 0){
            echo '<h4 class="center text-center">No seats available</h4>';
        }else {
            echo '<div class="grid-container">';
            foreach ($seats as $seat) {
                $disabled = $seat['free'] ? '' : 'disabled';
                echo "<form action='book-flight.php?flight_id=$flight_id' method='POST' class='grid-item $disabled'>";
                    echo "<button type='submit'>";
                    echo "<input type='hidden' name='seat_id' value='" . $seat['seat_id'] . "'>";
                    echo "<i class='fa fa-chair'></i>" . $seat['class_type'];
                    echo "<br>";
                    echo "<div class= 'text-success'>" .$seat['seat_id']. "</div>";
                    echo "</button>";
                echo "</form>";
//                echo '<div class="grid-item"></div>';

            }
            echo '</div>';
        }
    ?>
</div>

<?php
    include $template . 'footer.php';
